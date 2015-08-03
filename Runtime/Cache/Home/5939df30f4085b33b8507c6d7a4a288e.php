<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/font-awesome.css?v=<?php echo SITE_VERSION;?>" media="all">
	<link rel="stylesheet" type="text/css" href="/Public/Home/css/mobile_module.css?v=<?php echo SITE_VERSION;?>" media="all">
    <script type="text/javascript" src="/Public/static/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/Public/Home/js/prefixfree.min.js"></script>
    <script type="text/javascript" src="/Public/Home/js/m/dialog.js?v=<?php echo SITE_VERSION;?>"></script>
    <script type="text/javascript" src="/Public/Home/js/m/flipsnap.min.js"></script>
    <script type="text/javascript" src="/Public/Home/js/m/mobile_module.js?v=<?php echo SITE_VERSION;?>"></script>
    <script type="text/javascript" src="/Public/Home/js/admin_common.js?v=<?php echo SITE_VERSION;?>"></script>
	<title><?php echo empty($page_title) ? C('WEB_SITE_TITLE') : $page_title; ?></title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta content="application/xhtml+xml;charset=UTF-8" http-equiv="Content-Type">
    <meta content="no-cache,must-revalidate" http-equiv="Cache-Control">
    <meta content="no-cache" http-equiv="pragma">
    <meta content="0" http-equiv="expires">
    <meta content="telephone=no, address=no" name="format-detection">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <link rel="shortcut icon" href="<?php echo SITE_URL;?>/favicon.ico">
</head>
<link rel="stylesheet" type="text/css" href="<?php echo ADDON_PUBLIC_PATH;?>/css/myOrder.css">
<link rel="stylesheet" type="text/css" href="<?php echo ADDON_PUBLIC_PATH;?>/css/userinfo.css">
<script type="text/javascript" src="<?php echo ADDON_PUBLIC_PATH;?>/js/userinfo.js"></script>
<body id="shop">
<div class="top_navs">
	<div class="mainpage">
		<a href="/index.php?s=/addon/Shop/Shop/index.html"><span>首页</span></a>
	</div>
	<div class="nav_detail">
		<a href="#"><span>个人信息</span></a>
	</div>
</div>
<div class="container">
	<div class="userinfo">
		<div class="photo">
			<img src="http://wx.qlogo.cn/mmopen/wiahEqaWVlR1bs549kGFUkuglTSZxphaPOceyasT75lFbiaib4D6j03OOlTvz7iaaoSHJ16PEmUNRZeBXMEOicTo7oqiazQr1ibMBLo/0">
		</div>
		<div class="userinfo_detail">
			<span>昵称:fb</span>
			<span>性别:男</span>
		</div>
	</div>
	<div class="asset">
		<div class="asset_cell">
			<span class="asset_title">余额:</span> <span class="asset_val">3.25元</span>
		</div>
		<div class="asset_cell">
			<span class="asset_title">积分:</span> <span class="asset_val">3分</span>
		</div>
	</div>

	<div class="asset">
		<div class="asset_cell">
			<span class="asset_title">直接会员:</span> <span class="asset_val">3人</span>
		</div>
		<div class="asset_cell">
			<span class="asset_title">间接会员:</span> <span class="asset_val">10人</span>
		</div>
	</div>

	<div class="asset">
		<div class="asset_cell">
			<span class="asset_title">直接会员下单:</span> <span class="asset_val">3单</span>
		</div>
		<div class="asset_cell">
			<span class="asset_title">间接会员下单:</span> <span class="asset_val">10单</span>
		</div>
	</div>
</div>
<!-- 底部导航 -->
<?php echo ($footer_html); ?>
<!-- 统计代码 -->
<?php if(!empty($config["code"])): ?><p class="hide bdtongji">
<?php echo ($config["code"]); ?>
</p><?php endif; ?>
</body>
</html>