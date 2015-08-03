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

<div class="param_tab"><a class="cur setting" href="javascript:;">参数配置</a><a class="editwidget" href="javascript:;">高级配置</a></div>


<div class="tab1">


<!--参数配置模块 一般情况widget里的param.html继承此模板后只需要重写baseSetting代码块即可-->

<form id="baseSettingForm" class="edit_module_form form-horizontal">
	<div class="form-item">
    	<label class="item-label">显示模板:<span class="check-tips"></span></label>
        <div class="controls">
			<select name="template" id="template">
                <option value="simple" <?php if(($template) == "simple"): ?>selected<?php endif; ?> >一列商品列表模板</option>
                <option value="towrowsimple" <?php if(($template) == "towrowsimple"): ?>selected<?php endif; ?> >二列无背景模板</option>
                <option value="towrowwaterfall" <?php if(($template) == "towrowwaterfall"): ?>selected<?php endif; ?> >二列瀑布流模板</option>
                <option value="towrowalbum" <?php if(($template) == "towrowalbum"): ?>selected<?php endif; ?> >二列相册风格模板</option>
                <option value="towrowgrid" <?php if(($template) == "towrowgrid"): ?>selected<?php endif; ?> >二列格子风格模板</option>
                <option value="towrowcard" <?php if(($template) == "towrowcard"): ?>selected<?php endif; ?> >二列卡片风格模板</option>
                <option value="towrowtable" <?php if(($template) == "towrowtable"): ?>selected<?php endif; ?> >二列表格风格模板</option>
                <option value="threerowtable" <?php if(($template) == "threerowtable"): ?>selected<?php endif; ?> >三列图片报价模板</option>
                <option value="threerowblock" <?php if(($template) == "threerowblock"): ?>selected<?php endif; ?> >三列标题描述图片模板</option>

                <option value="$widget_id" id="custom_template" <?php if(($template) == "widget_id"): ?>selected<?php endif; ?> >自定义模板</option>

			</select>
		</div>
        <a class="edithtml" href="javascript:;">编辑模板</a>
	</div>
	<div class="form-item">
    	<label class="item-label">数据源:<span class="check-tips"></span></label>
        <div class="controls">
           <?php $data_from = intval($data_from); ?>
           <label class="radio"> <input type="radio" value="0" name="data_from" onClick="chang_data_from(this)" <?php if(($data_from) == "0"): ?>checked="checked"<?php endif; ?>>全部商品</label>
           <label class="radio"> <input type="radio" value="2" name="data_from" onClick="chang_data_from(this)" <?php if(($data_from) == "2"): ?>checked="checked"<?php endif; ?>>部分商品</label>
           <label class="radio"> <input type="radio" value="1" name="data_from" onClick="chang_data_from(this)" <?php if(($data_from) == "1"): ?>checked="checked"<?php endif; ?>>指定商品</label>
		</div>
	</div>  
	<div class="form-item" id="data_ids" style="display:<?php if(($data_from) != "1"): ?>none<?php endif; ?>">
    	<label class="item-label">商品ID:</label>
        <div class="controls">
        <span class="check-tips" style="padding:0">请输入商品ID，多个ID以英文逗号分割。如不清楚商品ID，可以查看商品管理的列表页面里的第一列数据</span><br/><br/>
           <label class="textarea" style=" width:510px;">
			<textarea class="textarea" name="data_ids" style=" width:500px;"><?php echo ($data_ids); ?></textarea></label>
		</div>
	</div>  
	<div class="form-item" id="data_condition" style="display:<?php if(($data_from) != "2"): ?>none<?php endif; ?>">
    	<label class="item-label">过滤条件:</label>
        <div class="controls">
        <span class="check-tips" style="padding:0">
        按分类过滤：cate_id=分类ID,多个分类ID用英文逗号分割，如果是动态的分类ID，用"[cate_id]"代替<br/>
        按关键词搜索：search_key=关键词,多个关键词用英文逗号分割，如果是动态关键词，用"[search_key]"代替<br/>
        购物车清单：shopping_list=1<br/>
        动态的分类ID（或关键词）具体数值是通过从GET或者POST里的参数名为cate_id（或search_key)取得<br/>
        以上条件可以混合使用，如可这样输入：cate_id=1,2,3&search_key=[search_key]&shopping_list=1<br/>
        </span><br/><br/>
           <label class="textarea" style=" width:510px;">
			<textarea class="textarea" name="data_condition" style=" width:500px;"><?php echo ($data_condition); ?></textarea></label>
		</div>
	</div>             
	<div class="form-item">
    	<label class="item-label">每页数:<span class="check-tips"></span></label>
        <div class="controls">
           <input name="list_row" type="number" value="10">
		</div>
	</div> 
	<div class="form-item">
    	<label class="item-label">排序:<span class="check-tips"></span></label>
        <div class="controls">
			<select name="order" id="order">
                <option value="" <?php if(($order) == ""): ?>selected<?php endif; ?> >无排序</option>
                <option value="id desc" <?php if(($order) == "id desc"): ?>selected<?php endif; ?> >按发布时间从新到旧</option>
                <option value="id asc" <?php if(($order) == "id asc"): ?>selected<?php endif; ?> >按发布时间从旧到新</option>
                <option value="view_count desc" <?php if(($order) == "view_count desc"): ?>selected<?php endif; ?> >按浏览量从大到小</option>
                <option value="view_count asc" <?php if(($order) == "view_count asc"): ?>selected<?php endif; ?> >按浏览量从小到大</option>
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

<form id="editwidgetForm" style="display:none" class="edit_module_form form-horizontal">
	<div class="form-item">
    	<label class="item-label">模块高度:</label>
        <div class="controls">
			<input name="widget_height" value="<?php echo ($widget_height); ?>" type="text">
            <span class="check-tips">为空时会根据内容自适应高度</span>
		</div>
	</div>
    <div class="form-item">
    	<label class="item-label">模块标题:</label>
        <div class="controls">
			<input name="widget_title" value="<?php echo ($widget_title); ?>" type="text">
            <span class="check-tips">为空时不显示模块的标题栏</span>
		</div>
	</div>
    
    <div class="form-col-more">
        <div class="form-item">
            <label class="item-label">更多标题:</label>
            <div class="controls">
                <input type="text" name="widget_more_title[]" class="text input-large" value="">
            </div>
        </div>

        <div class="form-item cf">
                <label class="item-label">超链接:<span class="check-tips"></span></label>
                <div class="controls">
                   <input type="text" name="widget_more_url[]" class="text input-large" value="">
                </div>
        </div>
        <div class="form-item cf">
            <label class="item-label"></label>
            <div class="controls">
               <a href="javascript:;" id="addWidgetMoreLink">添加</a>
                <a href="javascript:;" class="deleteBtn" onclick="$(this).parents('.form-col-more').remove();">删除</a>
            </div>
        </div>
    </div>
        	
    <div class="form-item cf">
    	<label class="item-label"></label>
        <div class="controls">
           <button type="button" id="editwidgetConfirm" class="btn submit-btn ajax-post" target-form="form-horizontal">确 定</button>
           <button type="button" class="btn preview_btn">预 览</button>
        </div>
    </div>
</form>


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
<script type="text/javascript">
function chang_data_from(obj){
  var val = $(obj).val();
  $('#data_condition').hide();
  $('#data_ids').hide();
	   
  if(val=='1'){
	  $('#data_ids').show();
  }else if(val=='2'){
	  $('#data_condition').show();
  }
};
</script>
</script>

</body>
</html>