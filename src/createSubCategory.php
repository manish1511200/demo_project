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
    $cId = $_GET['id'];
    $categoryId = $drawingServices->getCategoryId($cId);

}

if (isset($_POST['submit'])) {
    $subCategory = $_POST['subCategory'];
    $drawingServices->createSubCategory($cId, $subCategory);
    header("location:category.php");
}

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render('createSubCategory.html.twig',['cId'=>$cId]);
?>
