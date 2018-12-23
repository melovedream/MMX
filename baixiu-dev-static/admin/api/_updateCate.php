<?php
$name=$_POST['name'];
$slug=$_POST['slug'];
$classname=$_POST['classname'];
$id=$_POST['id'];
$sql="update categories set name='{$name}', slug='{$slug}',classname='{$classname}' where id={$id}";

// echo(123);
include '../../functions.php';
$result =execute($sql);
if($result===true){
	$res=['code'=>200,'msg'=>'更新成功'];
}else {
	$res=['code'=>404,'msg'=>'更新失败'.$result];
}
echo json_encode($res);
?>