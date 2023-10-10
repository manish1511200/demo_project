<?php

require '../vendor/autoload.php';

use dummy\services\Connection;
use dummy\services\userServices;
use dummy\repositaries\userRepositaries;

$obj = new Connection;
$conn = $obj->getConnection();
$userRepositaryObj = new userRepositaries($conn);
$userServicesObj =new userServices($userRepositaryObj);


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $userServicesObj->deleteUserData($id);
    $result = $userServicesObj->deleteProjectData($id);
    $result = $userServicesObj->deleteDrawingData($id);
    $result=$userServicesObj->deleteCategoryData($id);

    if ($result) {
        echo '1';
    } else {
        echo '0';
    }
}
