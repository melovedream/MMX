<?php 
  $id= $_GET['id'];
  $conn=mysqli_connect('127.0.0.1','root','root','db_baixiu');
  if(!$conn){
    die('数据库连接失败');
  }
    $sql="select posts.id, posts.title,content,created,views,likes,users.nickname,categories.name ,
      (select count(*) from comments where post_id = posts.id)as commentsCount
      from posts 
      inner join categories on posts.category_id = categories.id
      inner join users on posts.user_id = users.id
      where categories.id != 1 and categories.id = {$id}
      order by created desc
      limit 10";
      $result=mysqli_query($conn,$sql);
      $postArr=[];
      while($row=mysqli_fetch_assoc($result)){
          $postArr[]=$row;
      }
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>阿里百秀-发现生活，发现美!</title>
  <link rel="stylesheet" href="static/assets/css/style.css">
  <link rel="stylesheet" href="static/assets/vendors/font-awesome/css/font-awesome.css">
</head>
<body>
  <div class="wrapper">
    <div class="topnav">
      <ul>
        <li><a href="javascript:;"><i class="fa fa-glass"></i>奇趣事</a></li>
        <li><a href="javascript:;"><i class="fa fa-phone"></i>潮科技</a></li>
        <li><a href="javascript:;"><i class="fa fa-fire"></i>会生活</a></li>
        <li><a href="javascript:;"><i class="fa fa-gift"></i>美奇迹</a></li>
      </ul>
    </div>
    <?php include_once "public/_header.php" ;?>
    <?php include_once "public/_aside.php";?>
    <div class="content">
      <div class="panel new">
        <h3><?php 
        if(empty($postArr)){
          echo "当前分类没有文章";
        }
        else{
        echo $postArr[0]['name'];
        } ?></h3>
        <?php
        foreach ($postArr as $v) { ?>
        <div class="entry">
          <div class="head">
            <a href="detail.php?postId=<?php echo $v['id']; ?>"><?php echo $v['title']; ?></a>
          </div>
          <div class="main">
            <p class="info"><?php echo $v['nickname']; ?> 发表于 <?php echo $v['created']; ?></p>
            <p class="brief"><?php echo $v['content'];?></p>
            <p class="extra">
              <span class="reading">阅读(<?php echo $v['views']; ?>)</span>
              <span class="comment">评论(<?php echo $v['commentsCount']; ?>)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<?php echo $v['likes']; ?>)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span><?php echo $v['name']; ?></span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="static/uploads/hots_2.jpg" alt="">
            </a>
          </div>
        </div>
        <?php }
        ?>
        <div class="loadmore">
          <span class="btn">加载更多</span>
      </div>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
  <script src="./static/assets/vendors/jquery/jquery.js"></script>
  <script src="./static/assets/vendors/nprogress/nprogress.js"></script>
  <script src="./static/assets/vendors/art-template/template-web.js"></script>
  <script type="text/template" id="posttep">
    <% for(var i=0;i<items.length;i++){%>
        <div class="entry">
          <div class="head">
            <a href="detail.php?postId=<%=items[i]['id']%>"><%=items[i]['title']%></a>
          </div>
          <div class="main">
            <p class="info"><%=items[i]['nickname']%> 发表于 <%=items[i]['created']%></p>
            <p class="brief"><%=items[i]['content']%></p>
            <p class="extra">
              <span class="reading">阅读(<%=items[i]['views']%>)</span>
              <span class="comment">评论(<%=items[i]['commentsCount']%>)</span>
              <a href="javascript:;" class="like">
                <i class="fa fa-thumbs-up"></i>
                <span>赞(<%=items[i]['likes']%>)</span>
              </a>
              <a href="javascript:;" class="tags">
                分类：<span><%=items[i]['name']%></span>
              </a>
            </p>
            <a href="javascript:;" class="thumb">
              <img src="static/uploads/hots_2.jpg" alt="">
            </a>
          </div>
        </div>
  
    <%}%>
  </script>
  <script>
    $(function(){
      var page=1;
      $(".loadmore .btn").on('click',function(){
       var usp=new URLSearchParams(location.search);
       var cateid=usp.get('id');
        page++;
        $.ajax({
          url:'api/_getMorePost.php',
          data:{categoryId:cateid,page:page,pageSize:10},
          dataType:"json",
          success:function(res){
               var html= template('posttep',{items:res});
               $('.loadmore').before(html);
               //如果没有数据，就不需要请求了
               if(res.length<=0){
                  $('.loadmore .btn').off('click').htm('没有更多的文章了');
               }
          }
        })
      })
    })
  </script>
</body>
</html>