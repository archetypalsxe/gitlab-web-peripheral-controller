<?php

require_once( __DIR__ . '/../vendor/autoload.php');

if(!empty($_POST['code'])) {
    $accountKit = new \AccountKit\Controller();
    $user = $accountKit->getUserInformation($_POST['code']);
}

$databaseConnection = new \Database\Connection();

if(empty($user)) {
    die;
}

?>


<head>
  <title>Account Kit PHP App</title>
</head>
<body>
  <div>User ID: <?php echo $user->getUserId(); ?></div>
  <div>Phone Number: <?php echo $user->getPhoneNumber(); ?></div>
  <div>Email: <?php echo $user->getEmail(); ?></div>
  <div>Access Token: <?php echo $user->getAccessToken(); ?></div>
  <div>Refresh Interval: <?php echo $user->getRefreshInterval(); ?></div>
</body>
