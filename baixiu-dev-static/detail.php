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
    <?php include_once "public/_aside.php" ;?>
    <div class="content">
       <div class="article">
       </div>
      <div class="panel hots">
        <h3>热门推荐</h3>
        <ul>
          <li>
            <a href="javascript:;">
              <img src="static/uploads/hots_2.jpg" alt="">
              <span>星球大战:原力觉醒视频演示 电影票68</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="static/uploads/hots_3.jpg" alt="">
              <span>你敢骑吗？全球第一辆全功能3D打印摩托车亮相</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="static/uploads/hots_4.jpg" alt="">
              <span>又现酒窝夹笔盖新技能 城里人是不让人活了！</span>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <img src="static/uploads/hots_5.jpg" alt="">
              <span>实在太邪恶！照亮妹纸绝对领域与私处</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="footer">
      <p>© 2016 XIU主题演示 本站主题由 themebetter 提供</p>
    </div>
  </div>
</body>
<script src="./static/assets/vendors/jquery/jquery.js"></script>
  <script src="./static/assets/vendors/nprogress/nprogress.js"></script>
  <script src="./static/assets/vendors/art-template/template-web.js"></script>
  <script type="txet/template" id="post">
    <% var postInfo=data[0]; %>
        <div class="breadcrumb">
          <dl>
            <dt>当前位置：</dt>
            <dd><a href="javascript:;"><%=postInfo["name"] %></a></dd>
            <dd><%=postInfo["title"] %></dd>
          </dl>
        </div>
        <h2 class="title">
          <a href="javascript:;"><%=postInfo["title"] %></a>
        </h2>
        <div class="meta">
          <span><%=postInfo["nickname"] %> 发布于 <%=postInfo["created"] %></span>
          <span>分类: <a href="javascript:;"><%=postInfo["name"] %></a></span>
          <span>阅读: (<%=postInfo["views"] %>)</span>
          <span>点赞: (<%=postInfo["likes"] %>)</span>
        </div>
        <div class="contentDetail"><%=postInfo["content"] %></div>
  </script>
  <script>
    $(function(){
      var pageid=new URLSearchParams(location.search);
      pageId=pageid.get('postId');
      $.ajax({
        type:'post',
        url:'./api/_getPostInfo.php',
        data:{postId:pageId},
        dataType:'json',
        success:function(res){
          var html = template('post',res);
          $('.article').append(html);
        }
      })
    })
  </script>
</html>
