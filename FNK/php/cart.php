<?php
session_start();
include_once("dbconnect.php");
if (!isset($_COOKIE['email'])) {
    echo "<script>loadCookies()</script>";
    echo "<script> window.location.replace('../php/menu.php')</script>";
} else {
    $email = $_COOKIE["email"];
    if (isset($_GET['button'])) {
        $op = $_GET["button"];
        if ($op == "delete") {
            $prid = $_GET['prid'];
            $sqldelete = "DELETE FROM tbl_carts WHERE email='$email' AND prid = '$prid'";
            $stmt = $conn->prepare($sqldelete);
            if ($stmt->execute()) {
                echo "<script> alert('Delete Success')</script>";
                echo "<script>window.location.replace('cart.php')</script>";
            } else {
                echo "<script> alert('Delete Failed')</script>";
            }
        }
        if ($op == "addcart") {
            $prid = $_GET['prid'];
            $sqlupdatecart = "UPDATE tbl_carts SET qty = qty +1 WHERE prid = '$prid' AND email = '$email'";
            if ($conn->exec($sqlupdatecart)) {
                echo "<script>alert('Success')</script>";
                echo "<script> window.location.replace('cart.php')</script>";
            } else {
                echo "<script>alert('Failed add')</script>";
                echo "<script> window.location.replace('cart.php')</script>";
            }
        }
        if ($op == "removecart") {
            $prid = $_GET['prid'];
            $qty = $_GET['qty'];
            if ($qty == 1) {
                echo "<script>alert('Failed.')</script>";
                echo "<script> window.location.replace('cart.php')</script>";
            } else {
                $sqlupdatecart = "UPDATE tbl_carts SET qty = qty - 1 WHERE prid = '$prid' AND email = '$email'";
                if ($conn->exec($sqlupdatecart)) {
                    echo "<script>alert('Success')</script>";
                    echo "<script> window.location.replace('cart.php')</script>";
                } else {
                    echo "<script>alert('Failed')</script>";
                    echo "<script> window.location.replace('cart.php')</script>";
                }
            }
        }
    }
    $sqlloadcart = "SELECT * FROM tbl_carts INNER JOIN tbl_products ON tbl_carts.prid = tbl_products.prid WHERE tbl_carts.email = '$email'";
    $stmt = $conn->prepare($sqlloadcart);
    $stmt->execute();
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $rows = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Fatimah Nasi Kandar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script src='../js/myscript.js'></script>
</head>

<body onload="loadCookies()">
    
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
        </div>
    
    </div>
    <center>
        <h2>Your Cart</h2>
    </center>
    <?php
    $sumtotal = 0.0;
    echo "<div class='container'>";
    echo "<div class='card-row'>";
    foreach ($rows as $carts) {
        $prid = $carts['prid'];
        $qty = $carts['qty'];
        $total = 0.0;
        $total = $carts['prprice'] * $carts['qty'];
        $imgurl = "../images/" . $carts['picture'];
        echo " <div class='card'>";
        echo "<p align='right'><a href='cart.php?button=delete&prid=$prid' class='fa fa-remove' onclick='return deleteDialog()' style='text-decoration:none'></a></p>";
        echo "<img src='$imgurl' class='primage'>";
        echo "<h4 align='center' >" . ($carts['prname']) . "</h3>";
        echo "<p align='center'> RM " . number_format($carts['prprice'], 2) . "/unit<br>";
        echo "<table class='center'><tr><td><a href='cart.php?button=removecart&prid=$prid&qty=$qty'><i class='fa fa-minus' ' style='font-size:24px;color:dodgerblue'></i></a></td>";
        echo "<td>Qty " . $qty . "</td>";
        echo "<td>&nbsp<a href='cart.php?button=addcart&prid=$prid&qty=$qty'><i class='fa fa-plus' ' style='font-size:24px;color:dodgerblue'></i></a></td></tr></table>";
        echo "Total RM " . number_format($total, 2) . "<br>";
        echo "</div>";
        $sumtotal = $total + $sumtotal;
    }
    echo "</div>";
    echo "</div>";
    echo "<div class='container-src'>

    <style>
    h3 {text-align: center;}
    </style>
    
    <h3>Total Price: RM " . number_format($sumtotal, 2) . "</h3></div>";
    ?>
    <div class="container">
        <h3>Payment Form</h3>
        <form action="cart.php" method="get">
            <div class="row">
                <div class="col-25">
                    <label for="lblemail">Your Email</label>
                </div>
                <div class="col-75">
                    <input type="text" id="idemail" name="email" value="<?php echo $email ?>" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="lblname">Your Name</label>
                </div>
                <div class="col-75">
                    <input type="text" id="idname" name="name" placeholder="Your Name" required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                    <label for="lphone">Phone Number</label>
                </div>
                <div class="col-75">
                    <input type="text" id="idphone" name="phone" placeholder="Your phone" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                    <label for="ltime">Pickup Time</label>
                </div>
                <div class="col-75"> 

                <style>
                    div {text-align: left;}
                    </style>

                    <input type="time" id="idtime" name="pickup" min="09:00" max="18:00" required>
                </div>
            </div>
            <input type="hidden" id="idprice" name="price" value="<?php echo $sumtotal ?>">
            <div class="row">
                <div class="col-25">
                </div>
                <div class="col-85">
                    <input type="submit" name="button" value="Pay Now">
                </div>
            </div>
        </form>
    </div>
    <br><br><br><br>
    <div class="bottomnavbar">
        <a href="../html/contact.html">Contact Us</a>
        </div>
</body>

</html>