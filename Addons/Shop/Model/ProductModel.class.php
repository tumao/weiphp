<?php

namespace Addons\Shop\Model;
use Think\Model;

/**
 * WeiSite模型
 */
class ProductModel extends Model{

	protected $tableName = 'shop_product';

	public function plist($map = array())
	{
		$token = get_token();
		$map['token'] = $token;
		$list = M('shop_product')->where($map)->select();
		return $list;

	}

	public function productDetail($map)
	{
		$token = get_token();
		$map['token'] = $token;
		$list = M('shop_product')->where($map)->select();
		return $list[0];
	}

	//获取商品单价
	public function getUnitCost($id)
	{
		$map['token'] = get_token();
		$map['id'] = $id;
		$price  = M('shop_product')->where($map)->field('discount_price')->limit(1)->select();
		return $price[0]['discount_price'];
	}
}
