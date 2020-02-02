<?php 
//加载配置文件
include_once('../includens/config.php');

$id = $_GET['id'];

//写要修改的资讯的信息查询
$query = mysqli_query($con,"select * from info where id=$id");
$info = mysqli_fetch_assoc($query);

//PHP判读的程序结构（过程式编程）
if($_POST){
 // echo('<pre>');
 // print_r($_POST);
 // print_r($_FILES);
 // exit;
  
  $t = $_POST['title'];
  $time = $_POST['time'];
  $p = $_POST['content'];
  $type = $_POST['type']; //类型
  //exit();
  
  //做图片上传
  if ($_FILES['img']['error']==0) {
  //成功上传
  //图片后缀名（扩展名）
    $ten = pathinfo($_FILES['img']['name'],PATHINFO_EXTENSION);
    $new_name=date('YmdHis').mt_rand(1000,9999).'.'.$ten;

    copy($_FILES['img']['tmp_name'],'../upload/'.$new_name);
    //增加多个变量
    $img = '/upload/'.$new_name;
  }else{
    $img= $info['img'];//内容是空的
  }

  //添加菜式的程序

  //(3)添加/查询/修改/删除数据
  mysqli_query($con,"update info set title='$t',content='$p',time='$time',type='$type',img='$img' where id=$id"); 
  //弹窗提醒
  echo '<script>alert("修改成功");</script>'; 
  //(4)关闭数据库连接
 //mysqli_close($con);
}


 ?>

<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cinema UI Admin user Examples</title>
  <meta name="description" content="这是一个 user 页面">
  <meta name="keywords" content="user">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="renderer" content="webkit">
  <meta http-equiv="Cache-Control" content="no-siteapp" />
  <link rel="icon" type="image/png" href="assets/i/favicon.png">
  <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">
  <meta name="apple-mobile-web-app-title" content="Amaze UI" />
  <link rel="stylesheet" href="assets/css/amazeui.min.css"/>
  <link rel="stylesheet" href="assets/css/admin.css">
  <link rel="stylesheet" href="../lib/layui/css/layui.css">
</head>
<body>
<!--[if lte IE 9]>
<p class="browsehappy">你正在使用<strong>过时</strong>的浏览器，Amaze UI 暂不支持。 请 <a href="http://browsehappy.com/" target="_blank">升级浏览器</a>
  以获得更好的体验！</p>
<![endif]-->

<header class="am-topbar am-topbar-inverse admin-header">
  <div class="am-topbar-brand">
    <strong>Cinema UI</strong> <small>后台管理模板</small>
  </div>

  <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>

  <div class="am-collapse am-topbar-collapse" id="topbar-collapse">

    <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
      <li><a href="javascript:;"><span class="am-icon-envelope-o"></span> 收件箱 <span class="am-badge am-badge-warning">5</span></a></li>
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          <span class="am-icon-users"></span> 管理员 <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li><a href="#"><span class="am-icon-user"></span> 资料</a></li>
          <li><a href="#"><span class="am-icon-cog"></span> 设置</a></li>
          <li><a href="#"><span class="am-icon-power-off"></span> 退出</a></li>
        </ul>
      </li>
      <li class="am-hide-sm-only"><a href="javascript:;" id="admin-fullscreen"><span class="am-icon-arrows-alt"></span> <span class="admin-fullText">开启全屏</span></a></li>
    </ul>
  </div>
</header>

<div class="am-cf admin-main">
  <!-- sidebar start -->
<?php include_once('left.php'); ?>
  <!-- sidebar end -->

  <!-- content start -->
  <div class="admin-content">
    <div class="admin-content-body">
      <div class="am-cf am-padding am-padding-bottom-0">
        <div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">修改资讯</strong> / <small>Edit information</small></div>
      </div>

      <hr/>

      <div class="am-g">
        <div class="am-u-sm-12 am-u-md-4 am-u-md-push-8">
          <!-- <div class="am-panel am-panel-default">
            <div class="am-panel-bd">
              <div class="am-g">
                <div class="am-u-md-4">
                  <img class="am-img-circle am-img-thumbnail" src="" alt=""/>
                </div>
                <div class="am-u-md-8">
                  <p>你可以使用<a href="#">gravatar.com</a>提供的头像或者使用本地上传头像。 </p>
                  <form class="am-form">
                    <div class="am-form-group">
                      <input type="file" id="user-pic">
                      <p class="am-form-help">请选择要上传的文件...</p>
                      <button type="button" class="am-btn am-btn-primary am-btn-xs">保存</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
 -->
        <!--   <div class="am-panel am-panel-default">
            <div class="am-panel-bd">
              <div class="user-info">
                <p>等级信息</p>
                <div class="am-progress am-progress-sm">
                  <div class="am-progress-bar" style="width: 60%"></div>
                </div>
                <p class="user-info-order">当前等级：<strong>LV8</strong> 活跃天数：<strong>587</strong> 距离下一级别：<strong>160</strong></p>
              </div>
              <div class="user-info">
                <p>信用信息</p>
                <div class="am-progress am-progress-sm">
                  <div class="am-progress-bar am-progress-bar-success" style="width: 80%"></div>
                </div>
                <p class="user-info-order">信用等级：正常当前 信用积分：<strong>80</strong></p>
              </div>
            </div>
          </div> -->

        </div>

        <div class="am-u-sm-12 am-u-md-8 am-u-md-pull-4">
          <form class="am-form am-form-horizontal" action="" method="post" enctype="multipart/form-data">    <!--图片赋值名称-->
            <div class="am-form-group">
              <label for="user-name" class="am-u-sm-3 am-form-label">标题</label>
              <div class="am-u-sm-9">
                <input type="text" id="user-name" placeholder="请输入标题" name="title" value="<?php echo $info['title']; ?>">
                 <!-- <small>输入你的名字，让我们记住你。</small>          -->
                    </div>
            </div>

            <div class="am-form-group">
              <label for="user-name" class="am-u-sm-3 am-form-label">发布时间</label>
              <div class="am-u-sm-9">
                <input type="text" name="time" id="time" placeholder="请选择发布时间" name="time"  value="<?php echo $info['time']; ?>">
               <!--  <small>输入你的名字，让我们记住你。</small>-->             
                </div>
            </div>

           <!--  <div class="am-form-group">
              <label for="user-name" class="am-u-sm-3 am-form-label">价格</label>
              <div class="am-u-sm-9">
                <input type="text" id="user-name" placeholder="请输入价格" name="price">
                <small>输入你的名字，让我们记住你。</small>
               </div>
            </div> -->
            <div class="am-form-group">
              <label for="user-name" class="am-u-sm-3 am-form-label">图片</label>
              <div class="am-u-sm-9">
              <img src="<?php echo $info['img'];?>" alt="" style="width: 200px;">
                <input type="file" id="user-name" name="img">
               <!--  <small>输入你的名字，让我们记住你。</small>
 -->              </div>
            </div>
            <div class="am-form-group">
              <label for="user-intro" class="am-u-sm-3 am-form-label">内容</label>
              <div class="am-u-sm-9">
              <!-- textarea 是多行输入框 -->
                <textarea class="" rows="5" id="user-intro" name="content"
                placeholder="请输入个人内容"><?php echo $info['content']; ?></textarea>
              </div>
            </div>
           <div class="am-form-group">
              <label for="user-name" class="am-u-sm-3 am-form-label">类别</label>
              <div class="am-u-sm-9">
              <select data-am-selected="{btnSize: 'sm'}" name="type">
              <option value="">请选择</option>
              <!-- php的三元运算符 -->
              <option <?php echo $info['type']=='动漫资讯'?'selected':'';?> value="动漫资讯">动漫资讯</option>
              <option <?php echo $info['type']=='电影资讯'?'selected':'';?> value="电影资讯">电影资讯</option>
              <option <?php echo $info['type']=='电影站'?'selected':'';?> value="电影站">电影站</option>
            </select>
            </div>
            </div>

            <!-- <div class="am-form-group">
              <label for="user-email" class="am-u-sm-3 am-form-label">电子邮件 / Email</label>
              <div class="am-u-sm-9">
                <input type="email" id="user-email" placeholder="输入你的电子邮件 / Email">
                <small>邮箱你懂得...</small>
              </div>
            </div> -->

            <!-- <div class="am-form-group">
              <label for="user-phone" class="am-u-sm-3 am-form-label">电话 / Telephone</label>
              <div class="am-u-sm-9">
                <input type="tel" id="user-phone" placeholder="输入你的电话号码 / Telephone">
              </div>
            </div> -->

            <!-- <div class="am-form-group">
              <label for="user-QQ" class="am-u-sm-3 am-form-label">QQ</label>
              <div class="am-u-sm-9">
                <input type="number" pattern="[0-9]*" id="user-QQ" placeholder="输入你的QQ号码">
              </div>
            </div> -->
<!-- 
            <div class="am-form-group">
              <label for="user-weibo" class="am-u-sm-3 am-form-label">微博 / Twitter</label>
              <div class="am-u-sm-9">
                <input type="text" id="user-weibo" placeholder="输入你的微博 / Twitter">
              </div>
            </div> -->

            <!-- <div class="am-form-group">
              <label for="user-intro" class="am-u-sm-3 am-form-label">简介 / Intro</label>
              <div class="am-u-sm-9">
                <textarea class="" rows="5" id="user-intro" placeholder="输入个人简介"></textarea>
                <small>250字以内写出你的一生...</small>
              </div>
            </div> -->

            <div class="am-form-group">
              <div class="am-u-sm-9 am-u-sm-push-3">
                <button type="submit" class="am-btn am-btn-primary">保存修改</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <footer class="admin-content-footer">
      <hr>
      <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
    </footer>

  </div>
  <!-- content end -->

</div>

<a href="#" class="am-icon-btn am-icon-th-list am-show-sm-only admin-menu" data-am-offcanvas="{target: '#admin-offcanvas'}"></a>

<footer>
  <hr>
  <p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
</footer>

<!--[if lt IE 9]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="assets/js/jquery.min.js"></script>
<!--<![endif]-->
<script src="assets/js/amazeui.min.js"></script>
<script src="assets/js/app.js"></script>
<script src="../lib/layui/layui.js"></script>
<script>
   layui.use(['laydate'],function(){
     var d=layui.laydate;
     d.render({      //json对象
            elem:'#time'
     });
   });
</script>
</body>
</html>