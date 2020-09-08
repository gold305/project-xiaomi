<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"D:\wamp64\www\xiaomi\git\state\public/../application/admin\view\user\index.html";i:1599481451;}*/ ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员管理-有点</title>
<link rel="stylesheet" type="text/css" href="/static/admin/css/css.css" />
<link rel="stylesheet" type="text/css" href="/static/admin/css/fenye.css" />
<script type="text/javascript" src="/static/admin/js/jquery.min.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="/static/admin/img/coin02.png" />&nbsp;&nbsp;<a href="#">首页</a>&nbsp;-&nbsp;&nbsp;管理员管理
			</div>
		</div>

		<div class="page">
			<!-- index页面样式 -->
			<div class="connoisseur">
				<div class="conform">
					<div class="cfD">
						<input class="userinput" type="text" placeholder="输入用户名" id="username" name="username"/>
						<input type="submit" class="userbtn" id="submit" value="搜索"/>
					</div>
				</div>
				<!-- index 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px"  class="tdColor">序号</td>
							<td width="435px" class="tdColor">用户名字</td>
							<td width="400px" class="tdColor">手机号码</td>
							<td width="400px" class="tdColor">状态</td>
							<td width="630px" class="tdColor">登录时间</td>
							<td width="130px" class="tdColor">操作</td>
						</tr>
							<?php if(is_array($zhi) || $zhi instanceof \think\Collection || $zhi instanceof \think\Paginator): if( count($zhi)==0 ) : echo "" ;else: foreach($zhi as $key=>$vo): ?>
							<tr height="40px">
								<td><?php echo $vo['id']; ?></td>
								<td><?php echo $vo['username']; ?></td>
								<td><?php echo $vo['phone']; ?></td>
								<td><?php echo $vo['state']; ?></td>
								<td><?php echo $vo['date']; ?></td>
								<td><a href="xiangqing.html"><img class="operation"
	                                    src="/static/admin/img/update.png"></a> 
	                                  </td>
							</tr>
							<?php endforeach; endif; else: echo "" ;endif; ?>
					</table>
					
					<div class="paging">
						 <div class='page'>
				            	<span>
				                	<a href="#">上一页</a>
				            	</span>
									    <span class='curr'> 
											<a href="#">1</a>
							          	</span>
					            <span>
					                <a href="#">下一页</a>
					            </span>
    					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="/static/admin/js/customjs/userindex.js"></script>
</body>
</html>