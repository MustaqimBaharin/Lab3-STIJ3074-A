<?php
session_start();
include_once("dbconnect.php"); // connect to database
$email = trim($_POST['email']); // post the email
$password = trim(sha1($_POST['password'])); // password with encryption sha1
$sqllogin = "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password'";
// tbl_user in MySQL

$select_stmt = $conn->prepare($sqllogin);
$select_stmt->execute();
$row = $select_stmt->fetch(PDO::FETCH_ASSOC);
if ($select_stmt->rowCount() > 0) {
    $_SESSION["session_id"] = session_id();
    $_SESSION["email"] = $email;
    $_SESSION["name"] = $row['name'];
    echo "<script> alert('Login Successful')</script>"; // show, if login to Database success
    echo "<script> window.location.replace('../php/menu.php')</script>"; // enter the next page (Menu) after success
} else {
    session_unset();
    session_destroy();
    echo "<script> alert('Login Fail / Wrong Account')</script>"; // show, if login to Database failed
    echo "<script> window.location.replace('../html/login.html')</script>"; // stay at login page if login fail
}