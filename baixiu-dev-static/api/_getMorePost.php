<?php

    //分类Id
	$id=$_GET['categoryId'];
	//页码
	$page =$_GET['page'];
	//每一页的文章数量
	$pageSize=$_GET['pageSize'];
	//当前页是从多少数据开始
	$offset=($page-1)*$pageSize;
	$sql="select posts.id, posts.title,content,created,views,likes,users.nickname,categories.name ,
      (select count(*) from comments where post_id = posts.id)as commentsCount
      from posts 
      inner join categories on posts.category_id = categories.id
      inner join users on posts.user_id = users.id
      where categories.id != 1 and categories.id = {$id}
      order by created desc
      limit {$offset},{$pageSize}
	";
	//应用封装的查询
	include_once '../functions.php';
	//调用得到数组结果
	$arr=query($sql);
	//将数组返回json数据
	echo json_encode($arr);
?>