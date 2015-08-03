<?php if (!defined('THINK_PATH')) exit();?><!--通用的参数配置页面基类模板-->
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<meta content="遵循Apache2开源协议,免费提供使用,微信功能插件化开发,多公众号管理,配置简单" name="keywords"/>
<meta content="weiphp 简洁强大开源的微信公众平台开发框架微信功能插件化开发,多公众号管理,配置简单" name="description"/>
<link rel="shortcut icon" href="<?php echo SITE_URL;?>/favicon.ico">
<title><?php echo empty($page_title) ? C('WEB_SITE_TITLE') : $page_title; ?></title>
<link href="/Public/static/font-awesome/css/font-awesome.min.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<link href="/Public/Home/css/base.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<link href="/Public/Home/css/module.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<link href="/Public/Home/css/weiphp.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="/Public/static/bootstrap/js/html5shiv.js?v=<?php echo SITE_VERSION;?>"></script>
<![endif]-->

<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/static/jquery-1.10.2.min.js"></script>
<![endif]-->
<!---蓝锂002适配修改 QQ:125682133--->
<!--[if gte IE 9]><!-->
<script type="text/javascript" src="/Public/static/jquery-2.0.3.min.js"></script>
<!--<![endif]-->
<script type="text/javascript" src="/Public/static/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/static/uploadify/jquery.uploadify.min.js"></script>
<script type="text/javascript" src="/Public/Home/js/dialog.js?v=<?php echo SITE_VERSION;?>"></script>
<script type="text/javascript" src="/Public/Home/js/admin_common.js?v=<?php echo SITE_VERSION;?>"></script>
<script type="text/javascript" src="/Public/Home/js/admin_image.js?v=<?php echo SITE_VERSION;?>"></script>
<script type="text/javascript">
var  STATIC = "/Public/static";
var  ROOT = "";
</script>
<!-- 页面header钩子，一般用于加载插件CSS文件和代码 -->
<?php echo hook('pageHeader');?>

<link href="/Public/Home/css/module.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet">
<script type="text/javascript" src="/Public/static/uploadify/jquery.uploadify.min.js"></script>
<!--CSS模块-->

<link href="<?php echo ADDON_PUBLIC_PATH;?>/css/diy.css?v=<?php echo SITE_VERSION;?>" rel="stylesheet" type="text/css">

</head>
<body>
<div class="param_wrap">
<!--标签切换模块-->

<div class="param_tab"><a class="cur setting" href="javascript:;">参数配置</a></div>


<div class="tab1">


<!--参数配置模块 一般情况widget里的param.html继承此模板后只需要重写baseSetting代码块即可-->

<form id="baseSettingForm" class="edit_module_form form-horizontal">
	<div class="form-item">
    	<label class="item-label">显示模板:<span class="check-tips"></span></label>
        <div class="controls">
			<select name="template" id="template">
					<option value="simple" <?php if(($template) == "simple"): ?>selected<?php endif; ?> >简约黑色菜单</option>
                    <option value="icon" <?php if(($template) == "icon"): ?>selected<?php endif; ?> >带图标黑色菜单</option>
                    <option value="pop" <?php if(($template) == "pop"): ?>selected<?php endif; ?> >弹出式菜单</option>

                    <option value="$widget_id" id="custom_template" <?php if(($template) == "widget_id"): ?>selected<?php endif; ?> >自定义模板</option>

			</select>
		</div>
        <a class="edithtml" href="javascript:;">编辑模板</a>
	</div>
    
    <div class="form-item">
    	<label class="item-label">数据源:<span class="check-tips"></span></label>
        <div class="controls">
			<select name="data_from" id="data_from">
					<option value="shop_footer" <?php if(($data_from) == "shop_footer"): ?>selected<?php endif; ?> >微商店的底部导航</option>
                    <option value="weisite_footer" <?php if(($data_from) == "weisite_footer"): ?>selected<?php endif; ?> >微官网的底部导航</option>
			</select>
		</div>
	</div>
    
    <div class="form-item cf">
    	<label class="item-label"></label>
        <div class="controls">
           <button type="button" id="confirm" class="btn submit-btn ajax-post" target-form="form-horizontal">确 定</button>
           <button type="button" class="btn preview_btn">预 览</button>
        </div>
    </div>
</form>


<!--高级配置模块-->



<!--编辑模板模块-->

    <form id="editHtmlForm" style="display:none" class="edit_module_form form-horizontal">
    <div>以下模板代码仅供有HTML等前端技术基础的用户用于高级定制，如你不熟悉代码请尽量不要修改</div>
        <textarea id="htmlTextarea" name="html"></textarea>
        <div class="form-item cf">
            
               <button type="button" id="saveHtmlBtn" class="btn submit-btn ajax-post" target-form="form-horizontal">保存</button>
        </div>
    </form>

</div>
<!--预览模块


-->
<!--JS模块-->

<script src="<?php echo ADDON_PUBLIC_PATH;?>/js/form.js?v=<?php echo SITE_VERSION;?>" type="text/javascript"></script> 

</body>
</html>