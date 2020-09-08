document.onkeydown=function(event){
    var e = event || window.event || arguments.callee.caller.arguments[0];
    if(e && e.keyCode==13){ // enter 键
    	//校验登录
    	$("#denglu").click();
    }
};

/*
 * 作者：陈欢
 * 审：李昊枕
 * 时间：2020-09-01
 */
//登录ajax提交
$('#denglu').click(function () {
    var naDname = $('#naDname').val();
    var naDpass = $('#naDpass').val();
    var vicode = $('#vicode').val();
    
    function sioxn(){
    	$("#text").css({'color':'#f56600'});
    	$(".imgst").css({'display':'block'});
    }
    
    function sanek(){
    	$("#vicode").val('');	//验证码清空
        $(".tinVso").click();	//验证码图刷新
    }
    
    //判断账号密码验证码不能为空
    if (naDname == ''){
        $("#text").text('账号不能为空');
        sioxn();
        return false;
    }else if(naDpass == ''){
        $("#text").text('密码不能为空');
        sioxn();
        return false;
    }else if (vicode == ''){
        $("#text").text('验证码不能为空');
        sioxn();
        return false;
    }


    $.ajax({
        type:'post',
        url:'/index/index/deng',
        data:{ajname:naDname,ajpass:naDpass,ajcode:vicode},
        dataType:'json',
        success:function(tesr){
            if(tesr.code == -1){
                $("#text").text(tesr.data);
                sanek();
                sioxn();
            }else if (tesr.code == -2){
                $("#text").text(tesr.data);
                sanek();
                sioxn();
            }else if (tesr.code == -3){
                alert(tesr.data);
                sanek();
                $("#text").text('');
                $(".imgst").css({'display':'none'});
            }else if(tesr.code == 1){
                alert(tesr.data);
                setTimeout(function () {
                	window.location.href = "/index/index/index";
            	}, 1000)
            }
        }
    })
})
