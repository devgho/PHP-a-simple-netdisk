<?php
header('content-type:text/html;charset=utf-8');
date_default_timezone_set('PRC');
$mysqli = new mysqli('127.0.0.1','web','fjf88888','web','3306','utf8');
if($mysqli->connect_erron){
  die('<script>alert("连接失败'.$mysqli->connect_error.'")</script>');
}
$mysqli->select_db('web');
$mysqli->set_charset('utf8');
if (!isset($_COOKIE['pms']))
    echo '<script>alert("未登录");window.location="login.php"</script>';
?>      
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>十四网盘,Coolest Netdisk</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- My iconfont -->
    <link rel="stylesheet" href="https://at.alicdn.com/t/font_2206860_2af6f9juttf.css">
    <!-- My css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
    <!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
    <script src="js/script.js"></script>
    <!-- my js -->
  </head>
  <body>
    <header class="container">
      <section class="row header">
        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
          <div class="row">
            <img onclick="logout();" src="img/14.jpg" alt="">
            <span>14网盘</span><span class="hidden-lg hidden-md">Mobile</span>
          </div>
        </div>
        <div class="col-lg-10 col-md-10 hidden-sm hidden-xs">
          <ul>
            <li><a href="">主页</a></li>
            <li>
              <a>资源查找</a>
              <form class="form-inline" action="">
                <input type="text" name="kw" class="form-control" placeholder="请输入关键词">
                <button type="submit" class="btn btn-default">查询</button>
              </form>
            </li>
            <li>
              <a onclick="qapper()">上传</a>
              <div>
                <form id="file_up" action="upload.php" method="POST" enctype="multipart/form-data">
                  <input type="file" onchange="return checkfile(this);" id="fileinp" name="file" class="form-control">
                  <span id="filetext">点此选择20M以内文件</span>
                  <button type="submit" class="mybutton">提交</button>
                </form>
              </div>
            </li>
            <li>
              <a onclick="sapper()">
                更多功能<i id="sarrow" class="iconfont icon-xiangxia"></i>
              </a>
              <ul id="select">
                <li><a target="blank" href="https://www.uupoop.com/">Photoshop</a></li>
                <li><a target="blank" href="https://smallpdf.com/cn/word-to-pdf/">转Pdf</a></li>
                <li><a target="blank" href="https://soufan.xyz/">磁力搜索</a></li>
                <li><a target="blank" href="https://www.xitmi.com/">绿软大全</a></li>
              </ul>
            </li>
            <li>
              <a href="">打赏</a>
              <div>
                <img src="img/payment.png" alt="">
              </div>
            </li>
            <li><a href="https://github.com/front6">My Github</a></li>
          </ul>
        </div>
        <div class="hidden-lg hidden-md col-sm-6 col-xs-6">
              <i class="iconfont icon-caidan" data-toggle="collapse" 
              data-target="#mquery"></i>
              <ul id="mquery" class="nav nav-pills nav-stacked collapse">
                <li class="active"><a href="#">主页</a></li>
                <li><a onclick="query()">查询</a></li>
                <li>
                  <a onclick="upapper()" data-toggle="collapse" data-target="#up_file">上传<i id="up_file_i" style="float: right;" class="iconfont icon-xiangxia"></i></a>
                  <form  id="up_file" class="collapse" method="POST"  action="upload.php" enctype="multipart/form-data">
                    <input type="file" onchange="return checkfile(this);" name="file" class="form-control">
                    <button type="submit" class="btn btn-default btn-block">提交</button>
                  </form>
                </li>
                <li id="morefeature">
                  <a>更多功能</a>
                  <ul>
                    <li><a target="_blank" href="https://www.uupoop.com/">Photoshop</a></li>
                    <li><a target="_blank" href="https://smallpdf.com/cn/word-to-pdf/">转Pdf</a></li>
                    <li><a target="_blank" href="https://soufan.xyz/">磁力搜索</a></li>
                    <li><a target="_blank" href="https://www.xitmi.com/">绿软大全</a></li>
                  </ul>
                </li>
                <li>
                  <a target="blank" href="img/payment.png">打赏</a>
                </li>
                <li><a href="https://github.com/front6">My Github</a></li>
              </ul>   
        </div>
      </section>
    </header>
    <section class="banner">
    </section>
    <h1 align="center">14Netdisk,to be the coolest Netdisk</h1>
    <div class="container resource">
    <form action="" method="post" name="batch" id="batch">
      <ul class="row">
        <li class="col-lg-3 col-xs-3 col-md-3 col-sm-3">文件名</li>
        <li class="col-lg-2 col-xs-2 col-md-2 col-sm-2">大小</li>
        <li class="col-lg-3 col-xs-3 col-md-3 col-sm-3">日期</li>
        <li class="col-lg-2 col-xs-2 col-md-2 col-sm-2">下载数</li>
        <li class="col-lg-2 col-xs-2 col-md-2 col-sm-2">操作</li>
      </ul>
      <?php
        // $path = "./storage/";
        // if (is_dir($path)){
        //     $op = opendir($path);
        //     while(($file = readdir($op))!=false){//赋值不能失败
        //         if ($file == "." || $file == "..") continue;
        //         $fp = $path.$file;
        //         $size = round(filesize($fp)/1024/1024,2);
        //         $time = date("y.m.d",fileatime($fp));
        //         $sql = "select freque from netdisk where name='".$file."'";
        //         $result = $mysqli->query($sql);
        //         $freque = $result->fetch_row();
    //  以上是从本地获取文件列表,懒得写遍历模糊匹配了,所以将文件名和下载量放在数据库中.
        $sql = isset($_GET['kw'])?"select * from netdisk where name like '%".$_GET['kw']."%'" : "select * from netdisk";
        $result = $mysqli->query($sql);
        $list = $result->fetch_all();
        foreach($list as $v){
        $size = round(filesize('./storage/'.$v[0])/1024/1024,2);
        $time = date("y.m.d",fileatime('./storage/'.$v[0]));
        $splite = explode('.',$v[0]);
        if (strnatcasecmp($splite[1],"mp3")==0 || strnatcasecmp($splite[1],"mp4")==0 || strnatcasecmp($splite[1],"wav")==0){
          $aname="播放";
        }else if(strnatcasecmp($splite[1],"jpg")==0 || strnatcasecmp($splite[1],"png")==0 || strnatcasecmp($splite[1],"bmp")==0 || strnatcasecmp($splite[1],"jpeg")==0 || strnatcasecmp($splite[1],"gif")==0){
          $aname="查看";
        }else{
          $aname="";
        }
        /* 读取输出,用checkbox[]记录批量操作,并用表单提交到download and delete */
        echo <<<file
        <ul class="row"> 
        <li class="col-lg-3 col-xs-3 col-md-3 col-sm-3"><input type="checkbox" name="all[]" value="$v[0]">$v[0]</li>
        <li class="col-lg-2 col-xs-2 col-md-2 col-sm-2">{$size}M</li>
        <li class="col-lg-3 col-xs-3 col-md-3 col-sm-3">$time</li>
        <li class="col-lg-2 col-xs-2 col-md-2 col-sm-2">$v[1]</li>
        <li class="col-lg-2 col-xs-2 col-md-2 col-sm-2">
          <a onclick="dd('$v[0]');" href="#">下载</a>
          <a href="delete.php?name=$v[0]">删除</a>
          <a href="./storage/$v[0]" target="_blank">$aname</a>          
        </li>
       </ul>
file;
      }
      ?>
    </form>
    </div>
    <!-- sidebar批处理 -->
    <div id="sidebar">
        <button type="submit" form="batch" formaction="download.php" style="background:transparent" class="btn btn-default">下载</button><br>
        <button type="submit" form="batch" formaction="delete.php" style="background:transparent" class="btn btn-default">删除</button><br>
        <button style="background:transparent" onclick="chooseall(this);" class="btn btn-default">全选</button>
    </div>
    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
  </body>
</html>
<?php
mysqli_close($mysqli);
?>