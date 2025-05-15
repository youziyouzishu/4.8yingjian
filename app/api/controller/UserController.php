<?php

namespace app\api\controller;

use app\admin\model\User;
use app\api\basic\Base;
use support\Request;

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

}
