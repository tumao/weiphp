<?php

namespace Addons\Shop\Controller;

use Addons\Shop\Controller\BaseController;
use Addons\Shop\Model\ProductModel;
use Addons\Shop\Model\OrderModel;

class ShopController extends BaseController {

	function lists()
	{
		header('Location:/index.php?s=/addon/Shop/Shop/config.html');
	}
	function config() {
		// 使用提示
		$param ['token'] = get_token ();
		$normal_tips = '在微信里回复商店名或者通过地址访问商店：' . addons_url ( 'Shop://Shop/index', $param ) . ' ，也可点击<a target="_blank" href="' . U ( 'index', $param ) . '">这里</a>在预览';
		$this->assign ( 'normal_tips', $normal_tips );

		if (IS_POST) {
			D ( 'Common/Keyword' )->set ( $_POST ['config'] ['title'], _ADDONS, 1, 0 );
		}

		parent::config ();
	}
	// 引导入口
	function ad(){
		echo diyPage( '引导入口' );
	}

	// 商店首页
	function index() {
		// 增加积分
		add_credit( 'shop', 86400 );

		echo diyPage( '微商店' );
	}
	// 搜索页面+商品分类
	function search() {
		echo diyPage ( '商品分类' );
	}
	// 商品列表
	function products() {
		echo diyPage ( '商品列表' );
	}
	// 商品详情
	function detail() {
		echo diyPage ( '商品详情' );
	}
	// 购物车
	function shopping_cart() {
		$key = 'buy_list_' . $this->mid;
		$list = ( array ) session ( $key );
		foreach ( $list as $v ) {
			$ids [] = $v ['id'];
			$bug_list [$v ['id']] = $v;
		}

		$map ['id'] = array (
				'in',
				$ids
		);
		$products = M( 'shop_product' )->where ( $map )->select ();
		foreach ( $list as &$vo ) {
			$vo = array_merge ( $vo, $bug_list [$vo ['id']] );
		}

		$this->assign ( 'list', $products );
		$this->display ();
	}
	// 个人中心
	function personal() {
		$this->display ();
	}


	// 向购物车中添加物品
	public function addCart($goods_id = 0, $goods_count = 0)
	{
		$inCart = false;
		if($goods_id == 0 || $goods_count == 0)
		{
			if(!isset($_REQUEST['goods_id']))
			{
				exit('error:can not find goods id');
			}
			$goods_id = $_REQUEST['goods_id'];

			if(!isset($_REQUEST['goods_count']))
			{
				exit('error:can not find goods count');
			}
			$goods_count = $_REQUEST['goods_count'];
		}

		$goods = unserialize(cookie('goods'));

		if($goods !== null && !empty( $goods))	//查看购物车内是否有商品
		{
			foreach($goods as & $vo)
			{
				if( $vo['id'] == $goods_id)	//如果购物车内商品和新添加的为同种是商品，则累加
				{
					// $vo['count'] += $goods_count;
					//$inCart = true;		//该货物在购物车里
					exit(json_encode(array('code' => -1, 'info'=> '购物车中已经存在该物品!')));
				}
			}
			if(!$inCart)	//该货物没有在购物车里
			{
				$goods[] = array(
					'id' 	=> intval($goods_id),
					'count' => intval($goods_count)
				);
			}
		}
		else
		{
			$goods[] = array(
						'id' 	=> intval($goods_id),
						'count' => intval($goods_count)
					);
		}

		cookie('goods', serialize($goods));
		exit(json_encode(array('code' => 1, 'info' => '添加成功', 'count' => count($goods))));
	}
		// 购物车内货物
	public function cartList()
	{
		$pd = new ProductModel;
		$goods = unserialize(cookie('goods'));
		$order = array();
		$sum = 0;
		if($goods !== null && !empty($goods))
		{
			foreach ($goods as $x)
			{
				$map['id'] = $x['id'];
				$cell = $pd->productDetail($map);
				$cell['cover'] = get_cover_url($cell['cover']);
				$cell['count'] = $x['count'];
				$order[] = $cell;
				$sum += $cell['discount_price'] * $x['count'];
			}
		}

		$this->assign('sum', $sum);
		$this->assign('cartList', $order);
		$this->display('cartList');
	}

	//清空购物车
	public function setCartEmpty()
	{
		cookie('goods', null);
		echo json_encode(array('code' => '1', 'info' => '购物车已清空'));
	}

	//删除购物车内的某件物品
	public function removeGoods()
	{
		if(!isset($_REQUEST['id']))
		{
			exit('error: id parm is required');
		}
		$id = $_REQUEST['id'];
		$goods = unserialize(cookie('goods'));
		foreach($goods as $k => $v)
		{
			if($v['id'] == $id)
			{
				unset($goods[$k]);
			}
		}
		cookie('goods', serialize($goods));
		echo json_encode(array('code'=> 1, 'info' => '删除物品成功！'));
	}
	// 订单详情+个人信息
	public function orderShow()
	{
		$pd = new ProductModel;
		$goods = unserialize(cookie('goods'));
		$order = array();

		$sum = 0;
		$count = 0;
		$total_fee = 0;

		foreach ($goods as $x)
		{
			$map['id'] = $x['id'];		//商品id
			$cell = $pd->productDetail($map);	//通过商品id 获取商品详情
			$cell['cover'] = get_cover_url($cell['cover']);
			$cell['count'] = $x['count'];
			$order[] = $cell;
			$sum += $cell['discount_price'] * $x['count'];
			$count += $x['count'];
		}

		$total_fee = $sum;
		cookie('total_fee', $total_fee);
		$result = array(
			'total_fee' => $total_fee,
			'count'	=> $count,
			'goods'	=> $order
			);
		$this->assign('list', $result);
		$this->display('orderShow');
	}

	public function addOrder()
	{
		if(!isset($_REQUEST['username']))
		{
			exit(json_encode(array('code'=> -1, 'info'=> '用户名不可为空')));
		}
		elseif(!isset($_REQUEST['phone']))
		{
			exit(json_encode(array('code'=> -1, 'info'=> '联系电话不可为空')));
		}
		elseif(!isset($_REQUEST['address']))
		{
			exit(json_encode(array('code'=> -1, 'info'=> '地址不可为空')));
		}

		$username = $_REQUEST['username'];
		$phone = $_REQUEST['phone'];
		$address = $_REQUEST['address'];
		$openid = get_openid();
		// $openid = 'osALzjvsweDff9UGcO13UWf2uYbw';
		$ip = $_SERVER["REMOTE_ADDR"] ? $_SERVER["REMOTE_ADDR"] :'1.1.1.1';	//获取用户ip
		$body = '';
		$cartTotalPrice = 0;		//购物车内商品总价

		$umap = array(
			'openid'	=> $openid,
			'nickname'	=> $username,
			'phone'		=> $phone,
			'address'	=> $address,
			'ctime' 	=> date('Y-m-d H:i:s'),
			);
		$order = new OrderModel;
		$userid = $order->addUser($umap);	//添加或者更新用户，获得id

		$total_fee = cookie('total_fee');
		$goods = unserialize(cookie('goods'));	//获取货物的id列表

		$pd= new ProductModel;
		$goodslist = array();	//商品详情列表
		foreach($goods as $x)
		{
			$cell = $pd->productDetail(array('id'=> $x['id']));
			$cell['count'] = $x['count'];
			$cell['total_fee'] = $cell['discount_price'] * $x['count'];
			$cartTotalPrice += $cell['total_fee'];			//购物车内商品总价
			$cell['unit_price'] = $cell['discount_price'];	//单价
			$body .= $cell['title'];						//传到微信接口的商品名
			$cell['pid'] = $x['id'];	//商品的id
			$goodslist[] = $cell;
		}

		$orderlist = array(		//订单列表，包括收件人的联系方式
			'user_id'=>$userid,
			// 'total_fee'		=> $total_fee,	//总金额，单位：元
			'ip'			=> $ip,
			'userinfo'		=> json_encode($umap),
			'order_status'	=> 'inorder',
			'timestamp'		=> time(),
			);
		$orderId = $order->addOrder($orderlist,$goodslist);
		if($orderId)	//购物车内的物品转到订单成功
		{
			cookie('goods', null);	//清空购物车
		}
		$notify_url = 'http://rchangchu.com/index.php?s=/addon/Shop/Shop/notify.html';  //接受回调的接口地址

		$condition = array(
				'body'=>	$body,
				'out_trade_no'	=> $orderId[0],
				'spbill_create_ip'	=> $ip,	//下单地址
				'total_fee'	=> $cartTotalPrice,//总费用
				'notify_url'	=> $notify_url,
			);

		$msg = $this->wxUnityOrder($condition);
		// dump($msg);exit;
		$newSignArr = array(
			'appId'	=> (string)$msg['appid'],
			'nonceStr' 	=> (string)$msg['nonce_str'],
			'package'	=> 'prepay_id='.$msg['prepay_id'],
			'signType' 	=> 'MD5',
			'timeStamp' => (string)time(),
			);
		$pay_conf = $pay_conf = D ( 'Common/AddonConfig' )->get ( 'ShopPay' );	//获取微支付的配置信息
		$key = $pay_conf['api_key'];
		$newSign = $this->getSign($newSignArr, $key);
		$newSignArr['paySign'] = $newSign;
		$newSignArr['out_trade_nos'] = $orderId;
		echo json_encode($newSignArr);
	}

	/**
	 * 	微信统一下单
	 *
	 *	$condition 数组 键 body,out_trade_no,spbill_create_ip,total_fee(单位：元),notify_url
	 */
	public function wxUnityOrder($condition)
	{
		$url = $url = "https://api.mch.weixin.qq.com/pay/unifiedorder";	//微信支付接口地址
		$pay_conf = D ( 'Common/AddonConfig' )->get ( 'ShopPay' );	//获取微支付的配置信息

		$key = $pay_conf['api_key'];	//微信支付的api秘钥
		$nonce_str = $this->getNonceStr('12312313123'); //随机字符串，随机的... <=32位
		$openid = get_openid();
		// $openid = 'osALzjvsweDff9UGcO13UWf2uYbw';

		$arr = array(
			'appid'=> $pay_conf['appid'],				//
			'body' =>$condition['body'],							//商品详情
			'mch_id' => $pay_conf['mch_id'],						//微信支付的mch_id
			'nonce_str' => $nonce_str,								//随机字符串
			'notify_url' => $condition['notify_url'],				//回调地址
			'openid' => $openid,									//用户的openid
			'out_trade_no' => $condition['out_trade_no'],			//商户内部订单号
			'spbill_create_ip' => $condition['spbill_create_ip'],	//下单地址
			'total_fee' => $condition['total_fee'],				//总金额，转换后单位：分
			'trade_type' => 'JSAPI',								//JSAPI
			);

		$sign = $this->getSign($arr, $key);	//获取签名
		$arr['sign'] = $sign;
		$para = $this->putIntoXml($arr);		//xml格式
		$result = $this->sentPost($url, $para);
		$msg = (array)simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA);	//处理返回的xml,转为数组
		return $msg;

	}


	public function notify()
	{
		$input = file_get_contents("php://input", 'r');
		$result = (array)simplexml_load_string($input, 'SimpleXMLElement', LIBXML_NOCDATA);
		$result['time'] = date('Y-m-d H:i:s');
		$map['result'] = json_encode($result);
		M('shop_notify')->add($map);
	}

	// 查看订单是否成功
	public function payingStatus()
	{
		$out_trade_nos = $_REQUEST['out_trade_nos'];
		$out_trade_no = $out_trade_nos[0];
		$url = "https://api.mch.weixin.qq.com/pay/orderquery";
		$nonce_str = $this->getNonceStr('111222333');	//随机字符串
		$pay_conf = D ( 'Common/AddonConfig' )->get ( 'ShopPay' );	//获取微支付的配置信息
		$order = array(
			'appid'	=> $pay_conf['appid'],
			'mch_id'		=> $pay_conf['mch_id'],
			'nonce_str'		=> $nonce_str,
			'out_trade_no'	=> $out_trade_no,
			);
		$sign = $this->getSign($order);
		$order['sign'] = $sign;
		$xml = $this->generateXml($order);
		$result = $this->sentPost($url, $xml);
		$msg = (array)simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA);
		// dump($msg);
		if($msg['return_code'] == 'SUCCESS' && $msg['trade_state'] == 'SUCCESS')
		{
			$Order = new OrderModel;
			foreach($out_trade_nos as $x){
				$Order->turnOrderStatus($x, 'paied');
			}
			echo json_encode(array('code'=> 1, 'info'=>'SUCCESS','url'=>'/index.php?s=/addon/Shop/Shop/myOrder/token/'.get_token().'.html'));
		}
	}

	private function kvglue($array)
	{
		$str = '';
		foreach ($array as $key => $value)
		{
			if($str !== '')
			{
				$str .= '&'.$key.'='.$value;
			}
			else
			{
				$str = $key.'='.$value;
			}
		}
		return $str;

	}

	private function putIntoXml($arr)
	{
		$para = "<xml>";
		$para .="<appid>".$arr['appid']."</appid>";
		$para .="<body>".$arr['body']."</body>";
		$para .="<mch_id>".$arr['mch_id']."</mch_id>";
		$para .="<nonce_str>".$arr['nonce_str']."</nonce_str>";
		$para .="<notify_url>".$arr['notify_url']."</notify_url>";
		$para .="<openid>".$arr['openid']."</openid>";
		$para .="<out_trade_no>".$arr['out_trade_no']."</out_trade_no>";
		$para .="<spbill_create_ip>".$arr['spbill_create_ip']."</spbill_create_ip>";
		$para .="<total_fee>".$arr['total_fee']."</total_fee>";
		$para .="<trade_type>".$arr['trade_type']."</trade_type>";
		$para .="<sign>".$arr['sign']."</sign>";
		$para .="</xml>";
		return $para;
	}

	//获取签名
	private function getSign($arr, $key='')
	{
		if($key == '')
		{
			$key = "c23b76fe5a1c7befb230debe7cdcdc83";
		}
		$stringA = $this->kvglue($arr);
		$stringSignTemp = $stringA."&key=$key";
		$sign = md5($stringSignTemp);
		$sign = strtoupper($sign);		//签名
		return $sign;

	}
	// xml POST请求
	private function sentPost($url, $para, $certUrl='')
	{
		$curl = curl_init();
 		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);//SSL证书认证
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);//严格认证
		if($certUrl !== '')
		{
			curl_setopt($curl, CURLOPT_CAINFO,$certUrl);//证书地址
		}
		curl_setopt($curl, CURLOPT_HEADER, 0 ); // 过滤HTTP头
		curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);// 显示输出结果
		curl_setopt($curl,CURLOPT_POST,true); // post传输数据
		curl_setopt($curl,CURLOPT_POSTFIELDS,$para);// post传输数据
		$responseText = curl_exec($curl);
		curl_close($curl);
		return $responseText;
	}

	// 返回一个32位 随机 字符串
	private function getNonceStr($nonce_key = '')
	{
		$rand = rand(1,1000);
		$rand  = $rand.$nonce_key;
		$nonce_str = md5($rand, false);
		return $nonce_str;
	}

	//生成xml
	private function generateXml($arr)
	{
		$xml = '<xml>';
		foreach($arr as $k => $x)
		{
			$xml .= "<$k>".$x."</$k>";
		}
		$xml .= '</xml>';
		return $xml;

	}

	// 设置商品的数量
	public function setProductTotal()
	{
		$id = $_REQUEST['id'];			//商品的id
		$count = $_REQUEST['count'];	//商品的数量
		if($count <= 0)
		{
			exit('error: product count wrong');
		}
		$goods = unserialize(cookie('goods'));

		foreach($goods as & $x)
		{
			if($x['id'] == $id){
				$x['count'] = $count;
			}
		}
		cookie("goods", serialize($goods));
	}

	// 我的订单
	public function myOrder()
	{
		$openId = get_openid();	//获取用户的openid

		if(!$openId)
		{
			exit('error: can not find openId');
		}
		$Order = new OrderModel;
		$myOrder = $Order->myOrder();
		$this->assign('list', $myOrder);
		$this->display('myOrder');
	}

	// 对已经形成的订单，但是未支付的订单进行结算
	public function jiesuan()
	{
		$id = $_REQUEST['id'];
		$Order = new OrderModel;		//模型
		$order = $Order->getOrderById($id);
		$notify_url = 'http://rchangchu.com/index.php?s=/addon/Shop/Shop/notify.html';  //接受回调的接口地址
		// $notify_url = "http://www.rchangchu.com/";
		$condition = array(
			'body'	=> $order['title'],
			'notify_url'	=> $notify_url,
			'out_trade_no'	=> $id,
			'spbill_create_ip'	=> '1.1.12.3',
			'total_fee'		=> $order['total_fee'],
			);
		// dump($condition);exit;
		$msg = $this->wxUnityOrder($condition);

		$newSignArr = array(
			'appId'	=> (string)$msg['appid'],
			'nonceStr' 	=> (string)$msg['nonce_str'],
			'package'	=> 'prepay_id='.$msg['prepay_id'],
			'signType' 	=> 'MD5',
			'timeStamp' => (string)time(),
			);
		$pay_conf = D ( 'Common/AddonConfig' )->get ( 'ShopPay' );	//获取微支付的配置信息
		$key = $pay_conf['api_key'];		//微信支付的api秘钥
		$newSign = $this->getSign($newSignArr, $key);	//获取签名
		$newSignArr['paySign'] = $newSign;
		$out_trade_nos[] = $id;
		$newSignArr['out_trade_nos'] = $out_trade_nos;
		echo json_encode($newSignArr);
	}

	// 取消订单
	public function cancleOrder()
	{
		$orderId = $_REQUEST['id'];
		$Order = new OrderModel;
		$status = M('shop_order')->where(array('id'=>$orderId))->field('order_status')->select();
		if($status[0]['order_status'] == 'inorder')	//下订单，未发货
		{
			$Order->turnOrderStatus($orderId, 'cancled');
			echo json_encode(array('code'=>1, 'info'=> '订单已经取消'));
			exit;
		}
		echo json_encode(array('code'=>-1, 'info'=>'订单不可取消'));
	}

	// 申请退款
	public function returnGoods()
	{
		$orderId = $_REQUEST['id'];
		$Order = new OrderModel;

		$Order->turnOrderStatus($orderId, 'returnGoods');	//申请退货
	}

}
