<?php
$ext=strrchr($_FILES['upload']['name'], '.');
$filename=time().rand(10000,99999).$ext;
$result=move_uploaded_file($_FILES['upload']['tmp_name'], '../../static/uploads/'.$filename);
if($result){
	$res=['code'=>200,'msg'=>'图片上传成功','imgsrc'=>'../static/uploads/'.$filename];
}else{
	$res=['code'=>200,'msg'=>'图片上传成功'];
}

echo json_encode($res);
?>