<?php

namespace app\api\controller;

use app\admin\model\Sms;
use app\admin\model\User;
use app\api\basic\Base;
use Carbon\Carbon;
use plugin\admin\app\common\Util;
use support\Request;
use Tinywan\Jwt\JwtToken;

class AccountController extends Base
{
    protected array $noNeedLogin = ['*'];

    function login(Request $request)
    {
        $mobile = $request->post('mobile');
        $captcha = $request->post('captcha');
        if (!$mobile) {
            return $this->fail('手机号不能为空');
        }
        if (!$captcha) {
            return $this->fail('验证码不能为空');
        }
        if (!Sms::check($mobile, $captcha, 'login')) {
            return $this->fail('验证码不正确');
        }
        $user = User::where(['mobile' => $mobile])->first();
        if (!$user) {
            $user = User::create([
                'nickname' => '用户' . mt_rand(1000, 9999),
                'avatar' => '/app/admin/avatar.png',
                'join_time' => Carbon::now()->toDateTimeString(),
                'join_ip' => $request->getRealIp(),
                'last_time' => Carbon::now()->toDateTimeString(),
                'last_ip' => $request->getRealIp(),
                'username' => $mobile,
                'mobile' => $mobile,
            ]);
        }
        $token = JwtToken::generateToken([
            'id' => $user->id,
            'client' => JwtToken::TOKEN_CLIENT_MOBILE
        ]);
        return $this->success('成功',[
            'token' => $token,
            'user' => $user
        ]);
    }

    function refreshToken()
    {
        $res = JwtToken::refreshToken();
        return $this->success('成功', $res);
    }
}
