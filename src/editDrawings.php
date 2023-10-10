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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $drawingId = $drawingServices->getDrawingId($id);
}

if (isset($_POST['update'])) {
    $drawing_number = $_POST['drawing_number'];
    $drawing_name = $_POST['drawing_name'];
    $drawing_status = $_POST['drawing_status'];
    $category_name = $_POST['category_name'];
    $updateDrawing = $drawingServices->updateDrawingData( $id,$drawing_number,$drawing_name, 
    $drawing_status, $category_name);
    
    header("location:drawing.php");
}
$showCategory = $drawingServices->viewCategory4();
$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render('edit_drawing.html.twig', ['value' => $drawingId, 'showCategory' => $showCategory]);
