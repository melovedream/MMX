<?php
  $postId=$_POST['postId'];
 $sql="
	select posts.id, posts.title,content,created,views,likes,users.nickname,categories.name 
      from posts 
      inner join categories on posts.category_id = categories.id
      inner join users on posts.user_id = users.id
      where categories.id != 1 and posts.id={$postId} 
 ";
	 include "../functions.php";
	 $postArr=query($sql);
	//将数组返回json数据
	 if(empty($postArr)){
	 	//为空  
	 	$res=['code'=>404,'msg'=>'没有查询到编号对应的数据'];

	 }else{
	 	$res=['code'=>200,'msg'=>'查询成功','data'=>$postArr];
	 }
	echo json_encode($res);
?>