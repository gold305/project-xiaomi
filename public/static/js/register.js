document.onkeydown=function(event){
    var e = event || window.event || arguments.callee.caller.arguments[0];
    if(e && e.keyCode==13){ // enter 键
    	//校验登录
    	$("#submit").click();
    }
};

//fuant(参数名，参数，参数名)
function fuant(ters,tan,terst){
    $(ters).css({'color':tan});
    $(terst).css({'display':'none'});
}

function isnull(){
	
}

/*
 * 作者：张佳鹏
 * 审：李昊枕
 * 时间：2020-09-03
 */

//查看验证码还有多少秒重发
function vicodeResend(ter,ser){
	if(ter == 1){
		$.ajax({
	        type:'post',
	        url:'/index/index/vicoderesend',
	        data:{naDtel:ser},
	        success:function(tesr){
	        	if(tesr.code == 3){
	        		$('#yzmid').text(tesr.msg + '秒后重发');
	        		$('#yzmid').css({'background':'#efefef'});
	        		setTimeout("vicodeResend(1,"+ tesr.data +")", 1000);
	        	}else{
	        		$('#yzmid').text('获取验证码');
	        		$('#yzmid').css({'background':'#f3e7c6'});
	        		$('#yzmid').attr('onclick','send()');
	        	}
	        }
		})
	}
}

//点击获取手机验证码
function send(){
	 var naDtel = $('#naDtel').val(); //电话号码
	 var myreg = /^1([38][0-9]|4[579]|5[0-3,5-9]|6[6]|7[012345678]|9[89])\d{8}$/; //匹配手机号
	 
	 if( naDtel == '' ){
	        $(".shou").text('手机号不能为空！');
	        fuant('.shou','red','.tp3');
	        return false;
	    }else if(!myreg.test(naDtel)){
	        $(".shou").text('手机号格式为：[字符长度11位]');
	        fuant('.shou','red','.tp3');
	        return false;
	    }else{
	        $(".shou").text('');
	        $('.tp3').css({'display':'block'});
	    }

	$.ajax({
        type:'post',
        url:'/index/index/vecode',
        data:{naDyzm:'8dTe',naDtel:naDtel},
        success:function(tesr){
	       	if(tesr.msg == 1){
	       		$('#yzmid').attr('onclick','isnull()');
	       		vicodeResend(1,naDtel);
	       	}else if(tesr.code == -3){
	       		alert(tesr.msg);
	       	}
        }
	})
}


//注册ajax提交
function pancll(){
    var naDuser = $('#naDuser').val(); //用户名
    var naDpass = $('#naDpass').val(); //密码
    var naDpassin = $('#naDpassin').val(); //确认密码
    var naDtel = $('#naDtel').val(); //电话号码
    var userp = /^(\w){6,18}$/; //匹配字母，数字，下划线，长度6-18 （用户名）
    var hoadp = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W_]).{8,18}$/;    //匹配字母，数字，下划线，长度6-18 （密码）
    var myreg = /^1([38][0-9]|4[579]|5[0-3,5-9]|6[6]|7[012345678]|9[89])\d{8}$/; //匹配手机号
    

    if( naDuser == '' ){
        $(".zhang").text("账号不能为空!");
        fuant('.zhang','red','.tp');
        return false;
    }else if(!userp.test(naDuser)){
        $(".zhang").text("用户名格式为：[数字，字符，或大小写字母]");
        fuant('.zhang','red','.tp');
        return false;
    }else{
        $(".zhang").text("");
        $('.tp').css({'display':'block'});
    }

    if( naDpass == '' ){
        $(".mi").text("密码不能为空!");
        fuant('.mi','red','.tp1');
        return false;
    }else if(!hoadp.test(naDpass)){
        $(".mi").text("密码格式为包含：[数字，字符，大小写字母]四种");
        fuant('.mi','red','.tp1');
        return false;
    } else{
        $(".mi").text("");
        $('.tp1').css({'display':'block'});
    }

    if( naDpassin == '' ){
        $(".liang").text('确认密码不能为空!');
        fuant('.liang','red','.tp2');
        return false;
    }else if(naDpass != naDpassin){
        $(".liang").text('两次密码不一致');
        fuant('.liang','red','.tp2');
        return false;
    }else{
        $(".liang").text('');
        $('.tp2').css({'display':'block'});
    }
    
    if( naDtel == '' ){
        $(".shou").text('手机号不能为空！');
        fuant('.shou','red','.tp3');
        return false;
    }else if(!myreg.test(naDtel)){
        $(".shou").text('手机号格式为：[字符长度11位]');
        fuant('.shou','red','.tp3');
        return false;
    }else{
        $(".shou").text('');
        $('.tp3').css({'display':'block'});
    }
    
};


$("#naDuser , #naDpass , #naDpassin , #naDtel , #vicode").blur(function(){
	pancll();
});

$("#submit").bind("click",function(){
	var naDuser = $('#naDuser').val(); //用户名
    var naDpass = $('#naDpass').val(); //密码
    var naDpassin = $('#naDpassin').val(); //确认密码
    var naDtel = $('#naDtel').val(); //电话号码
    var vicode = $('#vicode').val(); //验证码
    var userp = /^(\w){6,18}$/; //匹配字母，数字，下划线，长度6-18 （用户名）
    var hoadp = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[\W_]).{8,18}$/;    //匹配字母，数字，下划线，长度6-18 （密码）
    var myreg = /^1([38][0-9]|4[579]|5[0-3,5-9]|6[6]|7[012345678]|9[89])\d{8}$/; //匹配手机号


    if( naDuser == '' ){
        $(".zhang").text("账号不能为空!");
        fuant('.zhang','red','.tp');
        return false;
    }else if(!userp.test(naDuser)){
        $(".zhang").text("用户名格式为：[数字，字符，或大小写字母]");
        fuant('.zhang','red','.tp');
        return false;
    }else{
        $(".zhang").text("");
        $('.tp').css({'display':'block'});
    }

    if( naDpass == '' ){
        $(".mi").text("密码不能为空!");
        fuant('.mi','red','.tp1');
        return false;
    }else if(!hoadp.test(naDpass)){
        $(".mi").text("密码格式为包含：[数字，字符，大小写字母]四种");
        fuant('.mi','red','.tp1');
        return false;
    } else{
        $(".mi").text("");
        $('.tp1').css({'display':'block'});
    }

    if( naDpassin == '' ){
        $(".liang").text('确认密码不能为空!');
        fuant('.liang','red','.tp2');
        return false;
    }else if(naDpass != naDpassin){
        $(".liang").text('两次密码不一致');
        fuant('.liang','red','.tp2');
        return false;
    }else{
        $(".liang").text('');
        $('.tp2').css({'display':'block'});
    }
    
    if( naDtel == '' ){
        $(".shou").text('手机号不能为空！');
        fuant('.shou','red','.tp3');
        return false;
    }else if(!myreg.test(naDtel)){
        $(".shou").text('手机号格式不正确');
        fuant('.shou','red','.tp3');
        return false;
    }else{
        $(".shou").text('');
        $('.tp3').css({'display':'block'});
    }
    
    
    if( vicode == '' ){
        alert('验证码不能为空');
        fuant('.yanzhengma','red');
        return false;
    }
    
    $.ajax({
        type:'post',
        url:'/index/index/note',
        data:{naDuser:naDuser,naDpass:naDpass,naDtel:naDtel,vicode:vicode},
        dataType:'json',
        success:function(tesr){
            if(tesr.code == -1){
            	alert(tesr.data);
            	document.location.reload();
            }else if(tesr.code == 1) {
                alert(tesr.data); 
                setTimeout(function () {
                	window.location.href = "/index/index/deng";
            	}, 1000)
            }else if(tesr.code == -2){
            	alert(tesr.data);
            }else if(tesr.code == -3){
                alert(tesr.data);
                $('.tinVso').click();
                $('#vicode').val('');
            }
        }
    })
});