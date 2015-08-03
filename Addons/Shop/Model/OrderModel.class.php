<?php

namespace Addons\Shop\Model;

use Think\Model;

/**
 * Shop
 */
class OrderModel extends Model {
	protected $tableName = 'shop_order';
	protected $token = '';
	public function __construct()
	{
		$this->token = get_token();
	}
	function get_list($map) {
		$map ['token'] = get_token ();
		$list = $this->where ( $map )->order ( 'pid asc, sort asc' )->select ();

		foreach ( $list as &$vo ) {
			$vo ['icon'] = get_cover_url ( $vo ['icon'] );
			$vo ['icon'] && $vo ['icon'] = '<img src="' . $vo ['icon'] . '" >';
		}

		return $list;
	}

	//添加到购物车（一个订单包含多中商品，订单中的第一个商品为主订单，也就是其他的商品的负订单，fid=第一件商品的订单id）
	public function addOrder($map, $list)
	{
		$order = M($this->tableName);
		if(!$map['token'] = get_token())
		{
			exit('error:addCart can not find token');
		}
		$map['fid'] = 0;
		$orderList = array();

		foreach($list as $vo)
		{
			$map['unit_price'] = $vo['unit_price'];
			$map['title'] = $vo['title'];
			$map['product_field'] = $vo['title'];
			$map['count'] = $vo['count'];
			$map['total_fee'] = $vo['total_fee'];
			$insertId = $order->add($map);	//订单的id
			$orderList[] = $insertId;
			if($map['fid'] == 0)
			{
				$map['fid'] = $insertId;
			}
		}

		// return $map['fid'];
		return $orderList;
	}

	// 下订单时添加用户，如果不存在则添加
	public function addUser($map)
	{
		if(!$map['token'] = get_token())
		{
			exit('error:addCart can not find token');
		}
		$user = M('shop_user');
		$isExist = $user->where(['token'=>$map['token'],'openid'=>$map['openid']])->limit(1)->select();	//查看用户是否存在

		if(!$isExist)	//如果不存在
		{
			$insterId = $user->add($map);
			return $insterId;
		}
		return $isExist[0]['id'];
	}

	//获取用户的订单
	public function myOrder()
	{
		$userId = $this->getShopUserId();	//获取当前用户的shop_user_id
		if(!$map['token'] = get_token())
		{
			exit('error:addCart can not find token');
		}
		$map['user_id'] = $userId;
		$map['order_status'] = array('NEQ','cancled');
		$Order = M('shop_order');
		$myOrder = $Order->where($map)->order('id desc')->select();
		return $myOrder;
	}

	private function getShopUserId()
	{
		if(!$map['token'] = get_token())
		{
			exit('error:addCart can not find token');
		}
		if($openid == '')
		{
			$openid = get_openid();
		}
		$map['token'] = get_token();
		$map['openid'] = $openid;
		$Shop_user = M('shop_user');
		$user = $Shop_user->where($map)->select();
		return $user[0]['id'];
	}

	// 通过id获取订单
	public function getOrderById($id)
	{
		$token = get_token();
		$order_status = 'inorder';
		$map['token'] = $token;
		$map['order_status'] = $order_status;

		$map['id'] = $id;
		$Order = M('shop_order');
		$order = $Order->where($map)->select();

		return $order[0];
	}

	//改变订单状态
	public function turnOrderStatus($id, $status)
	{
		$token = get_token();
		$map['token'] = $token;
		$map['id'] = $id;
		$Order = M("shop_order");
		$Order->find($id);
		$Order->order_status = $status;
		$Order->save();
	}

	// 给已经成交的订单添加评论
	public function addComments($gid, $comments, $oid)
	{
		if(!$this->isOrderOk($oid))
		{
			return 0;	//订单尚未确认，不能进行评论
		}

		$token = get_token();
		$Comment = M('shop_comments');
		$map['token'] = $token;
		$map['gid'] = $gid;
		$map['comments'] = $comments;
		$cid = $Comment->add($map);
		return $cid;
	}

	// 判断订单是否已经成交
	public function isOrderOk($oid)
	{
		$map['id'] = $oid;
		$r = M('shop_order')->where($map)->field('order_status')->select();
		if($r['0']['order_status'] == 'orderOk')		//订单成功
		{
			return 1;
		}
		return 0;
	}

}
