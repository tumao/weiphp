<?php if (!defined('THINK_PATH')) exit();?><!--通用的diy页面widget模板的基类模板-->
<!--头部标题栏-->
<!--鉴于样式title放进具体每块模块-->
<!--CSS模块-->



<!--widget内容块 一般情况widget里的显示模板继承此模板后只需要重写widget_content代码块即可-->

<div class="diy_shop category_tworow_block">
	
	<?php if(!empty($widget_title) || !empty($widget_more_title[0])): ?><div class="widget_title">
            <?php if(!empty($widget_title)): ?><h2><?php echo ($widget_title); ?></h2><?php endif; ?>
            
            <?php if(!empty($widget_more_title["0"])): if(is_array($widget_more_title)): $k = 0; $__LIST__ = $widget_more_title;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$title): $mod = ($k % 2 );++$k;?><div class="more"><a href="<?php echo ($widget_more_url[$k]); ?>"><?php echo ($title); ?></a></div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </div><?php endif; ?>

    <ul>
    	
        <?php if(is_array($category_list)): $i = 0; $__LIST__ = $category_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
        	<a href="<?php echo addons_url('Shop://Shop/products',array('cate_id'=>$vo[id]));?>">
            	<img src="<?php echo (get_cover_url($vo["icon"])); ?>"/>
                <h6><?php echo ($vo["title"]); ?></h6>
				<p><?php echo ($vo["intro"]); ?></p>
        	</a>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>


<!--JS模块-->

<script type="text/javascript">
setTimeout(function(){
	layoutBanner(true,5000,'.banner_<?php echo ($widget_id); ?>');
	},300)
</script>