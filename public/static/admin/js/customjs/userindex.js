function Immediate(){
	
}

$('#submit').bind('click',function(){
	var data = {
		'user' : $('#username').val(),
	};
	$.ajax({
		type:'post',
		url:'index/userle/text',
		data:data,
		success:function(tesr){
			
		}
	})
})