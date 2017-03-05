<?php
require_once( __DIR__ . '/../vendor/autoload.php');
$userController = new \Controller\User();
/**
 * @TODO This probably shouldn't be done here....
 */
if(!$userController->canUserScan()) {
    header('Location:login.php');
}
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
</head>

<input id = "scanButton" type="submit" value="Scan"/>
