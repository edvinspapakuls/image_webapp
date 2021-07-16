<?php

if(isset($_POST["submit"])) {#check if user arrived to this page by submiting data
    $username = $_POST["username"];#take data from input fields and store it into variables
    $psw = $_POST["psw"];
    $psw_repeat = $_POST["psw-repeat"];

    require_once 'db.inc.php';#importing php funcitons from other files
    require_once 'functions.inc.php';

    if (emptyInputSignup($username, $psw, $psw_repeat) !== false) {#tell if user forgot to type something in form
        header("location: ../index.php?error=emptyinput");
        exit();
    }
    // if (invalidUsername($username) !== false) {#tell if user entered invalid username
    //     header("location: ../index.php?error=invalidUsername");
    //     exit();
    // }
    if (pswMatch($psw, $psw_repeat) !== false) {#check if both passwords entered match
        header("location: ../index.php?error=passwordsdontmatch");
        exit();
    }
    // if (userExists($db_connection, $username) !== false) {#check if username already exists
    //     header("location: ../index.php?error=usernametaken");
    //     exit();
    // }
    
    createUser($db_connection, $username, $psw);#if everything is entered right, user
}

else {
    header("location: ../index.php");
}
