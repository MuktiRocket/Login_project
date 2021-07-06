<?php
session_start();
$id = '';
$get_id = '';
$blogsubject = '';
$content = '';
$imagepath = '';
$newimage = '';
include("pdo_connect.php");
include("function.php");
if (isset($_POST['id'])) {
    $id = $_POST['id'] ?? '';
}


$query = $pdo->prepare("SELECT * FROM userblog WHERE id = '$id'");
$query->execute();
$result = $query->fetch();
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        .pad {
            padding: 50px;
        }

        .pad2 {
            padding: 50px;
        }

        .image {
            width: 350px;
        }
    </style>

</head>

<body>

    <h1 class="pad2"><?php echo 'Update ' . $result['username'] . " 's Blog" ?></h1>
    <form class="pad" action="" method="POST" enctype="multipart/form-data">
        <div>
            <?php if ($result['image']) { ?>
                <label>Blog Image</label><br><br>
                <img src="<?php echo $result['image'] ?>" class="image">
            <?php } ?><br><br>
            <input type="file" name="image">

            <br><br>
        </div>
        <div class="mb-3">
            <input type="hidden" class="form-control" name="get_id" value="<?php echo $id ?>">
            <label class="form-label">Blog Subject</label>
            <input type="text" class="form-control" name="subject" value="<?php echo $result['blogsubject'] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Blog Content</label>
            <textarea type="text" class="form-control" cols="30" rows="10" name="content"><?php echo $result['Blogcontent'] ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="submit" class="btn btn-danger">Back</button>

    </form>

</body>

<?php
if (isset($_POST['subject'])) {
    $blogsubject = $_POST['subject'];
}
if (isset($_POST['content'])) {
    $content = $_POST['content'];
}
if (isset($_POST['get_id'])) {
    $get_id = $_POST['get_id'];
}
if (isset($_FILES['image']) && $_FILES['image']['name'] != '') {
    $newimage = $_FILES['image'];
    $imagepath = "xyz/" . randomstring(5) .  $newimage['name'];
    move_uploaded_file($newimage['tmp_name'], $imagepath);

    if ($blogsubject != '' && $content != '' && $newimage != '') {
        $stmnt = $pdo->prepare("UPDATE `userblog` SET `blogsubject` = :blogsubject, `Blogcontent` = :content,  `image` = :image WHERE `id` = :id");
        $stmnt->bindValue(':blogsubject', $blogsubject);
        $stmnt->bindValue(':content', $content);
        $stmnt->bindValue(':image', $imagepath);
        $stmnt->bindValue(':id', $get_id);

        $stmnt->execute();


        header("Location: listing.php");
    }
} else if (isset($_FILES['image'])) {
    $stmnt = $pdo->prepare("UPDATE `userblog` SET `blogsubject` = :blogsubject, `Blogcontent` = :content WHERE `id` = :id");
    $stmnt->bindValue(':blogsubject', $blogsubject);
    $stmnt->bindValue(':content', $content);
    $stmnt->bindValue(':id', $get_id);
    $stmnt->execute();


    header("Location: listing.php");
}
?>

</html>