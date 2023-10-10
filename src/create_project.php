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


$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

if (isset($_POST['submit'])){
  $project_name = $_POST['project_name'];
  $project_number = $_POST['project_number'];
  $address = $_POST['address'];
  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  $image = $_FILES['uploadfile'];
  $filename = $_FILES['uploadfile']['name'];
  $tempname = $_FILES['uploadfile']['tmp_name'];
  $folder = "../upload/photo/" . $filename;
  move_uploaded_file($tempname, $folder);
  $projectServices->insertProjectData($project_name, $project_number, $address, $start_date, $end_date, $filename,$_SESSION['id']);

  header("location:projectmangement.php");
}
echo $twig->render('create_project.html.twig');
