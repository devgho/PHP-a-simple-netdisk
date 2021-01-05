<?php
$mysqli = new mysqli("127.0.0.1",'web','fjf88888',"web",'3306','utf8');
if ($mysqli->connect_erron){
    die("连接失败".$mysqli->connect_error);
}
$mysqli->select_db('web');
$mysqli->set_charset('utf8');
if (isset($_GET['name'])){
    $v = $_GET['name'];
    header("location:index.php");
}else if (isset($_POST['all'])){
    $v = implode("','",$_POST['all']);//分解一下数组并转换成SQL需要的格式
    // var_dump($_POST['all']);
    echo '<script> var a = document.createElement("a");';
    foreach ($_POST['all'] as $value){
        echo "a.download = '".$value."';
              a.href = './storage/".$value."';
              a.click();";
    }
    echo 'a.remove();
        </script>';
    echo '已开始批量下载,点击<a href="index.php">这里</a>返回';
}
$sql = "update netdisk set freque = freque+1 where name in ('".$v."')";
$mysqli->query($sql);
mysqli_close($mysqli);
?>