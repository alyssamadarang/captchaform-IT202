<?php
session_start();

// error reporting
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);


// connect to database
include ("account.php");

$db = mysqli_connect($hostname, $username, $password, $project);
if (mysqli_connect_errno()) {
  echo "<strong>Failed to connect to MYSQL: </strong>" . mysqli_connect_error();
  exit();
}

echo "<br> <strong> Succesfully connected to MYSQL. </strong><br> <hr>";
mysqli_select_db($db, $project);

// include functions
include ("functions.php");

echo "<br> Hello!";

// initialize variables
$dataOK = True;
$warnings = "";


// get data
$ucid = get("ucid", $dataOK);
$password = get("password", $dataOK);
$guess = get("guess", $dataOK);
$delay = get("delay", $dataOK);
echo "<strong>$warnings</strong>";

if (!$dataOK) {
  header ("refresh: $delay; url = login.html");
  exit();
}

// check captcha
$captcha = $_SESSION["captcha"];
$backdoor = "777";

// with backdoor of "777"
if ($dataOK && !(($guess == $backdoor) || ($guess == $captcha))) {
  // redirection code
  echo "<br>Wrong Captcha guess.";
  header ("refresh: $delay; url = login.html");
  exit();
}

// check credentials
if ($dataOK && (!authenticate($ucid, $password))) {
  // redirection code
  echo "<br>Wrong credentials.";
  header ("refresh: $delay; url = login.html");
  exit();
}

// login
$_SESSION["logged"] = true;
$_SESSION["ucid"] = $ucid;

echo "<strong>Being redirected to protected service page.<br></strong>";
header ("refresh: $delay; url = protected1.php");
exit();

?>
