<?php

define('ENCRYPTION_PASSWORD', 'RETRACTED');
define('ENCRYPTION_TYPE', 'blowfish');

if(!isset($_COOKIE['userid']))
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $string = '';
    for ($i = 0; $i < 30; $i++) {
         $string .= $characters[rand(0, strlen($characters) - 1)];
    }
    setcookie("userid", openssl_encrypt($string, ENCRYPTION_TYPE, ENCRYPTION_PASSWORD), time()+60*60*24*360, "/");
}
else
    session_id(openssl_decrypt($_COOKIE['userid'], ENCRYPTION_TYPE, ENCRYPTION_PASSWORD));

session_start();

$defaultimageurl = 'https://pbs.twimg.com/profile_images/600060188872155136/st4Sp6Aw.jpg';

$moderators = ['RETRACTED', 'RETRACTED'];
?>