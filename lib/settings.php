<?php

if(stripos($_SERVER['HTTP_HOST'], "localhost") !== FALSE || DEVELOP) {
    ini_set('display_errors', 1);
}

// @TODO Have this be overriden automatically
const BASE_DIR = "/var/www/html/";
const DATABASE_LOCATION = 'default.db';
