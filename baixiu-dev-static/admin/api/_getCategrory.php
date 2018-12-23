<?php
 $sql="select * from categories ORDER BY id";
 include_once "../../functions.php";
 $arr=query($sql);
 if(empty($arr)){
 	$res=['code'=>404,'msg'=>'查询失败'];
 }else {
 	$res=['code'=>200,'msg'=>'查询成功','data'=>$arr];
 }
 echo json_encode($res);
?>