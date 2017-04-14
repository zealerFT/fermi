<?php
namespace Home\Model;
/**
 * 国家城市model类
 */
class CountryModel extends BaseModel {
  /**
   * 获取国家列表
   * @return [type] [description]
   */
  public function get_country_list() {
      $result = S('country_list');
      if (empty($result)) {
          $data = $this->alias('a')->order('a.sortorderid')->select();
          foreach ($data as $k => $row) {
              $result[$k]['id'] = $row['id'];
              $result[$k]['name'] = LANG_SET == 'en-us' ? $row['name_en'] : $row['name'];
              $result[$k]['currency'] = $row['currency'];
          }
          S('country_list', $result);
      }
      return $result;
  }

}
