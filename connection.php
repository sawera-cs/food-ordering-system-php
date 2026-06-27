<?php
$conn = mysqli_connect("localhost","root","","food_ordering_system");

if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>