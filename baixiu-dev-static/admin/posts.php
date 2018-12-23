<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
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
        <h1>所有文章</h1>
        <a href="post-add.php" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
        <form class="form-inline">
          <select id="selectCate" name="" class="form-control input-sm">
            
          </select>
          <select id="selectStatus" name="" class="form-control input-sm">
            <option value="all">所有状态</option>
            <option value="drafted">草稿</option>
            <option value="published">已发布</option>
            <option value="trashed">已作废</option>
          </select>
          <span id="btnFilter" class="btn btn-default btn-sm">筛选</span>
        </form>
        <ul class="pagination pagination-sm pull-right">


          <li><a href="#">上一页</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">下一页</a></li>
        </ul>
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
       
           
        </tbody>
      </table>
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
          <li class="active"><a href="posts.php">所有文章</a></li>
          <li><a href="post-add.php">写文章</a></li>
          <li><a href="categories.php">分类目录</a></li>
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
   <script type="text/template" id="posts">
   <% var porp={drafted:'草稿',published:'已发布',trashed:'已作废'} %>
   <% for(var i=0;i<data.length;i++){%>
     <tr>
        <td class="text-center"><input type="checkbox"></td>
        <td><%=data[i]['title']%></td>
        <td><%=data[i]['nickname']%></td>
        <td><%=data[i]['name']%></td>
        <td class="text-center"><%=data[i]['created']%></td>

        <td class="text-center"><%=porp[data[i]['status']]%></td>
        <td class="text-center">
          <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
          <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
        </td>
      </tr>
    <% } %>
   </script>
   <script type="text/template" id="pages">
          <%
          var start=currentPage-2;
          if(start<1){
          start=1;
          }
          var end =currentPage+2;
          if(end<5){
          end=5
          }
          if(end>totalPage){
          end=totalPage;
          }

          if(end>=5){
            if(start>end-4){
            start=end-4;
            }
          }
          if(currentPage>1){
          %>
          <li data-page='<%=currentPage-1%>'><a  href="#">上一页</a></li>
          <%}%>
          <% for(var i=start;i<=end;i++){%>
          <li class="item <%= currentPage==i?'active':''%> " data-page='<%=i%>'><a href="#"><%=i%></a></li>
         <%}%>
          <%if(currentPage<totalPage){%>
          <li data-page='<%=currentPage+1%>'><a  href="#">下一页</a></li>
          <%}%>
   </script>
   <script type="text/template" id="categroy">
            <option value="all">所有分类</option>
     <% for(var i=0;i<data.length;i++){%>
            <option value="<%=data[i]['id']%>"><%=data[i]['name']%></option>
      <%}%>
   </script>
  <script>
    $(function(){
      var page =1;
      $.ajax({
        type:'post',
        url:'api/_getPostInfo.php',
        data:{page:page,
              pageSize:20,
              status:'all',
              cateId:'all'},
        dataType:'json',
        success:function(res){
          if(res.code!==200){
          }
          else {
            var html=template('posts',res);
            $('tbody').append(html);
            var text=template('pages',{currentPage:page,totalPage:res.totalPage});
            $('.pagination').html(text);
          }
        }
      })
      $('.pagination').on('click','li',function(){
        page=parseInt($(this).attr('data-page'));
        $.ajax({
        type:'post',
        url:'api/_getPostInfo.php',
        data:{page:page,
              pageSize:20,
              status:$('#selectStatus').val(),
              cateId:$('#selectCate').val()},
        dataType:'json',
        success:function(res){
          if(res.code!==200){
          }
          else {

            var html=template('posts',res);
            $('tbody').html(html);
            var text=template('pages',{currentPage:page,totalPage:res.totalPage});
            $('.pagination').html(text);
          }
        }
      })
      })
    
     $.ajax({
      url:'api/_getCategrory.php',
      dataType:'json',
      success:function(res){
        var html=template('categroy',res);
        $('#selectCate').html(html)
      }
     })
     $('#btnFilter').on('click',function(){
      page=1;
        $.ajax({
        type:'post',
        url:'api/_getPostInfo.php',
        data:{page:page,
              pageSize:20,
              status:$('#selectStatus').val(),
              cateId:$('#selectCate').val()},
        dataType:'json',
        success:function(res){
          if(res.code!==200){
          }
          else {
            console.dir(res);
            var html=template('posts',res);
            $('tbody').html(html);
            var text=template('pages',{currentPage:page,totalPage:res.totalPage});
            $('.pagination').html(text);
          }
        }
      })
     })
    })
  </script>
</body>
</html>
