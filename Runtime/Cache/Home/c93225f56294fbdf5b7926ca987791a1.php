<?php if (!defined('THINK_PATH')) exit();?><!--通用的diy页面widget模板的基类模板-->
<!--头部标题栏-->
<!--鉴于样式title放进具体每块模块-->
<!--CSS模块-->


	<?php if(!empty($widget_title) || !empty($widget_more_title[0])): ?><div class="widget_title">
            <?php if(!empty($widget_title)): ?><h2><?php echo ($widget_title); ?></h2><?php endif; ?>
            
            <?php if(!empty($widget_more_title["0"])): if(is_array($widget_more_title)): $k = 0; $__LIST__ = $widget_more_title;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$title): $mod = ($k % 2 );++$k;?><div class="more"><a href="<?php echo ($widget_more_url[$k]); ?>"><?php echo ($title); ?></a></div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </div><?php endif; ?>


<!--widget内容块 一般情况widget里的显示模板继承此模板后只需要重写widget_content代码块即可-->

<div class="diy_shop shopdetail_threerow_table_list">
    <ul>
    <?php if(is_array($list["list_data"])): $i = 0; $__LIST__ = $list["list_data"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$product): $mod = ($i % 2 );++$i;?><li>
        	<a href="<?php echo addons_url('Shop://Shop/detail',array('id'=>$product[id]));?>">
                <div class="img_wrap"><?php echo (get_img_html($product["cover"])); ?>
                <p class="price">￥<?php echo ($product["discount_price"]); ?> <del>￥<?php echo ($product["market_price"]); ?></del></p>
                </div>
        	</a>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
    <?php echo ($list["_page"]); ?>
</div>


<!--JS模块-->

  <script type="text/javascript">
setTimeout(function(){
	$.WeiPHP.squarePicSlide(false,0,$('.layout_item').width(),400,'#picSlideShow .prevBtn','#picSlideShow .nextBtn');
	},400);
  function addCart(id){
      var count ;
      count = document.getElementById('buyCount').value;
      if(count == 0){
        alert('对不起，购买数量不可为 0');
      }
      var data = {};
      data['goods_id'] = id;
      data['goods_count'] = count;
      $.ajax({
        url : '/index.php?s=/addon/Shop/Shop/addCart.html',
        type: 'post',
        data : data,
        dataType: 'json',
        success : function(rp){
          alert(rp.info);
        }
      });
    }
</script>