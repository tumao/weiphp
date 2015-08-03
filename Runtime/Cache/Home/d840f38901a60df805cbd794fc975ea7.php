<?php if (!defined('THINK_PATH')) exit();?><!--通用的diy页面widget模板的基类模板-->
<!--头部标题栏-->
<!--鉴于样式title放进具体每块模块-->
<!--CSS模块-->


	<?php if(!empty($widget_title) || !empty($widget_more_title[0])): ?><div class="widget_title">
            <?php if(!empty($widget_title)): ?><h2><?php echo ($widget_title); ?></h2><?php endif; ?>
            
            <?php if(!empty($widget_more_title["0"])): if(is_array($widget_more_title)): $k = 0; $__LIST__ = $widget_more_title;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$title): $mod = ($k % 2 );++$k;?><div class="more"><a href="<?php echo ($widget_more_url[$k]); ?>"><?php echo ($title); ?></a></div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
        </div><?php endif; ?>


<!--widget内容块 一般情况widget里的显示模板继承此模板后只需要重写widget_content代码块即可-->

  <div class="diy_shop shopdetail_wrap">
    <div class="header">
      <a class="back" href="javascript:history.go(-1);"></a>
      <span class="title">宝贝详情</span>
      <a href="/index.php?s=/addon/Shop/Shop/cartList.html" style="float:right;"><em class="cart_icon" style="padding-right:15px;">购物车</em></a>
    </div>
    <!-- 商品头图 -->
    <div class="goods_detail_top">
      <section class="banner square_slide_banner" id="picSlideShow">
        <ul>
          <?php if(!empty($product["img_1"])): ?><li><?php echo (get_img_html($product["img_1"])); ?></li><?php endif; ?>
          <?php if(!empty($product["img_2"])): ?><li><?php echo (get_img_html($product["img_2"])); ?></li><?php endif; ?>
          <?php if(!empty($product["img_3"])): ?><li><?php echo (get_img_html($product["img_3"])); ?></li><?php endif; ?>
          <?php if(!empty($product["img_4"])): ?><li><?php echo (get_img_html($product["img_4"])); ?></li><?php endif; ?>
          <?php if(!empty($product["img_5"])): ?><li><?php echo (get_img_html($product["img_5"])); ?></li><?php endif; ?>

        <!--<li><a href="#"><img src="http://gd4.alicdn.com/bao/uploaded/i4/T1CYpUFcpbXXXXXXXX_!!0-item_pic.jpg_460x460.jpg_.webp"/></a><span class="title">2014春装新款韩版女装宽松休闲打底显瘦长袖雪纺衬衫上衣衬衣</span></li>-->
        </ul>
        <span class="identify">
          <?php if(!empty($product["img_1"])): ?><em></em><?php endif; ?>
          <?php if(!empty($product["img_2"])): ?><em></em><?php endif; ?>
          <?php if(!empty($product["img_3"])): ?><em></em><?php endif; ?>
          <?php if(!empty($product["img_4"])): ?><em></em><?php endif; ?>
          <?php if(!empty($product["img_5"])): ?><em></em><?php endif; ?>
          <a class="prevBtn" href="javascript:;"></a> <a class="nextBtn" href="javascript:;"></a> </section>
    </div>
    <div class="goods_detail_content">
      <!-- 商品内容在此 -->
      <h2><?php echo ($product["title"]); ?></h2>
      <p class="price_p">购买数量:<input id="buyCount" type="text" value="1" style="display:inline; width:40px;"> </p>
      <p class="price_p">价格：<span class="price">￥<?php echo ($product["discount_price"]); ?></span><del>￥<?php echo ($product["market_price"]); ?></del></p>
      <?php echo ($product["param"]); ?>
      <div class="goods_desc"> <?php echo ($product["content"]); ?> </div>
    </div>
    <!-- 购买按钮 -->
    <div class="goods_action"> <a class="to_cart" href="javascript:void(0)" onclick="addCart(<?php echo ($product['id']); ?>)"><em class="cart_icon"></em>加入购物车</a> <a class="to_buy" href="javascript:alert('支付流程正在内测中')"><em class="buy_icon"></em>立即购买</a> </div>
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