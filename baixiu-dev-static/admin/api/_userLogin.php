<?php
	//前端会发送email账号和密码
	$email=$_POST['email'];
	$pwd=$_POST['password'];
	//定义查询的sql语句
	$sql="select * from users where email='{$email}' and  password='{$pwd}' and status='activated'";
	include "../../functions.php";
	//执行sql语句查询的结果数组
	$arr=query($sql);
	//判断数组中是否有内容
	if(empty($arr)){
		$res=['code'=>404,'msg'=>'您输入的账号或者密码有误'];
	}
	else{
		$res=['code'=>200,'msg'=>'登录成功'];
		session_start();
		$_SESSION['isLogin']='true';
		//用户登录成功 在session中记录当前登录的用户
		$_SESSION['userId']=$arr[0]['id'];
	}
	//将数组转换json格式的字符串并输出
	echo json_encode($res);
?>