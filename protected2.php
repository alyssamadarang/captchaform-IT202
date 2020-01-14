<?php
session_start();

if (! isset($_SESSION["logged"])) {
  echo "<br>Please login.<br><br>";
  header ("refresh: 3; url = login.html");
  exit();
}

echo "<br>You are authorized to be in protected2.php<br>";
$ucid = $_SESSION["ucid"];
echo "Logged in UCID: $ucid";

 ?>

 <p>Link to: <a href="protected1.php">Protected1 script</a></p>
 <p>Click here to <a href="logout.php">Logout</a></p>
