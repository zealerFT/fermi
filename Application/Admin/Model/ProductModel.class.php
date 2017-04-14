<?php
namespace Admin\Model;
/**
 * 产品模型类
 */
class ProductModel extends BaseModel {
      //操作的表名
      public $tableName = "financial_products";

      /**
       * 获取理财产品列表
       * @param
       * @return array
       */
      public function getManProList($where, $page, $limit, $order='', $field='') {
          $model = M('FinancialProducts');
          $data = $this->getData($model, $where, $page, $limit, $order, $field);
          return $data;
      }

      /**
       * 获取房产产品列表
       * @param
       * @return array
       */
      public function getHouProList($where, $page, $limit, $order='', $field='') {
          $model = M('Product');
          $data = $this->getData($model, $where, $page, $limit, $order, $field);
          return $data;
      }

      /**
       * 获取单个理财产品
       * @param
       * @return array
       */
      public function getManPro($id) {
          $data = $this->where("id = '$id'")->find();
          return $data;
      }

      /**
       * 获取单个房产产品
       * @param
       * @return array
       */
      public function getHouPro($id) {
          $data = M('product')->where("id = %d", $id)->find();
          return $data;
      }


}
