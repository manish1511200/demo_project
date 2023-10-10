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

if ($_GET['id']) {
    $CategoryId = $_GET['id'];
}

$showCategory = $drawingServices->viewSubCategory($CategoryId);

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render('viewSubCategory.html.twig',['showCategory'=>$showCategory]);
?>
 