<?php
    $mysqli = new mysqli("127.0.0.1",'web','fjf88888',"web",'3306','utf8');
    if ($mysqli->connect_erron){
        die("连接失败".$mysqli->connect_error);
    }
    if ($_FILES["file"]["error"]>0){
        die("<script>alert('错误,请检查是否选择了文件');window.location=index.php</script>");
    }
    $sql = "insert into netdisk values('".$_FILES['file']['name']."',0)";
    $mysqli->query($sql) or die("<script>alert('文件已存在');window.location.href='index.php';</script>");
    // echo "上传文件名".$_FILES["file"]["name"]."<br>";
    // echo "文件类型".$_FILES["file"]["type"]."<br>"; 
    // echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    // echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"];
    move_uploaded_file($_FILES['file']['tmp_name'], "./storage/".$_FILES['file']['name']);
    echo "<script>alert('上传成功');window.location='index.php';</script>";
    mysqli_close($mysqli);
?>