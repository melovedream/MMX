<?php
	$ids=$_POST['ids'];
	$str=implode(',',$ids);
	$sql="delete from categories where id in ({$str})";
	include "../../functions.php";
	$result=execute($sql);
	if($result===true){
		$res=['code'=>200,'msg'=>'删除成功'];
	}else {
		$res=['code'=>404,'msg'=>'删除失败'];
	}
	echo json_encode($res);
?>