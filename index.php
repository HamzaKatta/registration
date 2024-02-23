<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <div class="container">
        <p style="color :red"></p>

        <h1>Log In</h1>
        <i>Let's Enjoy</i>
        <br>

        <br>

        <form action="login.php" method="post">
            <?php
            if (isset($user_error)) {
                echo $user_error;
            }
            ?>
            <input type="text" name="username" id="username" placeholder="User Name">
            <br>
            <br>
            <?php
            if (isset($pass_error)) {
                echo $pass_error;
            }
            ?>
            <input type="password" name="password" id="password" placeholder="Enter Your Password">

            <br>
            <br>

            <input class="login" type="submit" id="submit" value="Log In">
        </form>
        <h3><i>Or</i></h3>
        <br>
        <a href="register.php">Register</a>
    </div>
</body>

</html>