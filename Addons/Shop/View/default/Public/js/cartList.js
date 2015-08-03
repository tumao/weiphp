var Cart = {
	setCartEmpty : function(){	//清空购物车
		$.ajax({
			url 	: '/index.php?s=/addon/Shop/Shop/setCartEmpty.html',
			type 	: 'post',
			dataType: 'json',
			success : function(rp){
				// $('.list').remove();
				window.location.href = '/index.php?s=/addon/Shop/Shop/cartList.html';
			}
		});

	},
	removeGoods : function(id){		//移除购物车内的一件物品
		$.ajax({
			url		: '/index.php?s=/addon/Shop/Shop/removeGoods.html',
			type 	: 'post',
			dataType: 'json',
			data 	: {id : id},
			success : function(rp){
				window.location.href = '/index.php?s=/addon/Shop/Shop/cartList.html';
			}
		});
	},
	orderDetail : function(){
		window.location.href = '/index.php?s=/addon/Shop/Shop/orderShow.html';
	},
	jiesuan	: function(){	//订单结算
		var data = {};
		data['username'] = document.getElementById('username').value;
		data['phone'] = document.getElementById('phone').value;
		data['address'] = document.getElementById('address').value;
		if(data['username'] == ''){
			alert('收件人不可为空');
			return false;
		}
		if(data['phone'] == ''){
			alert('电话不可为空');
			return false;
		}
		if(data['address'] == ''){
			alert('收件人的地址不可为空');
			return false;
		}
		$.ajax({
			url	:'/index.php?s=/addon/Shop/Shop/addOrder.html',
			type: 'post',
			dataType : 'json',
			data : data,
			success  : function(rp){
				// onBridgeReady(rp);
				// alert(rp.appId+'/'+rp.nonceStr+'/'+rp.package+'/'+rp.signType+'/'+rp.timeStamp+'/'+rp.paySign);
				if (typeof WeixinJSBridge == "undefined"){
				   if( document.addEventListener ){
				       document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
				   }else if (document.attachEvent){
				       document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
				       document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
				   }
				}else{
				   onBridgeReady(rp);
				}
			}
		});
	},
	minTotal:function(id){		//购物车中数量减1
		var obj = document.getElementById('text_box_'+id);
		if((parseInt(obj.value)-1) >0){
			obj.value = parseInt(obj.value)-1;
			Cart.setProductTotal(id, obj.value);
		}
	},
	addTotal: function(id){		//购物车中数量加1
		var obj = document.getElementById('text_box_'+id);
		obj.value = parseInt(obj.value) + 1;
		Cart.setProductTotal(id, obj.value);
	},
	setProductTotal:function(id, count){	//存储购物车中商品的数量
		$.ajax({
			url : '/index.php?s=/addon/Shop/Shop/setProductTotal.html',
			data: {id:id, count:count},
			dataType:'json',
			type 	: 'post',
			success : function(rp){

			}
		});
	}
};

function onBridgeReady(rp){			//JS调用微信结算
   WeixinJSBridge.invoke(
       'getBrandWCPayRequest', {
           "appId" : rp.appId,     //公众号名称，由商户传入
           "nonceStr" : rp.nonceStr, //随机串
           "package" : rp.package,
           "signType" : "MD5",         //微信签名方式:
           "timeStamp":rp.timeStamp,         //时间戳，自1970年以来的秒数
           "paySign" : rp.paySign //微信签名
       },
       function(res){
           if(res.err_msg == "get_brand_wcpay_request:ok" ){
           		$.ajax({		//查看当前订单是否支付成功
           			url : '/index.php?s=/addon/Shop/Shop/payingStatus.html',
           			data: {out_trade_nos : rp.out_trade_nos},
           			dataType : 'json',
           			type : 'POST',
           			success : function(su){
           				window.location.href = su.url;
           			}
           		});
           }     // 使用以上方式判断前端返回,微信团队郑重提示：res.err_msg将在用户支付成功后返回    ok，但并不保证它绝对可靠。
       }
   );
}
