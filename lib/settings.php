<?php

if(stripos($_SERVER['HTTP_HOST'], "localhost") !== FALSE || DEVELOP) {
    ini_set('display_errors', 1);
}
