<?php

namespace Addons\Shop\Controller;

use Addons\Shop\Controller\BaseController;

class UserController extends BaseController
{
	var $model;

	public function _initialize()
	{
		$this->model = $this->getModel('shop_user');
		parent::_initialize();
	}

	public function lists()
	{
		$normal_tips = '会员列表';
		$this->assign('normal_tips', $normal_tips);

		$users = M('shop_user');
		$map['token'] = get_token();
		session('common_condition', $map);

		$list_data = $this->_get_model_list($this->model);

		$this->assign($list_data);

		$templateFile = $this->model['template_list'] ? $this->model['template_list'] : '';
		$this->display($templateFile);
	}

	public function edit()
	{
		parent::common_edit($this->model);
	}

	public function delete()
	{
		parent::common_del($this->model);
	}

	public function info()
	{
		$token = get_token();
		$openid = get_openid();
		$wxUserinfo = getWeixinUserInfo($openid, $token);
		// dump($wxUserinfo);exit;
		$map['token'] = $token;
		$map['openid'] = $openid;
		$info = M('shop_user')->where($map)->find();
		$info['headimgurl'] = $wxUserinfo['headimgurl'];
		$info['sex'] = $wxUserinfo['sex'] ? '女' : '男';
		$info['wxnickname'] = $wxUserinfo['nickname'];	//微信昵称
		$this->assign('info', $info);
		$this->display('info');
	}
}