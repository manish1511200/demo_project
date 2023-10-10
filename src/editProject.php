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

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $projectId = $projectServices->getProjectId($id);
  
}

if (isset($_POST['update'])) {
  $project_name = $_POST['project_name'];
  $project_number = $_POST['project_number'];
  $address = $_POST['address'];
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  $projectServices->updateProjectData($id, $project_name, $project_number, $address, $start_date, $end_date);
  
  header("location:projectMangement.php");
}

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render('editProjectData.html.twig', ['value' => $projectId]);
