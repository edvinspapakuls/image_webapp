<?php

function emptyInputSignup($username, $psw, $psw_repeat) {
    $result;
    if (empty($username)||empty($psw)||empty($psw_repeat)) {#if data empty, then error is true
        $result = true;
    }
    else {
        $result = false;#if else, then error is false
    }
    return $result;#returns data to receiver
}

// function invalidUsername($username) {
//     $result;
//     if (!preg_match("/^[a-zA-Z0-9]*$//"), $username) {#checks if data incudes these characters
//         $result = true;
//     }
//     else {
//         $result = false;
//     }
//     return $result;
// }

function pswMatch($psw, $psw_repeat) {
    $result;
    if ($psw !== $psw_repeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function createUser($db_connection, $username, $psw) {
    $sql = "insert into public.users(username, user_password) values('".$username."', '".$psw."')";
    $data = pg_query($db_connection, $sql);

    $on = true;
    if($on = true) {
    $sql2 ="select * from public.users where username = '".$username."' and user_password ='".$psw."'";
    $data2 = pg_query($db_connection, $sql2);
    $user_data = pg_fetch_assoc($data2);
    $sql3 = "insert into public.profile(user_id, pfp_status) values('".$user_data['user_id']."', '0')";
    $data3 = pg_query($db_connection, $sql3);
    }

    header("location: ../login.php");
}

function loginUser($db_connection, $username, $password) {
    $sql ="select * from public.users where username = '".$username."' and user_password ='".$password."'";
    $data = pg_query($db_connection,$sql);
    $login_check = pg_num_rows($data);
    if($login_check > 0){ 

        $user_data = pg_fetch_assoc($data);

        session_start();
        $_SESSION['user'] = $user_data['username'];
        $_SESSION['userid'] = $user_data['user_id'];
        
        header("location: ../home.php?error=welcome");
        exit();
    }
    else {
        
        header("location: ../login.php?error=wronginfoentered");
        exit();
    }
}

