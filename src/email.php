<?php

require '../vendor/autoload.php';

use dummy\services\Connection;
use dummy\services\userServices;
use dummy\repositaries\userRepositaries;

$obj = new Connection;
$conn = $obj->getConnection();
$userRepositaryObj = new userRepositaries($conn);
$userServicesObj = new userServices($userRepositaryObj);

if (isset($_POST['email'])) {
  $email = $_POST['email'];
  $rowCount = $userServicesObj->checkEmailExists($email);

  if ($rowCount == 1) {
    echo " This Email already exists";
  } else {
    echo "New data is insert";
  }
}
