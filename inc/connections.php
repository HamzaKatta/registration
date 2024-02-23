<?php
$conn = mysqli_connect("localhost", "root", "", "youtube");
if (!$conn) {
    die('Error' . mysqli_connect_error());
}

