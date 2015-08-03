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
<link rel="stylesheet" type="text/css" href="<?php echo ADDON_PUBLIC_PATH;?>/css/cartList.css">
<script type="text/javascript" src="<?php echo ADDON_PUBLIC_PATH;?>/js/cartList.js"></script>
<body id="shop">
<div class="top_navs">
	<div class="mainpage">
		<a href="/index.php?s=/addon/Shop/Shop/index.html"><span>首页</span></a>
	</div>
	<div class="nav_detail">
		<a href="#"><span>结算</span></a>
	</div>
</div>
<div class="container">
	<div class="user_detail">
		<div class="userinfo">
			<span>联&nbsp;系&nbsp;人&nbsp;:</span><input id="username" class="username" type='text'/><br />
			<span>联系电话:</span></span><input id="phone" class="phone" type='text'/><br />
			<span>详细地址:</span></span><input id="address" class="address" type='text' placeholder="省-市-区-详细地址"/><br />
		</div>
	</div>
	<?php if(is_array($list["goods"])): $i = 0; $__LIST__ = $list["goods"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="list cell_<?php echo ($vo['id']); ?>">
			<div class="title">
				<span>
					单价:￥<?php echo ($vo['discount_price']); ?>元
				</span>
				<!-- <a href="#" onclick="Cart.removeGoods(<?php echo ($vo['id']); ?>)">删除</a> -->
			</div>
			<div class="content">
				<div class="image">
					<img src="<?php echo ($vo['cover']); ?>">
				</div>
				<div class="describe">
					<div class="head">
						<span><?php echo ($vo['intro']); ?></span>
					</div>
					<div class="count">
						<span>数量:</span><?php echo ($vo['count']); ?>
					</div>
				</div>
			</div>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>

	<div class="sum">
		<span>总数量:<?php echo ($list["count"]); ?>件</span>&nbsp;&nbsp;
		<span>总金额:<?php echo ($list["total_fee"]); ?>元</span>
		<button class="jiesuan" onclick="Cart.jiesuan()" style="min-width:75px;">提交订单</button>
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