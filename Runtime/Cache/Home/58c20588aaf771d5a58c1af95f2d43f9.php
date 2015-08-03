<?php if (!defined('THINK_PATH')) exit();?><!--通用的diy页面widget模板的基类模板-->
<!--头部标题栏-->
<!--鉴于样式title放进具体每块模块-->
<!--CSS模块-->


	<?php if(!empty($widget_title) || !empty($widget_more_title[0])): ?><div class="widget_title">
            <?php if(!empty($widget_title)): ?><h2><?php echo ($widget_title); ?></h2><?php endif; ?>
            
            <?php if(!empty($widget_more_title["0"])): if(is_array($widget_more_title)): $k = 0; $__LIST__ = $widget_more_title;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$title): $mod = ($k % 2 );++$k;?><div class="more"><a href="<?php echo ($widget_more_url[$k]); ?>"><?php echo ($title); ?></a></div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </div><?php endif; ?>


<!--widget内容块 一般情况widget里的显示模板继承此模板后只需要重写widget_content代码块即可-->

<!-- 底部导航最多能添加4个选项 -->
<style>
/* 底部菜单 */
.bottom_nav_blank{ height:50px; width:100%;}
.bottom_nav{ height:50px; width:100%; background:#2e393f url(<?php echo SITE_URL;?>/Addons/Diy/Widget/Footer/bg.png); background-size:100% 100%;display:-webkit-box; position:fixed; bottom:0; left:0; right:0; z-index:1000;}
.bottom_nav .item{ color:#fff; display:block; padding:5px 0; font-weight:bold; text-align:center; -webkit-box-flex:1;line-height:40px; font-size:16px;}
.bottom_nav .item.cur{ background-color:#111}
.bottom_nav .has_nav{ position:relative;}
.more_nav{ position:absolute; right:5%; left:5%;bottom:60px; width:90%; height:auto; background:#3b3d40; display:none;}
.more_nav em{ width:10px; height:10px; background:#2e393f; position:absolute; left:50%; margin-left:-5px; bottom:-3px; -webkit-transform:rotate(45deg);}
.bottom_nav .more_nav a{ padding:0; line-height:40px; font-size:13px; border-bottom:1px solid #555}
.arrow_up{ background:url(<?php echo SITE_URL;?>/Addons/Diy/Widget/Footer/arrow_up.png) no-repeat center center; background-size:15px auto; padding:10px; margin-left:5px}
#actionLayoutBody .bottom_nav,#diyPreviewBody .bottom_nav{ position:static}
</style>

<nav class="bottom_nav">
<?php if(is_array($footer)): $i = 0; $__LIST__ = $footer;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i; if(empty($vo['child'])): ?><a class="item" href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["title"]); ?></a>
<?php else: ?>
    <div class="item has_nav" href="javascript:;" onClick="$(this).find('#more_nav_<?php echo ($vo["id"]); ?>').toggle();">
    	<?php echo ($vo["title"]); ?><em class="arrow_up"></em>
    	<div class="more_nav" id="more_nav_<?php echo ($vo["id"]); ?>">
        	<em></em>
        	<?php if(is_array($vo["child"])): $i = 0; $__LIST__ = $vo["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><a href="<?php echo ($vv["url"]); ?>"><?php echo ($vv["title"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
        </div>
    </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
</nav>


<!--JS模块-->