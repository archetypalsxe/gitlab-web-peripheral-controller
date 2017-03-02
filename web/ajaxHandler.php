<?php

require_once( __DIR__ . '/../vendor/autoload.php');

$return = new \stdClass();
$return->success = 1;

try {

    if(empty($_POST['handler'])) {
        throw new \Exception("No handler provided");
    }

    switch($_POST['handler']) {
        case 'saveName':
            $controller = new \Controller\User();
            $return->saveSuccessful = $controller->saveNewUser($_POST);
            break;
        default:
            throw new \Exception("Invalid handler provided");
            break;
    }
} catch (\Exception $e) {
    $return->success = 0;
    $return->error = $e->getMessage();

}

echo json_encode($return);
