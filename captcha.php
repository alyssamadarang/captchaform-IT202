<?php
session_start();
include ("config.php");
session_set_cookie_params(0, $path, "web.njit.edu");

header("Content-type: image/png");

// creating captcha/php graphics

$img = imagecreatetruecolor(250, 100); // 250 by 100 rectangle canvas
$font1 = "LaBelleAurore.ttf";
$font2 = "OpenSans-Regular.ttf";

// colors
$black = imagecolorallocate($img, 0, 0, 0);
$yellow = imagecolorallocate($img, 255, 255, 0);
$red = imagecolorallocate($img, 255, 0, 0);
$blue = imagecolorallocate($img, 0, 0, 255);
$royalblue = imagecolorallocate($img, 65, 105, 225);
$green = imagecolorallocate($img, 0, 128, 0);

// set background colors
imagefill($img, 0, 0, $blue);
imagefilledrectangle($img, 10, 5, 240, 95, $yellow);


//$text = mt_rand(10000, 999999);

$length = 2;

// create 2 substrings
$text1 = substr(str_shuffle(md5(time())), 0, $length);
$text2 = substr(str_shuffle(md5(time())), 0, $length);

$fulltext = $text1 . $text2;
$sidvalue = session_id();
$sessionid = "session id: " . $sidvalue;

$_SESSION["captcha"] = $fulltext;

// substrings
imagettftext($img, 30, 35, 70, 52, $red, $font1, $text1);
imagettftext($img, 30, -15, 125, 50, $green, $font1, $text2);

// concatenated captcha text
imagettftext($img, 15, 0, 12, 82, $blue, $font2, $fulltext);
//session id text
imagettftext($img, 8.5, 0, 12, 92, $blue, $font2, $sessionid);

// random lines
for($i=0;$i<4;$i++) {
    imageline($img,rand(10,30),rand(5,80),rand(220,240),rand(5,80),$royalblue);
}

imagepng($img);

?>
