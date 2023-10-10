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
    $categoryId = $drawingServices->getCategoryId($id);
}

if (isset($_POST['update'])) {
    $category_name = $_POST['category_name'];
    $updateCategory = $drawingServices->updateCategoryData($id, $category_name);
    header("location: category.php");
    
}

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
echo $twig->render('editCategory.html.twig', ['value' => $categoryId]);
?>
