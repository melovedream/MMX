<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="../static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../static/assets/css/admin.css">
</head>
<body>
  <div class="login">
    <form class="login-wrap">
      <img class="avatar" src="../static/assets/img/default.png">
      <!-- 有错误信息时展示 -->
       <div class="alert alert-danger" style="display: none;">
        <strong>错误！</strong> <span id="msg">用户名或密码错误！</span>
      </div> 
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email" type="email" class="form-control" placeholder="邮箱" autofocus>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password" type="password" class="form-control" placeholder="密码">
      </div>
      <span class="btn btn-primary btn-block" id="btn-logoin">登 录</span>
    </form>
  </div>
  <script src="../static/assets/vendors/jquery/jquery.js"></script>
  <script src="../static/assets/vendors/nprogress/nprogress.js"></script>
  <script>
    $(function(){
      $('#btn-logoin').on("click",function(){
        var email= $('#email').val();
        var pwd=$('#password').val();
        var reg=/\w+[@]\w+/;
        if(!reg.test(email)){
          $('.alert').show().find('#msg').html('email格式不正确');
          return;
        }
         $.ajax({
          type:'post',
          url:'./api/_userLogin.php',
          data:{'email':email,'password':pwd},
          dataType:'json',
          success:function(res){
            if(res.code==200){
              location.href='index.php';
            }else {
              $('.alert').show().find('#msg').html('用户名或者密码错误');
            }
          }
         })
      })
    })
  </script>
</body>
</html>
