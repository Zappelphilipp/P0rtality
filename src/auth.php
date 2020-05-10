<?php
require "class.unifi.php";
require "./config/config.php";
require "database.php";

session_start();

$user=$_POST['user'];
$pass=$_POST['pass'];

$download=NULL;
$upload=NULL;
$quota=NULL;
$id = $_SESSION['id'];
$ap = $_SESSION['ap'];

$ubnController=new unifiapi;
$ubnController->user=$GLOBALS['unifiUser'];
$ubnController->password=$GLOBALS['unifiPass'];
$ubnController->baseurl=$GLOBALS['unifiServer'];
$ubnController->site=$GLOBALS['unifiSite'];

unset($_SESSION['loginSuccess']);

if(authorizeUser($user, $pass)){
    $ubnController->login();

    if($ubnController->authorize_guest($id,$GLOBALS['authDuration'], $upload, $download, $quota, $ap)){
        $_SESSION['loginSuccess'] = true;
        logSession($user, $id, $ap);
        unset($_SESSION['message']);
    }
    else{
        $_SESSION['message'] = "Unable to contact Wifi Access Point Server. Please try again later or contact a system administrator.";
    }

    $ubnController->logout();
}
else{
    $_SESSION["message"] = "Username or Password incorrect.";   
}


if(isset($_SESSION['loginSuccess']) && $_SESSION['loginSuccess']){
    
    require("html/success.html");
}
else{
    require("html/login.html");
}

?>