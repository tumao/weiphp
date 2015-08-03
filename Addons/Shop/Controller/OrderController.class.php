<?php

namespace Addons\Shop\Controller;

use Addons\Shop\Controller\BaseController;
use Addons\Shop\Model\OrderModel;

class OrderController extends BaseController {

	var $model;

	public function _initialize()
	{
		$this->model = $this->getModel('shop_order');
		parent::_initialize();
	}

	public function lists()
	{
		$normal_tips = '订单列表';
		$this->assign('normal_tips', $normal_tips);

		$orders = M('shop_order');
		$map['token'] = get_token();
		session('common_condition', $map);

		$list_data = $this->_get_model_list($this->model);
		foreach($list_data['list_data'] as &$vo)
		{
			$vo['timestamp'] = date('Y-m-d H:i:s',$vo['timestamp']);
			$userinfo = json_decode($vo['userinfo']);
			$vo['userinfo'] = $userinfo->nickname.'-'.$userinfo->phone.'-'.$userinfo->address;
			if($vo['order_status'] == 'inorder'){
				$vo['order_status'] = '已下单，未支付';
			}
			elseif($vo['order_status'] == 'paied')
			{
				$vo['order_status'] = '已支付';
			}
			elseif($vo['order_status'] == 'orderOk')
			{
				$vo['order_status'] = '订单已经确认';
			}
			elseif($vo['order_status'] ==  'cancled')
			{
				$vo['order_status'] = '订单已经取消';
			}
			elseif($vo['order_status'] == 'returnGoods')
			{
				$vo['order_status'] = '申请退货';
			}
			elseif($vo['order_status'] == 'agreeReturn')
			{
				$vo['order_status'] = '同意退货';
			}
		}

		$this->assign($list_data);

		$templateFile = $this->model['template_list'] ? $this->model['template_list'] : '';
		$this->display($templateFile);
	}

	// 同意退款
	public function agreeReturn()
	{
		$id = $_REQUEST['id'];

		$Order = new OrderModel;

		$Order->turnOrderStatus($id, 'agreeReturn');	//同意退货
	}




}
