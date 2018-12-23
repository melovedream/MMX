<?php
 $name=$_POST['name'];
 $slug=$_POST['slug'];
 $classname=$_POST['classname'];
 $sql="select * from categories where name='{$name}'";
 include_once "../../functions.php";
 $arr=query($sql);
 if(empty($arr)){
 	$sql="insert into categories values(null,'{$slug}','{$name}','{$classname}')";
 	$result=execute($sql);
 	if($result===true){
 		$res=['code'=>200,'msg'=>'新增成功'];
 	}else {
 		$res=['code'=>404,'msg'=>'新增失败'.$result];
 	}
 }else{
 	$res=['code'=>203,'msg'=>'有同名的分类名，添加失败'];
 }
  echo json_encode($res);
?>