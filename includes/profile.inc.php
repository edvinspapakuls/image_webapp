<?php

require_once 'db.inc.php';
require_once 'functions.inc.php';

session_start();

$sql ="select * from public.profile where user_id = '".$_SESSION['userid']."'";
$data = pg_query($db_connection, $sql);
$user_data = pg_fetch_assoc($data);
$pfp_status = $user_data['pfp_status'];

