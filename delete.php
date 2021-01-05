<?php
    if($_COOKIE['pms']!='admin')
        die('<script>alert("您无权进行此操作,如需提升权限,请联系管理员");window.location="index.php"</script>');
    $mysqli = new mysqli("127.0.0.1","web","fjf88888","web","3306","utf-8");
    if($mysqli->connect_erron){
        die('<script>alert("连接失败'.$mysqli->connect_error.'")</script>');
    }
    $mysqli->select_db('web');
    $mysqli->set_charset('utf8');
    if(isset($_GET['name'])){
        $v = $_GET['name'];
        unlink("./storage/".$_GET['name']);
    }else if (isset($_POST['all'])){
        $v = implode("','",$_POST['all']);
        foreach ($_POST['all'] as $name){
            unlink("./storage/".$name);
        }
    }
    $sql = "delete from netdisk where name in ('".$v."')";
    // $sql = "delete from netdisk where name = '1'";
    $mysqli->query($sql);
    if (mysqli_affected_rows($mysqli)==0)
        die('<script>alert("删除失败,请检查网络是否有问题");window.location.href="index.php"</script>');
    echo '<script>alert("删除成功");window.location.href="index.php"</script>';
?>