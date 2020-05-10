<?php 
require "class.unifi.php";
require "./config/config.php";

session_start();
session_unset();

$_SESSION['id'] = $_GET['id'];          
$_SESSION['ap'] = $_GET['ap'];

require("./html/login.html");

?>