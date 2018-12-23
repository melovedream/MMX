<?php
 function query($sql){
 	$conn=mysqli_connect('127.0.0.1','root','root','db_baixiu');
 	if(!$conn){
 		die('数据连接失败');
 	}
 	$result=mysqli_query($conn,$sql);
 	$arr=[];
 	while($row=mysqli_fetch_assoc($result)){
 		$arr[]=$row;
 	}
 	return $arr;
 }
 function execute($sql){
 	$conn=mysqli_connect('127.0.0.1','root','root','db_baixiu');
 	if(!$conn){
 		die('数据连接失败');
 	}
 	$result=mysqli_query($conn,$sql);
 	if($result){
 		return $result;
 	}else {
 		return '执行错误:'.mysqli_error($conn);
 	}
 }
?>