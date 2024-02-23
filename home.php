<?php
session_start();
include("inc/connections.php");
if (isset($_SESSION["id"]) && isset($_SESSION["username"])) {
    $id = $_SESSION["id"];
    $username = $_SESSION["username"];
    $email = $_SESSION["email"];

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link rel="stylesheet" href="css/main.css">
    </head>

    <body>
        <h1>Hallo ,<br>
            <?php echo $username  . ' <br>   EMAIL:    ' .
                $email; ?> </h1>
        <br>
        <a href="logout.php">LOGOUT</a>
    </body>

    </html>
<?php

} else {
    header('Location:index.php');
    exit();
}
?>