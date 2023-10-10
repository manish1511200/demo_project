<?php

namespace dummy\services;

use dummy\services\Connection;
use dummy\repositaries\projectServices as ProjectRepositary;

class ProjectServices
{
    private $repositary;

    public function __construct($projectRepositaryObj)
    {
        $this->repositary = $projectRepositaryObj;
    }

    public function insertProjectData(
        string $project_name,
        string $project_number,
        string $address,
        string $start_date,
        string $end_date,
        string $image,
        string $userId
    ) {
        $this->repositary->insertProjectData(
            $project_name,
            $project_number,
            $address,
            $start_date,
            $end_date,
            $image,
            $userId
        );
    }

    public function readProjectData()
    {
        return $this->repositary->readProjectData();
    }

    public function updateProjectData(
        $id,
        string $project_name,
        string $project_number,
        string $address,
        string $start_date,
        string $end_date
    ) {
        $this->repositary->updateProjectData(
            $id,
            $project_name,
            $project_number,
            $address,
            $start_date,
            $end_date
        );
    }

    public function allProjectsName()
    {
        return $this->repositary->allProjectsName();
    }

    public function getProjectId($id)
    {
        return $this->repositary->getProjectId($id);
    }

    public function projectByUser(string $userId)
    {
        return $this->repositary->projectByUser($userId);
    }

    public function getNameByEmail(string $email)
    {
        return $this->repositary->getNameByEmail($email);
    }
}
