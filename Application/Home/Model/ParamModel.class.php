<?php
namespace Home\Model;
/**
 * 参数表-数据字典
 */
class ParamModel extends BaseModel {
  //操作的表名
  public $tableName = 'parameters';
  /**
   * 获取参数数组
   * @param  [string] $data 参数类型
   * @return [array]
   */
    public function getParameter($type) {
      $result = $this->where("type = '$type'")->field('value,name')->select();
      return $result;
    }

  /**
   * 获取单值
   * @param  [string] $data 参数类型
   * @param  [string] $data 参数value
   * @return [array]
   */
    public function selectParameter($type, $value) {
      $result = $this->where("type = '$type' and value = '$value'")->field('name')->find();
      $result = $result['name'];
      return $result;
    }

}
