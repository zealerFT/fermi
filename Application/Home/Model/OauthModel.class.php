<?php
namespace Home\Model;

/**
 * 前台用户model
 */
class OauthModel extends BaseModel
{
    public $tableName = 'oauth_user';
    /**
     * 获取QQ互联登录用户信息
     * @param  String $access_token
     * @param  String $openid
     * @return mix
     */
    public function getQqUserInfoByToken($access_token, $openid)
    {
        $data = $this
                ->where(array("access_token" => $access_token, "openid" =>$openid))
                ->find();
        return $data;
    }

    /**
     * 保存互联登录用户信息
     * @param  Array $data 用户数据
     * @return uid
     */
    public function saveQqUserInfo($data)
    {
        $result = $this->data($data)->add();

        return $result;
    }

    /**
     * 保存互联登录用户信息
     * @param  Array $data 用户数据
     * @return uid
     */
    public function getQqUserInfo($uid)
    {
        $result = $this->where(array('uid' => $uid))->find();
        return $result;
    }
}
