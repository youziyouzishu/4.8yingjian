<?php

namespace app\api\controller;

use app\admin\model\Sms;
use app\admin\model\User;
use app\api\basic\Base;
use support\Request;
use Tinywan\Validate\Facade\Validate;

class UserController extends Base
{

    /**
     * 获取个人信息
     * @param Request $request
     * @return \support\Response
     */
    function getUserInfo(Request $request)
    {
        $row = User::find($request->user_id);
        return $this->success('成功', $row);
    }


    /**
     * 编辑个人信息
     * @param Request $request
     * @return \support\Response
     */
    function editUserInfo(Request $request)
    {
        $data = $request->post();
        $row = User::find($request->user_id);
        if (!$row) {
            return $this->fail('用户不存在');
        }

        $userAttributes = $row->getAttributes();
        foreach ($data as $key => $value) {
            if (array_key_exists($key, $userAttributes) && (!empty($value) || $value == 0)) {
                $row->setAttribute($key, $value);
            }
        }
        $row->save();
        return $this->success('成功');
    }

    function changeMobile(Request $request)
    {
        $mobile = $request->post('mobile');
        $captcha = $request->post('captcha');
        if (!$mobile || !Validate::checkRule($mobile, 'mobile')) {
            return $this->fail('手机号不正确');
        }
        $smsResult = Sms::check($mobile, $captcha, 'changemobile');
        if (!$smsResult) {
            return $this->fail('验证码不正确');
        }
        $user = User::find($request->user_id);
        $user->username = $mobile;
        $user->mobile = $mobile;
        $user->save();
        return $this->success();
    }

}
