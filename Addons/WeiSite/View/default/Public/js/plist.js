var Product = {
	detail : function(id){
		window.location.href = '/index.php?s=/addon/WeiSite/WeiSite/pdetail/id/'+id+'.html';
	},
	addCart : function(id){
		var count ;
		count = document.getElementById('pcount').value;
		if(count == 0){
			alert('对不起，购买数量不可为 0');
		}
		var data = {};
		data['goods_id'] = id;
		data['goods_count'] = count;
		$.ajax({
			url : '/index.php?s=/addon/WeiSite/Product/addCart.html',
			type: 'post',
			data : data,
			dataType: 'json',
			success : function(rp){
				alert(rp);
			}
		});
	}

};