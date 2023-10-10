<?php

session_start();
require '../vendor/autoload.php';
include("header.php");

use dummy\services\Connection;
use dummy\services\userServices;
use dummy\repositaries\userRepositaries;

$obj = new Connection;
$conn = $obj->getConnection();
$userRepositaryObj = new userRepositaries($conn);
$userServicesObj =new userServices($userRepositaryObj);

$showWHoleUserType = $userServicesObj->viewUserType();
$projectName = $userServicesObj->allProjectsName();

if (isset($_SESSION['email'])){
    $email = $_SESSION['email'];
    $resultAsNameUserType = $userServicesObj->getNameByEmail($email);
    $first_name = $resultAsNameUserType['first_name'];
    $user_type = $resultAsNameUserType['user_type'];
}

if($user_type=="Admin"){
    $showWHoleData = $userServicesObj->readWholeUsersData();
} else{
    $showWHoleData=$userServicesObj->readUserTypeData($user_type);
}

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render('userMangement.html.twig', ['value' => $showWHoleData, 'project' => $projectName, 
'first_name' => $first_name, 'user_type' => $user_type]);
