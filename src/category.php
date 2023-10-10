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

if (isset($_POST['submit'])) {
    $category_name = $_POST['category_name'];
    $drawingServices->createCategory($category_name);
   
}

$showCategory = $drawingServices->viewCategory();
    

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render('category.html.twig',['showCategory' =>$showCategory]);
?>
