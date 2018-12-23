<?php
  session_start();
  if(!(isset($_SESSION['isLogin']) && $_SESSION['isLogin']=='true')){
      header('Location:login.php');
  }
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>categories</title>
  <link rel="stylesheet" href="../static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../static/assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../static/assets/css/admin.css">
  <script src="../static/assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <nav class="navbar">
      <button class="btn btn-default navbar-btn fa fa-bars"></button>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="profile.php"><i class="fa fa-user"></i>个人中心</a></li>
        <li><a href="login.php"><i class="fa fa-sign-out"></i>退出</a></li>
      </ul>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <div class="alert alert-danger" id="alert" style="display: none;">
        <strong>错误！</strong><span id="msg"></span>
      </div> 
      <div class="row">
        <div class="col-md-4">
          <form id="add_form">
            <h2>添加新分类目录</h2>
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" placeholder="分类名称">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <p class="help-block">https://zce.me/category/<strong>slug</strong></p>
            </div>
            <div class="form-group">
              <label for="classname">类名</label>
              <input id="classname" class="form-control" name="classname" type="text" placeholder="类名">
              <p class="help-block">https://zce.me/category/<strong>类名</strong></p>
            </div>
            <div class="form-group">
              <span class="btn btn-primary" id="btnAdd" type="submit">添加</span>
              <span class="btn btn-primary" style="display: none" id="btnEdit" type="submit">编辑完成</span>
              <span class="btn btn-primary" style="display: none" id="btnCancel" type="submit">取消编辑</span>
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a id='delAll' class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox"></th>
                <th>名称</th>
                <th>Slug</th>
                <th>类名</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="aside">
    <div class="profile">
      <img class="avatar" src="../static/uploads/avatar.jpg">
      <h3 class="name">布头儿</h3>
    </div>
    <ul class="nav">
      <li>
        <a href="index.php"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <li class="active">
        <a href="#menu-posts" data-toggle="collapse">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse in">
          <li><a href="posts.php">所有文章</a></li>
          <li><a href="post-add.php">写文章</a></li>
          <li class="active"><a href="categories.php">分类目录</a></li>
        </ul>
      </li>
      <li>
        <a href="comments.php"><i class="fa fa-comments"></i>评论</a>
      </li>
      <li>
        <a href="users.php"><i class="fa fa-users"></i>用户</a>
      </li>
      <li>
        <a href="#menu-settings" class="collapsed" data-toggle="collapse">
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-settings" class="collapse">
          <li><a href="nav-menus.php">导航菜单</a></li>
          <li><a href="slides.php">图片轮播</a></li>
          <li><a href="settings.php">网站设置</a></li>
        </ul>
      </li>
    </ul>
  </div>

  <script src="../static/assets/vendors/jquery/jquery.js"></script>
  <script src="../static/assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script src="../static/assets/vendors/nprogress/nprogress.js"></script>
  <script src="../static/assets/vendors/art-template/template-web.js" ></script>
 <script type="text/template" id="categ">
 <%for(var i=0;i<data.length;i++){ %>
    <tr data-id='<%=data[i].id%>'>
          <td class="text-center"><input type="checkbox"></td>
          <td><%=data[i].name%></td>
          <td><%=data[i].slug%></td>
          <td><%=data[i].classname%></td>
          <td class="text-center">
            <a href="javascript:;"  class="btn btn-info btn-xs edit">编辑</a>
            <a href="javascript:;" class="btn btn-danger btn-xs del">删除</a>
          </td>
    </tr>
  <%}%>
 </script>

  <script>
    $(function(){
      //用来保存分类的id
      var categroyId=null;
      $('#but_id').on('click',function(){
        $.ajax({
          url:"./api/_getonlogoin.php",
          success:function(){
            location.href('login.php');

          }
        })
      })
      $.ajax({
        url:'./api/_getCategrory.php',
        dataType:'json',
        success:function(res){
          console.log(res);
         var html= template('categ',res);
         console.log(html)
         $('tbody').append(html);
        }
      })
      $.ajax({
        url:'./api/_getuserAvatar.php',
        dataType:'json',
        success:function(res){
          $('.profile .name').html(res.data[0].nickname);
          $('.profile .avatar').attr('src','..'+res.data[0].avatar);
        }
      })
      $('#btnAdd').on('click',function(){
        if($('#name').val().trim()==''){
          $('#alert').show().find('#msg').text('请输入分类名称')
          return ;
        }
        if($('#slug').val().trim()==''){
          $('#alert').show().find('#msg').text('请输入分类别名')
          return ;
        }
        if($('#classname').val().trim()==''){
          $('#alert').show().find('#msg').text('请输入图标类名')
          return ;
        }
        console.log($('#add_form').serialize());
        $.ajax({
          type:'post',
          url:'api/_addCategory.php',
          data:$('#add_form').serialize(),
          dataType:'json',
          success:function(res){
            if(res.code!=200){
              $('#alert').show().find('#msg').text(res.msg);
            }else{
              location.reload();
            }
          }
        })
      })
      $('tbody').on('click','.edit',function(){
        $('#btnAdd').hide();
        $('#btnEdit').show();
        $('#btnCancel').show();
        var name=$(this).parents('tr').find('td').eq(1).text();
        var slug=$(this).parents('tr').find('td').eq(2).text();
        var classname=$(this).parents('tr').find('td').eq(3).text();
         categroyId=$(this).parents('tr').attr('data-id');
        $('#name').val(name);
        $('#slug').val(slug);
        $('#classname').val(classname);
      })
      $('#btnCancel').on('click',function(){
        $('#btnAdd').show();
         $('#btnEdit').hide();
        $('#btnCancel').hide();
        $('#name').val('');
        $('#slug').val('');
        $('#classname').val('');
      })
      $('#btnEdit').on('click',function(){


        if($('#name').val().trim()==''){
          $('#alert').show().find('#msg').text('请输入分类名称')
          return ;
        }
        if($('#slug').val().trim()==''){
          $('#alert').show().find('#msg').text('请输入分类别名')
          return ;
        }
        if($('#classname').val().trim()==''){
          $('#alert').show().find('#msg').text('请输入图标类名')
          return ;
        }
        $.ajax({
          type:'post',
          url:'api/_updateCate.php',
          data:{
            name:$("#name").val(),
            slug:$("#slug").val(),
            classname:$("#classname").val(),
            id:categroyId
          },
          dataType:'json',
          success:function(res){
            console.log(res);
          }
        })
      })
      $('tbody').on('click','.del',function(){
        var id=$(this).parents('tr').attr('data-id');
        $.ajax({
          type:'post',
          url:'api/_deleteCategory.php',
          data:{cateId:id},
          dataType:'json',
          success:function(res){
            if(res.code==200){
              location.reload();
            }else {
              $('#alert').show().find('#msg').text('删除失败')
            }
            
          }
        })
      })
      //
      $('thead input').on('click',function(){
        //pop 和attr的区别  
        //pop可以设置dom对象原本就有的属性，不能设置自定义属性，attr可以设置自定义属性
        //attr的两个参数都必须是字符串类型的  prop的第二个参数可以是bool类型的
        $('tbody input').prop('checked',$(this).prop('checked'));
        $(this).prop('checked')?$('#delAll').show():$('#delAll').hide();

      })
      //当选中所有的小按钮的时候 全选按钮也会勾选上
      $('tbody').on('click','input',function(){
        if($('tbody input').size()===$('tbody input:checked').size()){
          $('thead input').prop('checked',true);
        }else{
          $('thead input').prop('checked',false);
        }
        $('tbody input:checked').size()>=2?$('#delAll').show():$('#delAll').hide();
      })
      $('#delAll').on('click',function(){
       var cks= $('tbody input:checked');
       var ids=[];
       for(var i=0;i<cks.length;i++){
        var id=$(cks[i]).parents('tr').attr('data-id');
        ids.push(id);
       }
       $.ajax({
        type:'post',
        url:'api/_delAll.php',
        data:{ids:ids},
        dataType:'json',
        success:function(res){
          if(res.code==200){
              location.reload();
            }else {
              $('#alert').show().find('#msg').text('删除失败')
            }
        }
       })
      })
    })
  </script>
</body>
</html>
