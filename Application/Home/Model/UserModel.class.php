<?php
namespace Home\Model;
/**
 * 前台用户model
 */
class UserModel extends BaseModel {

  public function getUserDataByEmail($email) {
    $data = $this->where("email = '$email'")->find();
    return $data;
  }

}
