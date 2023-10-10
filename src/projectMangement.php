<?php
session_start();
require '../vendor/autoload.php';
include "header.php";

use dummy\services\Connection;
use dummy\services\ProjectServices;
use dummy\repositaries\projectRepositaries;

$obj = new Connection;
$conn = $obj->getConnection();
$projectRepositaryObj = new projectRepositaries($conn);
$projectServices = new ProjectServices($projectRepositaryObj);

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $resultAsNameUserType = $projectServices->getNameByEmail($email);
    $first_name = $resultAsNameUserType['first_name'];
    $user_type = $resultAsNameUserType['user_type'];
}

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
}

if ($user_type == 'Admin') {
    $showWHoleProjectData = $projectServices->readProjectData();
} else {
    $showWHoleProjectData = $projectServices->projectByUser($user_id);
}


$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render('projectMangement.html.twig', ['value' => $showWHoleProjectData, 
'first_name' => $first_name, 'user_type' => $user_type]);
