<?php
session_start();
include_once("pdo_connect.php");
$delete = date('Y-m-d H-i-s');
$id = $_POST['id'];

$statement = $pdo->prepare('UPDATE userblog SET deleted_at = :deleted_at WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->bindValue(':deleted_at', $delete);
$statement->execute();


header("Location: listing.php");
