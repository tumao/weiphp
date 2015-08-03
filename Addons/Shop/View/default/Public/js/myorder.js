var Order = {
	cancel:function(id){
		$.ajax({
			url	: '/index.php?s=/addon/Shop/Shop/cancleOrder.html',
			data: {id:id},
			dataType	: 'json',
			type: 'POST',
			success:function(rp){
				if(rp.code > 0){
					alert('该订单已经成功取消');
					$(".order_"+id).remove();
					// window.location.reload();
				}
			}
		});
	},
	jiesuan: function(id){
		$.ajax({
			url		: '/index.php?s=/addon/Shop/Shop/jiesuan.html',
			data 	: {id:id},
			type 	: 'POST',
			dataType: 'json',
			success : function(rp){
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
	}
};