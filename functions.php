<?php

// get function
function get($fieldname, &$dataOK) {
  global $db, $warnings;

  $inputdata = $_GET[$fieldname];
  $inputdata = trim($inputdata);
  $inputdata = mysqli_real_escape_string($db, $inputdata);

  if (($inputdata == "") && ($fieldname == "ucid")) {
    $warnings .= "<br>Empty UCID field.";
    $dataOK = false;
  }

  if (($inputdata == "") && ($fieldname == "password")) {
    $warnings .= "<br>Empty password field.";
    $dataOK = false;
  }

  if (($inputdata == "") && ($fieldname == "guess")) {
    $warnings .= "<br>You did not enter a guess for the captcha.";
    $dataOK = false;
  }

  if(($inputdata != "") && ($fieldname == "delay") && (!is_numeric($inputdata))) {
    $warnings .= "<br>Entered a non-numeric amount.";
    $dataOK = false;
  }

  print "<br>The $fieldname entered is $inputdata";

  return $inputdata;
}

 // authenticate function
function authenticate ($ucid, $pwd) {
  // $DBpin is an output value

  global $db; //variable from parent program

  $s = "select * from users where ucid='$ucid'";
  // print SQL statement
  print "<br>SQL credentials select statement: $s<br>";


  ($t = mysqli_query($db, $s)) or die (mysqli_error($db));
  $num = mysqli_num_rows($t);
  print "<br>Number of rows retrieved: $num <br> <hr>";

  $r = mysqli_fetch_array($t, MYSQLI_ASSOC);
  $hash = $r["hash"];

  if ($num == 0) {
    echo "<br>UCID is not valid.";
    return false;
  }

  if (!password_verify($pwd, $hash)) {
    echo "Invalid password.";
    return false;
  }

  return true;

}

  ?>
