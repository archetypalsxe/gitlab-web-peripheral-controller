<?php

if(stripos($_SERVER['HTTP_HOST'], "localhost") !== FALSE || DEVELOP) {
    ini_set('display_errors', 1);
}

define("BASE_DIR", getcwd()."/../");
define("DATABASE_LOCATION", "default.db");

session_start();
if(strpos($_SERVER['PHP_SELF'], "login.php") !== FALSE) {
    unset($_SESSION['userId']);
    unset($_SESSION['accessToken']);
}
if(!empty($_SESSION['userId']) || !empty($_SESSION['accessToken'])) {
    $userController = new \Controller\User();
    $userController->validateAccessToken();
}
