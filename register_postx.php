<?php

#including connection db file.
include('inc/connections.php');

/* in case insert username & email & password with remove inserting scrept with / & birthday and gender with no error */
if (isset($_POST['submit'])) {

    $err_s = 0;
    # get posted data.
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];

    #chk for birthday
    if (isset($_POST['birthday_day']) && isset($_POST['birthday_month']) && isset($_POST['birthday_year'])) {
        $birthday_day = (int) $_POST['birthday_day'];
        $birthday_month = (int) $_POST['birthday_month'];
        $birthday_year = (int) $_POST['birthday_year'];
        $birthday = htmlentities(mysqli_real_escape_string($conn, $birthday_day . '-' .  $birthday_month . '-' .  $birthday_year));
    } else {
        $birthday_error = 'please insert birthdate correct!! <br>';
        $err_s = 1;
    }

    # chk for username var.
    if (empty($username)) {
        $user_error = '<span style="background:red;">Please Enter User Name</span> <br>';
        $err_s = 1;
    } elseif (strlen($username) < 6) {
        $user_error = ' <p style = "color: red;" > Please insert valied user name </p>  <br>';
        $err_s = 1;
    } elseif (filter_var($username, FILTER_VALIDATE_INT)) {
        $user_error = ' <p style = "color: red;" >Please insert valied name not INT</p> <br>';
        $err_s = 1;
    }

    # email validation.
    if (empty($email)) {
        $email_error = ' <p style = "color: red;" > Please Enter Email </p> <br>';
        $err_s = 1;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $user_error = ' <p style = "color: red;" >Please insert valied email not INT</p> <br>';
        $err_s = 1;
    }

    # gender validation.
    if (empty($gender)) {
        $gender_error = 'Please choose gender <br>';
        $err_s = 1;
    } else {
        if (!in_array($gender, ['male', 'female'])) {
            $gender_error = ' <p style = "color: red;" >Please Choose The Gender Not Text !</p><br>';
            $err_s = 1;
        }
    }

    # password validation.
    if (empty($password)) {
        $pass_error = ' <p style = "color: red;" > Please insert passrowd </p> <br>';
        $err_s = 1;
    } elseif (strlen($password) < 6) {
        $user_error = ' <p style = "color: red;" >Please insert valied password </p> <br>';
        $err_s = 1;
    } else { // true .. all is good !
        $md5_pass = md5($password);
    }

    if ($err_s) {
        /* including regidter page */
        include('register.php');
    } else {
        $sql = "INSERT INTO users(username , password , email , birthday , gender , md5_pass )
            VALUES ('$username' , '$password ' , '$email' , '$birthday' , '$gender' , '$md5_pass' ) ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header('location: index.php');
        } else {
            die('something went wrong!, please try again later!');
        }
    }
}
