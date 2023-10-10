<?php

session_start();
require '../vendor/autoload.php';
include "header.php";

use dummy\services\Connection;
use dummy\services\userServices;
use dummy\repositaries\userRepositaries;

$obj = new Connection;
$conn = $obj->getConnection();
$userRepositaryObj = new userRepositaries($conn);
$userServicesObj =new userServices($userRepositaryObj);

$projectNames=$userServicesObj->numOfProjects();
$userCounts = $userServicesObj-> countUsersPerProject();
$drawingCounts = $userServicesObj->getAllDrawingIdsWithProjectId();

$loader = new \Twig\Loader\FilesystemLoader('./templates');
$twig = new \Twig\Environment($loader);
echo $twig->render('overview.html.twig',['projectNames' => $projectNames,
'userCounts' => $userCounts,
'drawingCounts' => $drawingCounts
]);
