<?php
session_start();
include("inc/connections.php");
#chking for username & password..
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = stripcslashes(strtolower($_POST['username']));
    $password = md5($_POST['password']);
}
if (empty($username)) {
    $user_error = '<p style= "color :red">Please Enter User Name</p> ';
    $err_s = 1;
}
if (empty($password)) {
    $pass_error = '<p style= "color :red">Please insert passrowd</p> ';
    $err_s = 1;
}


//if not set errors 
if (!isset($err_s)) {
    //check data entered from user [usermane ,id , md5 password]
    $sql = "SELECT * FROM  users WHERE username = '$username' AND  md5_pass = '$password' ";
    // conect to databass 
    $result = mysqli_query($conn, $sql);
    //store session data needed
    $row = mysqli_fetch_assoc($result);
    //check for data
    if ($row['username'] === $username && $row['md5_pass'] === $password) {
        //stor data in the session
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['id'] = $row['id'];
        //if data is right go to home page
        header('Location: home.php');
        exit();
    } else {
        $user_error = '<p style= "color :red">worng user name or passrowd</p> ';
        include('index.php');
        exit();
    }
}
