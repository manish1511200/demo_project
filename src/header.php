<?php
require '../vendor/autoload.php';

use dummy\services\Connection;
use dummy\services\userServices;
use dummy\repositaries\userRepositaries;

$obj = new Connection;
$conn = $obj->getConnection();
$userRepositaryObj = new userRepositaries($conn);
$userServicesObj =new userServices($userRepositaryObj);

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $resultAsNameUserType = $userServicesObj->getNameByEmail($email);
    $user_type = $resultAsNameUserType['user_type'];
}

$loader = new \Twig\Loader\FilesystemLoader('./templates');
$twig = new \Twig\Environment($loader);
echo $twig->render('header.html.twig',['user_type'=>$user_type]);


