<?php

require_once 'db.inc.php';
require_once 'functions.inc.php';

session_start();

$sql ="select * from public.profile where user_id = '".$_SESSION['userid']."'";
$data = pg_query($db_connection, $sql);
$user_data = pg_fetch_assoc($data);
$pfp_status = $user_data['pfp_status'];

if (isset($_POST['submit'])) {
    $file = $_FILES['file'];#taking the file's data
    $tname = $_FILES["file"]["tmp_name"];
    $name = rand(1,1000000)."-".$file["name"];
    $uploads_dir = '../files/images';
    move_uploaded_file($tname, $uploads_dir.'/'.$name);
    $sql = "update public.profile set pfp_status = '".$name."' where user_id = '".$_SESSION['userid']."'";
    pg_query($db_connection, $sql);
    header("location: ../home.php");
}

