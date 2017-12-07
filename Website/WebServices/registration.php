<?php
//include 'dbConnect.php';
include 'functions.php';
function register($username, $email, $password) {
    $link = openPerConn();
    switch (checkUserExist($username, $email, $link)) {
        case 0: break;
        case 1: return '1_1';
        case 2: return '1_2';
    }
    $error = checkEmailBanned($email, $link);
    if($error !== 0) {
        return $error;
    }
    $salt = genSalt(5);
    $regIp = ip2long('123.126.131.54');
    $passHash = md5($password);
    return insertUser($link, $username, $email, $salt, $passHash, $regIp);
    closeConn($link);
}
?>