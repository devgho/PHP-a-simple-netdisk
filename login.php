<?php
$mysqli = new mysqli('127.0.0.1','web','fjf88888','web','3306');
$mysqli->select_db('web');
$mysqli->set_charset('utf-8');
if ($mysqli->connect_errno){
    die("网络错误");
}
if (isset($_GET['logout']))
    setcookie('pms','',time()-1);
// if(isset($_POST['']))
/* 用表单传来的Button值进行判断 */
if (isset($_POST['r'])){
    $sql = "insert into user values('".$_POST['uid']."','".$_POST['pwd']."','normal')";
    $mysqli->query($sql) or die("<script>alert('用户名已被注册');window.location ='login.php';</script>");
    echo "<script>alert('注册成功!');window.location ='login.php';</script>";
}
if (isset($_POST['l'])){
    $sql = "select pwd,pms from user where uid='".$_POST['uid']."'";
    $result = $mysqli->query($sql);
    $pwd = $result->fetch_row();
    if ($pwd[0]!="" && $pwd[0] == $_POST['pwd']){
        setcookie('pms',$pwd[1],time()+3600);//设置Cookie记录已登录及权限
        echo '<script>alert("登录成功'.$pwd[1].'");window.location="index.php"</script>';
    }else{
        echo '<script>alert("用户名或密码错误");</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no">
    <title>Welcome to 14Netdisk</title>
    <!-- My css -->
    <link href="./css/login.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="banner">
    </div>
    <div id="outside">
        <div class="loginbox container">
            <div class="box-header row">
                <div class="col-lg-12 col-xs-12 col-sm-12 col-md-12">
                    <img src="img/14.jpg" alt="">
                    <span>14网盘</span>
                </div>
            </div>
            <!-- pattern要配合required使用 -->
            <form id="login" method="post">
                <div class="input-group input-group-md">
                    <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
                    <input type="text" pattern="^[a-zA-Z0-9_-]{4,16}$" required="required" title="4-16位(字母，数字，下划线)" class="form-control" id="uid" name="uid" placeholder="请输入用户名"/>
                </div>
                <div class="input-group input-group-md">
                    <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" pattern=".{6,20}" title="6-20位任意字符" required="required" class="form-control" id="pwd" name="pwd" placeholder="请输入密码"/>
                </div>
                <br/>
                <button name="l" type="submit" class="btn btn-default btn-info btn-block">登录</button>
                <button name="r" type="submit" class="btn btn-default btn-block">注册</button>
            </form>
        </div>
    </div>
</body>
</html>
<?php
mysqli_close($mysqli);
?>