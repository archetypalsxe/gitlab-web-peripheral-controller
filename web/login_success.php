<?php

require_once( __DIR__ . '/../vendor/autoload.php');
$userController = new \Controller\User();
$userController->handleUserLoginPost($_POST);

?>

