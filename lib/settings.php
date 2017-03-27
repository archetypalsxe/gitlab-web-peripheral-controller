<?php

if(
    stripos($_SERVER['HTTP_HOST'], "localhost") !== FALSE ||
    stripos($_SERVER['HTTP_HOST'], "whoa") !== FALSE ||
    DEVELOP
) {
    ini_set('display_errors', 1);
    define("SHOW_DEBUG", 1);
} else {
    define("SHOW_DEBUG", 0);
}

define("BASE_DIR", getcwd()."/../");
define("DATABASE_LOCATION", "default.db");

session_start();
if(strpos($_SERVER['PHP_SELF'], "login") !== FALSE) {
    unset($_SESSION['userId']);
    unset($_SESSION['facebookId']);
    unset($_SESSION['accessToken']);
} else {
    if(
		empty($_SESSION['facebookId']) ||
		empty($_SESSION['accessToken'])
    ) {
        header('Location:login.php');
    } else {
        try {
            $userController = new \Controller\User();
            $user = $userController->validateAccessToken();
        } catch (\Exception $e) {
            header('Location:login.php');
        }
    }
}
