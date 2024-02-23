<?php

#including connection db file.
include("inc/connections.php");

/* in case insert username & email & password with remove inserting scriptc with / & birthday and gender with no error */
if (isset($_POST['submit'])) {

    $username = stripslashes(strtolower($_POST['username']));
    $email    = stripslashes($_POST['email']);
    $password = stripslashes($_POST['password']);

    $birthday = "";

    if ((isset($_POST['birthday_day']) && !empty($_POST['birthday_day'])) &&
        isset($_POST['birthday_month']) && !empty($_POST['birthday_month'] &&
            isset($_POST['birthday_year']) && !empty($_POST['birthday_year']))
    ) {
        $birthday_day   = (int) $_POST['birthday_day'];
        $birthday_month = (int) $_POST['birthday_month'];
        $birthday_year  = (int) $_POST['birthday_year'];
        $birthday = htmlentities(mysqli_real_escape_string($conn, $birthday_day . '-' .  $birthday_month . '-' .  $birthday_year));
        /* htmlentities convert html code to letter */
        /* mysqli_real_escape_string  avoid me from sql ingection */
    }

    $username = htmlentities(mysqli_real_escape_string($conn, $_POST['username']));
    $email    = htmlentities(mysqli_real_escape_string($conn, $_POST['email']));
    $password = htmlentities(mysqli_real_escape_string($conn, $_POST['password']));
    $md5_pass = md5($password);

    if (isset($_POST['gender'])) {
        $gender = ($_POST['gender']);
        $gender = htmlentities(mysqli_real_escape_string($conn, $_POST['gender']));
        if (!in_array($gender, (['male', 'female']))) {
            $gender_error = '<p style= "color :red">Please Choose The Gender Not Text ! <br>';
            $err_s = 1;
        }
    }

    /* errors for username empty or <6 letter or putting int */
    if (empty($username)) {
        $user_error = '<p style= "color :red">Please Enter User Name</p> ';
        $err_s = 1;
    } elseif (strlen($username) < 6) {
        $user_error = '<p style= "color :red">your user name have minimum 6 letters</p>  ';
        $err_s = 1;
        /* FILTER_VALIDATE_INT to provid from user name int. */
    } elseif (filter_var($username, FILTER_VALIDATE_INT)) {
        $user_error = '<p style= "color :red">Please insert valied name not INT </p>';
        $err_s = 1;
    }

    /* errors  email empty or right email */
    if (empty($email)) {
        $email_error = '<p style= "color :red">Please Enter Email</p> ';
        $err_s = 1;
        // avoid from bad email
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $user_error = '<p style= "color :red">Please insert valied email not INT</p> ';
        $err_s = 1;
    }

    /* errors for choosing gender */
    if (empty($gender)) {
        $gender_error = '<p style= "color :red">Please choose gender</p> ';
        $err_s = 1;
    }

    /* errors for empty birthday  */
    if (empty($birthday)) {
        $birthday_error = '<p style= "color :red">Please insert birthday</p> ';
        $err_s = 1;
    }


    /* error empty password or <6 letters */
    if (empty($password)) {
        $pass_error = '<p style= "color :red">Please insert passrowd</p> ';
        $err_s = 1;
    } elseif (strlen($password) < 6) {
        $pass_error = '<p style= "color :red">your password have minimum 6 letters </p> ';
        $err_s = 1;
    }
    #end validation phase.


    /* check if user name is already exsit or no. */
    $check_user = "SELECT * FROM `users` WHERE username= '$username'";
    $check_result = mysqli_query($conn, $check_user);
    $num_rows = mysqli_num_rows($check_result);
    if ($num_rows != 0) {
        $username_error = '<p style= "color :red"> Sorry user name already exsit, Please use another  !</p> <br>';
        $err_s = 1;
    }

    if ($err_s == 0) {
        $sql = "INSERT INTO users(username , password , email , birthday , gender , md5_pass )
         VALUES ('$username' , '$password ' , '$email' , '$birthday' , '$gender' , '$md5_pass' ) ";
        mysqli_query($conn, $sql);
        header('location: index.php');
    } else {
        include('register.php');
    }
}
