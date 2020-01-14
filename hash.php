<?php

// hashing


$plaintext = $_GET["plaintext"];
echo "<br>pass is: $pass <br>";

$hash = password_hash( $plaintext, PASSWORD_DEFAULT);
echo "<br>hash is: $hash<br>";




?>
