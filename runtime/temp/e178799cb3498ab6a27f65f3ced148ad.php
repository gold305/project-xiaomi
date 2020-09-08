<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\wamp64\www\xiaomi\git\state\public/../application/index\view\index\text.html";i:1599273287;}*/ ?>
<html>
	<head>
		<style>
		
		.dropdown{
			position:relative;
			display:inline-block; 
			background-color: #fff;
			margin: -10 800;
		 }
	
	
		/* 下拉按钮样式 */
		.dropbtn {
		    background-color: #333333;
			margin-bottom:10px;
			position: absolute;
		    color: #b0b0b0;
		    border: none;
		    cursor: pointer;
		    width: 120px;
		    height: 40px;
		}
	
		
		/* 下拉内容 (默认隐藏) */
		.dropdown-content {
			font-size: 12px;
    		text-align: center;
		    transition-duration:0.5s;
			margin-top:-240px;
		    background-color: #fff;
		    min-width: 120px;
			height:130px;
		    box-shadow: 0px 2px 2px 0px rgba(0,0,0,0.1);
		}
		
		/* 下拉菜单的链接 */
		.dropdown-content a {
		    color: #b0b0b0;
			height:30px;
		    line-height:30px;
		    text-decoration: none;
		    display: block;
		}
		
		/* 鼠标移上去后修改下拉菜单链接颜色 */
		.dropdown-content a:hover {background-color: #f1f1f1;color:#ff6700;}
		
		/* 在鼠标移上去后显示下拉菜单 */
		.dropdown:hover .dropdown-content{
		    /* display: block; */
			transition-duration:'2s';
			margin-top:50px;
		}
		.dropdown:hover{
			box-shadow: 0px 2px 4px 0px rgba(0,0,0,0.2);
		}
		
		
		/* 当下拉内容显示后修改下拉按钮的背景颜色 */
		.dropdown:hover .dropbtn {
		    background-color: #fff;
		}
		.dropbtn:hover{
			color:#ff6700;
		}
		</style> 
	</head>
	<body>
		<div class="dropdown">
		  <button class="dropbtn">下拉菜单</button>
		  <div class="dropdown-content">
		    <a href="#">个人中心</a>
		    <a href="#">评价晒单</a>
		    <a href="#">我的喜欢</a>
		    <a href="#">退出登录</a>
		  </div>
		</div>
	</body>
</html>
