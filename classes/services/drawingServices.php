<?php

namespace dummy\services;


use dummy\repositaries\drawingRepositaries as DrawingRepository;

class DrawingServices
{
    private $repositary;

    public function __construct($drawingRepositaryObj)
    {
        $this->repositary = $drawingRepositaryObj;
    }


    public function insertDrawingData(
        string $project_id,
        string   $drawing_number,
        string $drawing_name,
        string $drawing_status,
        string  $pdf_file,
        string $category,
        string $userId
    ) {
        $this->repositary->insertDrawingData(
            $project_id,
            $drawing_number,
            $drawing_name,
            $drawing_status,
            $pdf_file,
            $category,
            $userId
        );
    }

    public function readDrawingData()
    {
        return $this->repositary->readDrawingData();
    }
    public function updateDrawingData(
        $id,
        string $drawing_number,
        string $drawing_name,
        string  $drawing_status,
        string $category
    ) {
        return $this->repositary->updateDrawingData(
            $id,
            $drawing_number,
            $drawing_name,
            $drawing_status,
            $category
        );
    }

    public function getDrawingId($id)
    {
        return $this->repositary->getDrawingId($id);
    }


    public function getNameByEmail(string $email)
    {
        return $this->repositary->getNameByEmail($email);
    }

    public function allProjectsName()
    {
        return $this->repositary->allProjectsName();
    }

    public function showProjectByUsersAssign($user_id)
    {
        return $this->repositary->showProjectByUsersAssign($user_id);
    }

    public function createCategory($category_name)
    {
        $this->repositary->createCategory($category_name);
    }

    public function createSubCategory($cId, $parentId)
    {
        $this->repositary->createSubCategory($cId, $parentId);
    }

    public function viewCategory()
    {
        return $this->repositary->viewCategory();
    }

    public function drawingByProject($project_id)
    {
        return $this->repositary->drawingByProject($project_id);
    }

    public function updateCategoryData($id, string $category_name)
    {
        return $this->repositary->updateCategoryData($id, $category_name);
    }

    public function getCategoryId($id)
    {
        return $this->repositary->getCategoryId($id);
    }

    public function viewSubCategory($parentId)
    {
        return $this->repositary->viewSubCategory($parentId);
    }

    public function viewCategory4()
    {
        return $this->repositary->viewCategory4();
    }
    public function getSubcategories($parentId)
    {
        return $this->repositary->getSubcategories($parentId);
    }
}
