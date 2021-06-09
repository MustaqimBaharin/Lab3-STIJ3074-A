<?php
session_start();
include_once("dbconnect.php");

if ($_SESSION["session_id"]) {
    $username = $_SESSION["email"];
    $name = $_SESSION["name"];

    if (isset($_POST['submit'])) {
        $nname = $_POST["name"];
        $phone = $_POST["phone"];
        $district = $_POST["district"];
        $current = sha1($_POST["oldpassword"]);
        $pass = $_SESSION["pass"];
        if ($current == $pass) {
            if (isset($_POST["newpassworda"]) || isset($_POST["newpasswordb"])) {
                $npassa = $_POST["newpassworda"];
                if (!(empty($npassa) || empty($npassb))) {
                    if ($npassa == $npassb) {
                        $newpass = sha1($npassa);
                        $sqlupdate = "UPDATE tbl_user SET name='$nname', phone='$phone',district='$district',password= '$newpass' WHERE email = '$username'";
                    }
                } else {
                    $sqlupdate = "UPDATE tbl_user SET name='$nname', phone='$phone',district='$district' WHERE email = '$username'";
                }
            }
            if (isset($_FILES['fileToUpload']['name'])) {

                uploadImage($username);
            }

            $conn->exec($sqlupdate);
            echo "<script>alert('Update successful')</script>";
            echo "<script>window.location.replace('../php/login.php')</script>";
        } else {
            echo "<script> alert('Current password do not match')</script>";
        }
    }
} else {
    echo "<script> alert('Session not available. Please login')</script>";
    echo "<script> window.location.replace('../php/login.php')</script>";
}

function uploadImage($email)
{
    $target_dir = "../images/profile/";
    $target_file = $target_dir . $email . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Main Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="../js/validate.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
    <div class="header">
        <h1>Fatimah Nasi Kandar Self-Pickup</h1>
        <p>Origin from Perlis, Since 1996</p>
    </div>

    </div>
    <div class="topnavbar" id="myTopnav">
        <a href="menu.php">Menu</a>
        <a href="../php/cart.php"> My Cart</a>
        <a href="myprofile.php">My Profile</a>
        <a href="../html/login.html" onclick="logout()" class="right">Logout</a>
        <a href="#contact" onClick="return loadCookies()">Email</a>
        <a href="javascript:void(0);" class="icon" onclick="mytopnavFunction()">
            <i class="fa fa-bars"></i>
        </a>
    </div>

    <div class="main2">
        <center>
            <div class="container">

                <form name="updateprofileForm" action="profile.php" onsubmit="return validateUpdForm()" method="post"
                    enctype="multipart/form-data">
                    <div class="row-single">
                        <img class="imgselection-pr" src="images.png"><br>
                        <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload"
                            accept="image/*"><br>
                    </div>


                    <div class="row">
                        <div class="col-25">
                            <label for="fname">Name</label>
                            <!--name form for Register-->
                        </div>
                        <div class="col-75">
                            <input type="text" id="idname" name="name" placeholder="Enter name">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="lname">Email</label>
                            <!--email form for Register-->
                        </div>
                        <div class="col-75">
                            <input type="text" id="idemail" name="email" placeholder="Enter valid email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="lphone">Phone</label>
                            <!--phone number form for Register-->
                        </div>
                        <div class="col-75">
                            <input type="tel" id="idphone" name="phone" placeholder="Your phone number without (-)">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="district">Districts</label>
                            <!--district in Perlis form for Register-->
                        </div>
                        <div class="col-75">
                            <select name="district" id="iddistrict">
                                <option value="noselection">Please select your district</option>
                                <option value="Abi">Abi</option>
                                <option value="Arau">Arau</option>
                                <option value="Beseri">Beseri</option>
                                <option value="Chuping">Chuping</option>
                                <option value="Jejawi">Jejawi</option>
                                <option value="Kaki Bukit">Kaki Bukit</option>
                                <option value="Kayang">Kayang</option>
                                <option value="Kechor">Kechor</option>
                                <option value="Kuala Perlis">Kuala Perlis</option>
                                <option value="Kurong Anai">Kurong Anai</option>
                                <option value="Kurong Batang">Kurong Batang</option>
                                <option value="Ngulang">Ngulang</option>
                                <option value="Oran">Oran</option>
                                <option value="Padang Pauh">Padang Pauh</option>
                                <option value="Sanglang">Sanglang</option>
                                <option value="Sena">Sena</option>
                                <option value="Seriab">Seriab</option>
                                <option value="Sungai Adam">Sungai Adam</option>
                                <option value="Titi Tinggi (Padang Besar)">Titi Tinggi</option>
                                <option value="Utan Aji">Utan Aji</option>
                                <option value="Wang Bintong">Wang Bintong</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="lpassword">Password</label>
                            <!--password form for Register-->
                        </div>
                        <div class="col-75">
                            <input type="password" id="idpass" name="passworda" placeholder="Enter password">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-25">
                            <label for="lpassword">Password</label>
                            <!--password form for Register-->
                        </div>
                        <div class="col-75">
                            <input type="password" id="idpassb" name="passwordb" placeholder="Confirmation password">
                        </div>
                    </div>
                    <div class="row">
                        <div><input type="submit" value="Submit"></div>
                        <!--submit button for Register-->
                    </div>
                </form>
            </div><br><br><br><br>
    </div>

    <div class="bottomnavbar">
        <a href="../html/contact.html">Contact Us</a>
    </div>
</body>

</html>