<?php
$page=$_POST['page'];
$pagesize=$_POST['pagesize'];
$offset=($page-1)*$pagesize;
$sql="select c.id,c.author,c.created,c.content,c.`status`,p.title from  comments c
LEFT JOIN posts p  on p.id=c.post_id
LIMIT {$offset},{$pagesize}";
include_once "../../functions.php";
$result=query($sql);
$mysql="select COUNT(c.id) as coundid from  comments c
LEFT JOIN posts p  on p.id=c.post_id ";
$resu=query($mysql);
$tiaoshu=ceil($resu[0]['coundid']/$pagesize);

if(empty($result)){
	$res=['code'=>'404','msg'=>'操作失败'];
}else {
	$res=['code'=>'200','msg'=>'操作成功','data'=>$result,'tiaoshu'=>$tiaoshu];
}
echo json_encode($res);
?>