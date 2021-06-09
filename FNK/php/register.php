<?php
    include_once("dbconnect.php"); // connect to database
     $name = $_POST["name"]; // post the name
     $email = $_POST["email"]; // post the email
     $phone = $_POST["phone"]; // post the phone number
     $district = $_POST["district"]; // post the district
     $passa = $_POST["passworda"]; // post the password
     $passb = $_POST["passwordb"]; // post the confirmation password
     $shapass = sha1($passa);  // password with encryption sha1

     if (!(isset($name) || isset($email) || isset($phone) || isset($school) || isset($passa) || isset($passb))){
         echo "<script>alert('Please fill in all required information')</script>";// show, if user not fill details
         echo "<script>window.location.replace('../html/register.html')</script>"; // stay at register page if user not fill details
     }else{
        $sqlregister = "INSERT INTO tbl_user(email,phone,name,district,password) VALUES('$email','$phone','$name','$district','$shapass')";
        // tbl_user in MySQL
        try{
            $conn->exec($sqlregister);
            echo "<script> alert('Registration successful')</script>"; // show, if register to Database success
            echo "<script> window.location.replace('../html/login.html')</script>"; // return the login page after success
        }catch(PDOException $e){
            echo "<script> alert('Registration failed')</script>"; // show, if register to Database fail
            echo "<script> window.location.replace('../html/register.html')</script>"; // stay at register page if register failed
        }
     }
?>