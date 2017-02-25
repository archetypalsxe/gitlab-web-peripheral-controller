<?php

if(stripos($_SERVER['HTTP_HOST'], "localhost") !== FALSE || DEVELOP) {
    ini_set('display_errors', 1);
}

// @TODO Have this be overriden automatically
const BASE_DIR = "/srv/http/";
const DATABASE_LOCATION = 'default.db';

session_start();
if(!empty($_SESSION['userId']) || !empty($_SESSION['accessToken'])) {
    $userController = new \Controller\User();
    $userController->validateAccessToken();
}
