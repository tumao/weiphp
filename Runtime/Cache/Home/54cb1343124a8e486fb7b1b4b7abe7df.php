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
<script type="text/javascript" src="<?php echo ADDON_PUBLIC_PATH;?>/js/myorder.js"></script>
<body id="shop">
<div class="top_navs">
	<div class="mainpage">
		<a href="#"><span>首</span></a>
	</div>
	<div class="nav_detail">
		<a href="#"><span>我的订单</span></a>
	</div>
</div>
<div class="container">
	<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="order_cell order_<?php echo ($vo['id']); ?>">
			<div class="order_status">
				<?php if($vo['order_status'] =='inorder' ): ?>订单未支付
				<?php else: ?>
					已经发货/交易成功/已经支付成功，卖家尚未发货<?php endif; ?>
			</div>
			<div class="order_content">
				<img src="#" style="float:left; height:150px; ">
				<div class="float:left;">
					<div class="title">
						<?php echo ($vo['product_field']); ?>
					</div>
					<div>
						共计 <?php echo ($vo['count']); ?>件商品,合计 <span>￥100</span>
					</div>
				</div>
			</div>
			<div class="user_edit">
				<?php if($vo['order_status'] == 'inorder'): ?><input type="button" value="取消订单" onclick="Order.cancel(<?php echo ($vo['id']); ?>)">
				<?php else: ?>
					<input type="button" value="申请退货">
					<input type="button" value="确认收货"><?php endif; ?>
			</div>
		</div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<!-- 底部导航 -->
<?php echo ($footer_html); ?>
<!-- 统计代码 -->
<?php if(!empty($config["code"])): ?><p class="hide bdtongji">
<?php echo ($config["code"]); ?>
</p><?php endif; ?>
</body>
</html>