<?php

require "database.php";
require "class.unifi.php";


session_start();
unset($_SESSION['message']);

if(isset($_GET['logout'])){
    session_unset();
}

// admin is logged in
if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) {
    // establish controller API connection
    $ubnController=new unifiapi;
    $ubnController->user=$GLOBALS['unifiUser'];
    $ubnController->password=$GLOBALS['unifiPass'];
    $ubnController->baseurl=$GLOBALS['unifiServer'];
    $ubnController->site=$GLOBALS['unifiSite'];
    
    $ubnController->login();

    if(isset($_GET["unauthorize_guest"])) {
        $ubnController->unauthorize_guest($_GET["unauthorize_guest"]);
    }

    if(isset($_GET["delete"])) {
        deleteUser($_GET["delete"]);
    }
    if(isset($_POST["user"])){
        if(isset($_POST["pass"])){
            $user=$_POST["user"];
            $pass=$_POST["pass"];
    
            createUser($user, $pass);
        }
    }
    require("./html/admin.html");
} 
else {
    // admin wants to log in. check credentials 
    if(isset($_GET["login"])){
        if($_POST["user"] == $GLOBALS['adminUser'] && $_POST["pass"] == $GLOBALS['adminPass']){
            $_SESSION['isAdmin'] = 1;
            $ubnController=new unifiapi;
            $ubnController->user=$GLOBALS['unifiUser'];
            $ubnController->password=$GLOBALS['unifiPass'];
            $ubnController->baseurl=$GLOBALS['unifiServer'];
            $ubnController->site=$GLOBALS['unifiSite'];
            
            $ubnController->login();
            require("./html/admin.html");
        } else {
            $_SESSION["message"] = "Wrong User or Password";
            require("./html/login_admin.html");
        }
    } else {
        require("./html/login_admin.html");
    }
}




?>