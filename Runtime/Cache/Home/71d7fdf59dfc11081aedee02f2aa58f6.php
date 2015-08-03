<?php if (!defined('THINK_PATH')) exit();?><!-- 头部 -->
<!DOCTYPE html>
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
<body>
	<div class="container body">
    	<img src="<?php echo ADDON_PUBLIC_PATH;?>/img/suggest_head.png" width="100%"/>
    	<div class="p_10">
            <!-- 表单 -->
            <form method="post">
              <!-- 基础文档模型 -->
              <div id="tab1" class="tab-pane">
                   <div class="form-item cf">
                        <label class="item-label">请填写评论</label>
                        <div class="controls">
                          <input type="hidden" value="<?php echo ($id); ?>" name="id" />
                          <input type="hidden" value="<?php echo ($oid); ?>" name="oid" />
                          <label class="textarea input-large"><textarea name="comment" id="comment"></textarea></label>
                        </div>
                   </div>
                   <div class="form-item cf tb pt_10">
                		<button class="home_btn submit-btn mb_10 flex_1" id="submit" type="submit" target-form="form-horizontal">提  交</button>
                  </div>
          	</div>
            </form>
        </div>
        <!-- <p class="copyright">2014&copy;WeiPHP</p> -->
        <script type="text/javascript">
			$('.submit-btn').click(function(){
				//$.Dialog.loading();//loading等待调用  loading完成$.Dialog.close();关闭loading
				//$.Dialog.success();//成功调用 提示一秒后自动关闭
				if($('#comment').val()==""){
					$.Dialog.fail("请填写评论内容！");//成功调用 提示一秒后自动关闭
					return false;
				}
				})
		</script>
    </div>
</body>
</html>