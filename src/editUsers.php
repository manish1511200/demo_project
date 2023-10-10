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
$userServicesObj = new userServices($userRepositaryObj);

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $userId = $userServicesObj->getUserId($id);

}

if (isset($_POST['update'])) {
    $userId = $userServicesObj->getUserId($id);
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = !empty($_POST['email'])?$_POST['email']:$userId[0]['email'];
    $address = $_POST['address'];
    $date_of_birth = $_POST['date_of_birth'];
    $user_type = $_POST['user_type'];
    $userServicesObj->updateUserData($id, $first_name, $last_name, $email, $address, $date_of_birth, $user_type);
    header("location:userMangement.php");
}
if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $resultAsNameUserType = $userServicesObj->getNameByEmail($email);
    $first_name = $resultAsNameUserType['first_name'];
    $user_type = $resultAsNameUserType['user_type'];
    $user_id=$resultAsNameUserType['id'];
    $email=$resultAsNameUserType['email'];

}

$showWHoleUserType = $userServicesObj->viewUserType();
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render('editUserData.html.twig', ['value' => $userId, 
'showWHoleUserType' => $showWHoleUserType, 'first_name' => $first_name,'user_id'=>$user_id,'email'=>$email]);
