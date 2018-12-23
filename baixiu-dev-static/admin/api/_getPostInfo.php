<?php
$page= $_POST['page'];
$pageSize= $_POST['pageSize'];
$status= $_POST['status'];//参数为all 代表查询所有的状态
$cateId= $_POST['cateId'];//参数为all 代表查询所有的分类
$sql="SELECT p.id,p.title,u.nickname,c.name,p.created,p.status from posts p 
LEFT JOIN categories c ON p.category_id=c.id
LEFT JOIN users u on u.id=p.user_id where 1=1 ";
if($status!='all'){
	$sql=$sql." and p.status='{$status}' ";
}
if($cateId!='all'){
	$sql=$sql."and p.category_id='{$cateId}'";
}
    $offset=($page-1)*$pageSize;
	$sql=$sql."limit {$offset},{$pageSize}";

	include '../../functions.php';
	$reust=query($sql);


$sql="SELECT count(p.id) as postCount from posts p 
LEFT JOIN categories c ON p.category_id=c.id
LEFT JOIN users u on u.id=p.user_id where 1=1 ";
if($status!='all'){
	$sql=$sql." and p.status='{$status}' ";
}
if($cateId!='all'){
	$sql=$sql."and p.category_id='{$cateId}'";
}
   
   $countResult=query($sql);
   $totalPage=ceil($countResult[0]['postCount']/$pageSize);


	if(empty($reust)){
		$res=['code'=>404,'msg'=>'查询失败'];
	}else {
		$res=['code'=>200,'msg'=>'查询成功','data'=>$reust,'page'=>$page,'pageSize'=>$pageSize,'totalPage'=>$totalPage];
	}
	echo json_encode($res);
?>