<?php
$id=$_POST['cateId'];
$sql="delete from categories where id={$id}";
include "../../functions.php";
$result=execute($sql);
if($result===true){
	$res=['code'=>200,'msg'=>'删除成功'];
}else {
	$res=['code'=>404,'msg'=>'删除失败'.$result];
}
echo json_encode($res);
?>