<?php
session_start();
require 'vendor/autoload.php';

use dummy\services\Connection;
use dummy\services\userServices;
use dummy\repositaries\userRepositaries;

$obj = new Connection;
$conn = $obj->getConnection();
$userRepositaryObj = new userRepositaries($conn);
$userServicesObj =new userServices($userRepositaryObj);


if (isset($_SESSION['email'])) {
    header("location:src/overview.php");
}

if (isset($_POST['login'])){
    $email = $_POST['email']; 
    $password = $_POST['password'];
    $encpassword = md5($password);
    $login=$userServicesObj->signIn($email,$encpassword);

    if ($login ){
      $_SESSION['email'] = $email;
      $_SESSION['password'] = $password;
      $resultAsUserId=$userServicesObj->getUserIdByEmail($email);
      $userId=$resultAsUserId['id'];
      $_SESSION['id']= $userId;
      header("location:src/overview.php");
    } else{
      echo "<div style='color:red'>Invalid email or password</div>";
    }
}

$loader = new \Twig\Loader\FilesystemLoader('./src/templates');
$twig = new \Twig\Environment($loader);
echo $twig->render('index.html.twig');

