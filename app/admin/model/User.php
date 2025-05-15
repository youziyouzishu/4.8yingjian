<?php

namespace app\admin\model;


use plugin\admin\app\model\Base;
use support\Db;


/**
 * 
 *
 * @property int $id 主键
 * @property string|null $username 用户名
 * @property string|null $nickname 昵称
 * @property string|null $password 密码
 * @property string|null $sex 性别
 * @property string|null $avatar 头像
 * @property string|null $email 邮箱
 * @property string|null $mobile 手机
 * @property int|null $level 等级
 * @property string|null $birthday 生日
 * @property string $money 余额(元)
 * @property int $score 积分
 * @property string|null $last_time 登录时间
 * @property string|null $last_ip 登录ip
 * @property string|null $join_time 注册时间
 * @property string|null $join_ip 注册ip
 * @property string|null $token token
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property int $role 角色
 * @property int $status 禁用
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @mixin \Eloquent
 */
class User extends Base
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wa_users';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'nickname',
        'password',
        'sex',
        'avatar',
        'email',
        'mobile',
        'level',
        'birthday',
        'money',
        'score',
        'last_time',
        'last_ip',
        'join_time',
        'join_ip',
        'token',
        'role',
        'status',
    ];




}
