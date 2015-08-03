<?php if (!defined('THINK_PATH')) exit();?><!--通用的diy页面widget模板的基类模板-->
<!--头部标题栏-->
<!--鉴于样式title放进具体每块模块-->
<!--CSS模块-->


	<?php if(!empty($widget_title) || !empty($widget_more_title[0])): ?><div class="widget_title">
            <?php if(!empty($widget_title)): ?><h2><?php echo ($widget_title); ?></h2><?php endif; ?>
            
            <?php if(!empty($widget_more_title["0"])): if(is_array($widget_more_title)): $k = 0; $__LIST__ = $widget_more_title;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$title): $mod = ($k % 2 );++$k;?><div class="more"><a href="<?php echo ($widget_more_url[$k]); ?>"><?php echo ($title); ?></a></div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </div><?php endif; ?>


<!--widget内容块 一般情况widget里的显示模板继承此模板后只需要重写widget_content代码块即可-->

<div class="diy_shop shopdetail_simple_list">
    <ul>
    <?php if(is_array($list["list_data"])): $i = 0; $__LIST__ = $list["list_data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$product): $mod = ($i % 2 );++$i;?><li>
        	<a href="<?php echo addons_url('Shop://Shop/detail',array('id'=>$product[id]));?>">
            	<?php echo (get_img_html($product["cover"])); ?>
                <h6><?php echo ($product["title"]); ?></h6>
				<p class="price">￥<?php echo ($product["discount_price"]); ?></p>
                <p class="info">浏览：<?php echo ($product["view_count"]); ?> |  购买：<?php echo ($product["bug_count"]); ?></p>
        	</a>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <?php echo ($list["_page"]); ?>
</div>


<!--JS模块-->