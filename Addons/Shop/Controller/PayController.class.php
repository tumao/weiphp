<?php

namespace Addons\Shop\Controller;

use Addons\Shop\Controller\BaseController;

class PayController extends BaseController {
	public function config() {
		if (IS_POST) {
			$flag = D ( 'Common/AddonConfig' )->set ( 'ShopPay', I ( 'config' ) );

			if ($flag !== false) {
				$this->success ( '保存成功', Cookie ( '__forward__' ) );
			} else {
				$this->error ( '保存失败' );
			}
		}

		$addon ['config'] = $this->pay_fields ();
		$db_config = D ( 'Common/AddonConfig' )->get ( 'ShopPay' );
		if ($db_config) {
			foreach ( $addon ['config'] as $key => $value ) {
				! isset ( $db_config [$key] ) || $addon ['config'] [$key] ['value'] = $db_config [$key];
			}
		}
		$this->assign ( 'data', $addon );
		// dump($addon);

		// 使用提示
		$normal_tips = '所有项目必填，不可为空，否则会支付失败';
		$this->assign ( 'normal_tips', $normal_tips );

		$this->display ();
	}

	function pay_fields() {
		return array (
				'appid' => array (
						'title' => 'APPID:',
						'type' => 'text',
						'value' => '',
						'tip' => '公众账号的id--wx*****'
				),
				'mch_id' => array (
						'title' => 'MCH_ID:',
						'type' => 'text',
						'value' => '',
						'tip' => '微信支付分配的商户号'
				),
				'signtype' => array (
						'title' => 'SIGNTYPE:',
						'type' => 'text',
						'value' => 'MD5',
						'tip' => 'method'
				),
				'api_key' => array (
						'title' => 'APIKEY:',
						'type' => 'text',
						'value' => '',
						'tip' => '微信支付的API秘钥'
				),
		);
	}

	//	商户支付
	public function mchPay()
	{
		$url = "https://api.mch.weixin.qq.com/mmpaymkttransfers/promotion/transfers";
		$sitePath = SITE_PATH;
		$certPath = $sitePath."/Addons/Shop/View/default/Public/cert/";
		$certArr = array(
			'cert'	=> $certPath.'apiclient_cert.pem',
			'key'	=> $certPath.'apiclient_key.pem',
			'rootca'	=> $certPath.'rootca.pem'
			);
		// echo $certUrl;exit;
		$pay_conf = D ( 'Common/AddonConfig' )->get ( 'ShopPay' );
		$openid = get_openid();
		$postArr = array(
			'ammount'	=> 1, //支付费用
			'check_name'=> 'NO_CHECK', //是否对实名认证的用户支付
			'desc'		=> '佣金',
			'mchid'		=> $pay_conf['mch_id'],
			'mch_appid'	=> $pay_conf['appid'],
			'nonce_str'	=> '123kl2jk3o12j3o12j3oi13',
			'openid'	=> $openid,
			'partner_trade_no'	=> '123456',
			'spbill_create_ip'	=> '124.60.33.28'
			);
		$key = $pay_conf['api_key'];
		$sign = $this->getSign($postArr, $key);
		$postArr['sign'] = $sign;
		// $xml = $this->putIntoXml($postArr);
		$xml = $this->generateXml($postArr);
		$res = $this->sentPost($url, $xml, $certArr);
		$msg = (array)simplexml_load_string($result, 'SimpleXMLElement', LIBXML_NOCDATA);
		dump($msg);
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
	private function sentPost($url, $para, $certArr=array())
	{
		$curl = curl_init();
 		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//SSL证书认证
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);//严格认证
		curl_setopt($curl, CURLOPT_VERBOSE, 1); //debug模式
		if(!empty($certArr))
		{
			curl_setopt($curl, CURLOPT_SSLCERT, $cerArr['cert']);
			curl_setopt($curl, CURLOPT_SSLKEY, $certArr['key']);
			curl_setopt($curl, CURLOPT_CAINFO, $cert['rootca']);
			curl_setopt($curl, CURLOPT_SSLKEYPASSWD, 'c23b76fe5a1c7befb230debe7cdcdc83');
		}
		curl_setopt($curl, CURLOPT_HEADER, 0 ); // 过滤HTTP头
		curl_setopt($curl,CURLOPT_RETURNTRANSFER, 1);// 显示输出结果
		curl_setopt($curl,CURLOPT_POST,true); // post传输数据
		curl_setopt($curl,CURLOPT_POSTFIELDS,$para);// post传输数据
		$responseText = curl_exec($curl);
		dump(curl_error($curl));exit;
		curl_close($curl);
		return $responseText;
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
}
