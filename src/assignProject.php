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

if (isset($_POST['save'])) {
    if (isset($_POST['checkbox'])) {
        $checkboxes = $_POST['checkbox'];
    $userId = $_POST['user_id'];
    $userServicesObj->deleteAssignedProject($userId);
    $userServicesObj->assignProjectToUser($userId, $checkboxes );
    header("location:usermangement.php");
}
}
$assignedProjectIds = [];
if (isset($_GET['id'])) {
    $userId = $_GET['id'];
    $userAssignedProjects = $userServicesObj->getAllAssignProjects($userId);

    foreach ($userAssignedProjects as $assignedProject) {
         $assignedProjectIds[] = $assignedProject['project_id'];
    }
    $assignedProjectIds = array_map('strval', $assignedProjectIds);
    $assignedProjectIds = "array('" . implode("','", $assignedProjectIds) . "')";
}
$userId = $_GET['id'];
$showWHoleData = $userServicesObj->readWholeUsersData();
$projectName = $userServicesObj->allProjectsName();

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render('assignProject.html.twig',['value' => $showWHoleData,'project' => $projectName,'userId' => $userId,'assign' => $assignedProjectIds]);
?>
 