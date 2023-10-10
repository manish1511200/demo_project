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


if (isset($_POST['submit'])){
  $project_id = $_POST['project_id'];
  $drawing_number = $_POST['drawing_number'];
  $drawing_name = $_POST['drawing_name'];
  $drawing_status = $_POST['drawing_status'];
  $category_name = $_POST['category_name'];
  $filename = $_FILES['pdffile']['name'];
  $file_temp = $_FILES["pdffile"]["tmp_name"];
  $folder = "../upload/document/" .$filename;
 
    move_uploaded_file($file_temp, $folder);
    $showWHoleDrawingData = $drawingServices->insertDrawingData($project_id, $drawing_number, $drawing_name,
     $drawing_status, $filename, $category_name,$_SESSION['id']);
    header("location:drawing.php");
   
  }
$showCategory = $drawingServices->viewCategory4();
$projectName = $drawingServices->allProjectsName();

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render('create_drawing.html.twig', ['project'=>$projectName, 'showCategory' => $showCategory]);