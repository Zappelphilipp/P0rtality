<?php

require "database.php";

session_start();
unset($_SESSION['message']);

if(isset($_POST["user"])){
    if(isset($_POST["pass"])){
        
        $user=filter_var($_POST["user"], FILTER_SANITIZE_STRING);
        $pass=filter_var($_POST["pass"], FILTER_SANITIZE_STRING);

        createUser($user, $pass);

        require("./html/userCreationSuccess.html");
    }
}
else{
    require("./html/createUser.html");
}

?>