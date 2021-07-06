<?php
$username = '';
$subject = '';
$content = '';
$image = '';
$imagepath = '';
$email = '';
session_start();
include_once("pdo_connect.php");
include("function.php");
$username = $_SESSION['user'];
?>



<!DOCTYPE html>
<html lang="en">

<head>

    <title>Create Blog</title>


    <?php require_once('inc_headcss.php'); ?>

    <Style>
        body {
            padding: 50px;
        }
    </Style>
    <h1><?php echo $_SESSION['user'] ?>'s Blog</h1>

    <br><br><br>
</head>



<form method="POST" action="" name="formcreate" enctype="multipart/form-data">
    <div class="form-group">
        <input type="hidden" class="form-control" name="id">
    </div>
    <div class=" form-group">
        <label>Upload Image</label>
        <br>
        <input type="file" name="image">
    </div>
    <div class="form-group">
        <label>Blog Subject</label>
        <input type="text" class="form-control" placeholder="Blog Subject" name="subject">
    </div>
    <div class="form-group">
        <label>Blog Content</label>
        <textarea class="form-control" rows="3" placeholder="Blog Content" name="content"></textarea>
    </div>

    <button type="submit" class="btn btn-success" name="create">Submit</button><br><br><br>

    <a href="dashboard.php" type="submit" class="btn btn-danger">Back</a>
</form>


<?php
if (isset($_POST["create"])) {
    if (isset($_POST["subject"])) {
        $subject = $_POST["subject"];
    }
    if (isset($_POST["content"])) {
        $content = $_POST["content"];
    }
    if (isset($_FILES["image"])) {
        $image = $_FILES["image"];
    }
    $query = $pdo->prepare("SELECT * FROM user WHERE username = '$username' ");
    $query->execute();
    $create_date = date('Y-m-d H-i-s');
    if (!is_dir('xyz')) {
        mkdir('xyz');
    }
    if ($image && $image['tmp_name']) {
        $imagepath = "xyz/" . randomstring(5) .  $image['name'];
        move_uploaded_file($image['tmp_name'], $imagepath);
    }

    if ($subject != '' && $content != '' && $image != '') {


        $qry = $pdo->prepare("INSERT INTO userblog(username,blogsubject ,Blogcontent,image,created_at) VALUES ('$username','$subject','$content','$imagepath','$create_date')");
        $qry->execute();
        // $row = $qry->fetchAll();
        if ($qry) {
            echo 'Saved Successfully';
            header("Location: dashboard.php");
        }
    } else {
        echo "please Enter the Required Fields";
    }
}


?>