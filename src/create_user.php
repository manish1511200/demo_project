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

if (isset($_POST['submit'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $date_of_birth = $_POST['date_of_birth'];
    $user_type = $_POST['user_type'];
    $image_Path = $_FILES['uploadfile'];
    $filename = $_FILES['uploadfile']['name'];
    $tempname = $_FILES['uploadfile']['tmp_name'];
    $folder = "../upload/photo/" . $filename;
    move_uploaded_file($tempname, $folder);
    $encpassword = md5($password);
    $userServicesObj->insertUserData($first_name, $last_name, $email, $encpassword, $address,
    $date_of_birth, $user_type, $filename,$_SESSION['id']);
    header("location:usermangement.php");
    $showWHoleData = $userServicesObj->readWholeUsersData(); 
}

$showWHoleUserType = $userServicesObj->viewUserType();
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render('create_user.html.twig',['showWHoleUserType' => $showWHoleUserType]);
?>
