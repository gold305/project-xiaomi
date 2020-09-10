//查询显示数据，加分页等等
/*
 * 作者：李昊枕
 * 审：李昊枕
 * 时间：2020-09-08
 */

//opMi(参数：接收当前分页的页数)
function opMi(zoushuan,str1,str2){
	var data = {
		user : $('#username').val(),
		page : zoushuan,
		top : str1,
		bottom : str2,
	};
	$.ajax({
		type:'post',
		url:'index/userle/index',
		data:data,
		success:function(tesr){
			if(tesr.code == -1){
				window.location.reload()
			}else{
				var ter = tesr.data;
				html = '';
				
				html += '<table border="1" cellspacing="0" cellpadding="0">';
					html += '<tr>';
						html += '<td width="66px"  class="tdColor">序号</td>';
						html += '<td width="435px" class="tdColor">用户名字</td>';
						html += '<td width="400px" class="tdColor">手机号码</td>';
						html += '<td width="400px" class="tdColor">状态</td>';
						html += '<td width="630px" class="tdColor">登录时间</td>';
						html += '<td width="130px" class="tdColor">操作</td>';
					html += '</tr>';
					for(var i = 0; i < ter.length; i++){
						 var sel = ter[i];
						 html +='<tr height="40px">';
						 html += '<td>' + sel.id +  '</td>';
						 html += '<td>' + sel.username +  '</td>';
						 html += '<td>' + sel.phone +  '</td>';
						 html += '<td>' + sel.state +  '</td>';
						 html += '<td>' + sel.date +  '</td>';
						 html += '<td><a href="/admin/userle/xiangqing"><img class="operation" src="/static/admin/img/update.png"></a> </td>';
						 html += '</tr>';
						 
					}
				html += '</table>';
				
				var coun = tesr.datas;
				srn = '';
				
				if(coun == 1){
					for(var i = 1; i <= coun ; i++){
						srn += "<span class='curr'>"; 
							srn += "<a href='#'>" + [i] + "</a>";
						srn += "</span>";
					}
				}else{
					if(tesr.msg != 1){
						srn += "<span>";
							srn += "<a href='#' onclick='Immed("+ tesr.msg +",2)'>上一页</a>";
						srn += "</span>";
					}
			    	for(var i = 1; i <= coun ; i++){
			    		if(tesr.msg == [i]){	//tesr.msg表示：当前页数       【当前页数==当前数就给一个背景色】
			    			srn += "<span class='curr' style='background:red'>"; 
								srn += "<a href='#' onclick=Immediate(" + [i] + ")>" + [i] + "</a>";
							srn += "</span>";
			    		}
			    		if(tesr.msg != [i]){	//tesr.msg表示：当前页数       【当前页数!=当前数,不显示当前数】
			    			srn += "<span class='curr'>"; 
								srn += "<a href='#' onclick=Immediate(" + [i] + ")>" + [i] + "</a>";
							srn += "</span>";
			    		}
					}
			    	if(tesr.msg != tesr.datas){
			    		srn += "<span>";
				    		srn += "<a href='#' onclick='Immed("+ tesr.msg +",3)'>下一页</a>";
				        srn += "</span>";
			    	}
			    	
				
				}
				
				$('.ste').html(srn);
				$('.spancl').html(html);
			}
		}
	})
}

//上页
function Immed(str,str2){
	if(str2 == 2){
		opMi(str,1,0); //有值就触发opMi()
	}else if(str2 == 3){
		opMi(str,0,1); //有值就触发opMi()
	}
}

//自己点击页数
function Immediate(str){
	if(str != ''){
		opMi(str,0,0); //有值就触发opMi(参数)
	}
}

$('#submit').bind('click',function(){
	opMi();
})