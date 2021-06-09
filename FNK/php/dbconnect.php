<?php
$servername = "sql310.epizy.com";
$username = "epiz_28228917";
$password = "Gt5hjpRq6ItG";
$dbname = "epiz_28228917_fatimahdatabase";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>