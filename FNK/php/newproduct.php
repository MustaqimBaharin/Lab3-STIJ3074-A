<?php
session_start();

if ($_SESSION["session_id"]) {
    $username = $_SESSION["email"];
    $name = $_SESSION["name"];
} else {
    echo "<script> alert('Session not available. Please login')</script>";
    echo "<script> window.location.replace('../html/login.html')</script>";
}
include_once("dbconnect.php");

if (isset($_POST['button'])) {
    $prname = $_POST['prname'];
    $prtype = $_POST['prtype'];
    $prprice = $_POST['prprice'];
    $prqty = $_POST['prqty'];
    $picture = uniqid() . '.png';

if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
        $sqlinsertprod =  "INSERT INTO tbl_products(prname, prtype, prprice, prqty,picture) VALUES('$prname','$prtype','$prprice','$prqty','$picture')";
        if ($conn->exec($sqlinsertprod)) {
            uploadImage($picture);
            echo "<script>alert('Success')</script>";
            echo "<script>window.location.replace('../php/menu.php')</script>";
        } else {
            echo "<script>alert('Failed')</script>";
            return;
        }
} else {
        echo "<script>alert('Image not available')</script>";
        return;
    }
}

function uploadImage($picture)
{
    $target_dir = "../images/";
    $target_file = $target_dir . $picture;
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Fatimah Nasi Kandar</title>
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

    <div class="main">
        <h1 style="color:white;">New Menu</h1>


        <div class="container-pr">
            <form action="newproduct.php" method="post" enctype="multipart/form-data">
                <div class="row-pr" align="center">
                    <img class="imgselection-pr" src="images.png"><br>
                    <input type="file" onchange="previewFile()" name="fileToUpload" id="fileToUpload"
                        accept="image/*"><br>
                </div>
                <div class="row-pr">
                    <div class="col-25-pr">
                        <label for="fprname">Menu Name</label>
                    </div>
                    <div class="col-75-pr">
                        <input type="text" id="fprname" name="prname" placeholder="Enter menu name.">
                    </div>
                </div>
                <div class="row-pr">
                    <div class="col-25-pr">
                        <label for="prtype">Menu Type</label>
                    </div>
                    <div class="col-75-pr">
                        <select id="idprtype" name="prtype">
                            <option value="ayam">Ayam</option>
                            <option value="daging">Daging</option>
                            <option value="ikan">Ikan</option>
                            <option value="sotong">Sotong</option>
                            <option value="udang">Udang</option>
                        </select>
                    </div>
                </div>
                <div class="row-pr">
                    <div class="col-25-pr">
                        <label for="lprice">Price (RM)</label>
                    </div>
                    <div class="col-75-pr">
                        <input type="text" id="idprice" name="prprice" placeholder="Enter Price.">
                    </div>
                </div>
                <div class="row-pr">
                    <div class="col-25-pr">
                        <label for="lqty">Quantity</label>
                    </div>
                    <div class="col-75-pr">
                        <input type="text" id="idqty" name="prqty" placeholder="Enter Available Quantity.">
                    </div>
                </div>
                <div class="row-pr">
                    <div class="col-25-pr">
                    </div>
                    <div class="col-75-pr">
                        <input type="submit" name="button" value="Upload">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    </div>
    <div class="bottomnavbar">
        <a href="../html/contact.html">Contact Us</a>
    </div>
    </div>
</body>

</html>