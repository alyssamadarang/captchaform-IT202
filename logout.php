<?php
session_start();
include  ("config.php");
session_set_cookie_params(0, $path, "web.njit.edu");


error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
ini_set('display_errors', 1);

$sidvalue = session_id();

echo "<br>session id was: " . $sidvalue . "<br>";

// erase session contents
$_SESSION = array();
// OS removes session
session_destroy();

// session cookie
setcookie("PHPSESSID", "", time()-3600, $path, "", 0, 0);
echo "You have been logged out.";

header ("refresh: 3; url = login.html");
exit();
?>
