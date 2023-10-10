<?php
session_start();
require '../vendor/autoload.php';
include("header.php");

use dummy\services\Connection;
use dummy\services\DrawingServices;
use dummy\repositaries\drawingRepositaries;

$obj = new Connection;
$conn = $obj->getConnection();
$drawingRepositaryObj = new drawingRepositaries($conn);
$drawingServices = new DrawingServices($drawingRepositaryObj);

if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
}

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $resultAsNameUserType = $drawingServices->getNameByEmail($email);
    $first_name = $resultAsNameUserType['first_name'];
    $user_type = $resultAsNameUserType['user_type'];
}

if ($user_type == 'Admin') {
    $viewAssignPbyUsers = $drawingServices->allProjectsName();
    $viewDrawingByProjectName = $drawingServices->drawingByProject($viewAssignPbyUsers[0]['id']);
} else {
    $viewAssignPbyUsers = $drawingServices->showProjectByUsersAssign($user_id);
    $viewDrawingByProjectName = $drawingServices->drawingByProject($viewAssignPbyUsers[0]['id']);
}

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render('drawing.html.twig', [
    'value' => $viewDrawingByProjectName, 'first_name' => $first_name,
    'user_type' => $user_type, 'project' => $viewAssignPbyUsers,
]);
?>
