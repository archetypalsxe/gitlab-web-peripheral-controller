<?php
require_once( __DIR__ . '/../vendor/autoload.php');
?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>

<form id="newUserNameForm">
    <input type="text" placeholder="Please enter your name" maxlength=100 id="nameEnterField"/>
    <input type="submit" value="Submit"/>
</form>
