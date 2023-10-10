<?php
session_start();
require '../vendor/autoload.php';
include("header.php");

use dummy\services\Connection;
use dummy\services\DrawingServices;
use dummy\repositaries\drawingRepositaries;

$obj = new Connection;
$conn = $obj->getConnection();
$drawingRepositoryObj = new drawingRepositaries($conn);
$drawingServices = new DrawingServices($drawingRepositoryObj);

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $resultAsNameUserType = $drawingServices->getNameByEmail($email);
    $user_type = $resultAsNameUserType['user_type'];
}
if (isset($_POST['project_id'])) {
    $project_id = $_POST['project_id'];
    $_SESSION['project_id'] = $project_id;
   
}

$viewDrawingByProjects = $drawingServices->drawingByProject($project_id);
$projectName = $drawingServices->allProjectsName();
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render(
    'drawingPageWithAjax.html.twig',
    ['value' => $viewDrawingByProjects, 'project' => $projectName, 'user_type' => $user_type]
);
