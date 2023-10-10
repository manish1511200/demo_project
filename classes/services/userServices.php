<?php

namespace dummy\services;

use dummy\services\Connection;
use dummy\repositaries\userRepositaries;

class userServices
{
  private $repositary;
  public function __construct($userRepositaryObj)
  {
    $this->repositary = $userRepositaryObj;
  }
  public function insertUserData(
    string $first_name,
    string $last_name,
    string $email,
    string $encpassword,
    string $address,
    string $date_of_birth,
    string $user_type,
    string $image_Path
  ) {
    return  $this->repositary->insertUserData(
      $first_name,
      $last_name,
      $email,
      $encpassword,
      $address,
      $date_of_birth,
      $user_type,
      $image_Path
    );
  }

  public function checkEmailExists(string $email)
  {
    return  $this->repositary->checkEmailExists($email);
  }

  public function readWholeUsersData()
  {
    return  $this->repositary->readWholeUsersData();
  }

  public function readUserTypeData($user_type)
  {
    return $this->repositary->readUserTypeData($user_type);
  }

  public function viewUserType()
  {
    return $this->repositary->viewUserType();
  }

  public function signIn(string $email, string $encpassword)
  {
    return $this->repositary->signIn($email, $encpassword);
  }


  public function updateUserData(
    $id,
    string $first_name,
    string $last_name,
    string $email,
    string $address,
    string $date_of_birth,
    string $user_type
  ) {
    $this->repositary->updateUserData(
      $id,
      $first_name,
      $last_name,
      $email,
      $address,
      $date_of_birth,
      $user_type
    );
  }

  public function getUserId(int $id)
  {
    return $this->repositary->getUserId($id);
  }

  public function deleteUserData(int $id)
  {
    return $this->repositary->deleteUserData($id);
  }

  public function deleteProjectData(string $id)
  {
    return $this->repositary->deleteProjectData($id);
  }

  public function allProjectsName()
  {
    return $this->repositary->allProjectsName();
  }

  public function deleteDrawingData(int $id)
  {
    return $this->repositary->deleteDrawingData($id);
  }
  public function deleteCategoryData(string $id)
  {
    return $this->repositary->deleteCategoryData($id);
  }

  public function getNameByEmail(string $email)
  {
    return $this->repositary->getNameByEmail($email);
  }

  public function getUserIdByEmail(string $email)
  {
    return $this->repositary->getUserIdByEmail($email);
  }

  public function assignProjectToUser($user_id, $checkboxes)
  {
    $this->repositary->assignProjectToUser($user_id, $checkboxes);
  }

  public function getAllAssignProjects($user_id)
  {
    return $this->repositary->getAllAssignProjects($user_id);
  }

  public function deleteAssignedProject(int $user_id)
  {
    return $this->repositary->deleteAssignedProject($user_id);
  }

  public function numOfProjects()
  {
    return $this->repositary->numOfProjects();
  }

  public function countUsersPerProject()
  {
    return $this->repositary->countUsersPerProject();
  }

  public function getAllDrawingIdsWithProjectId()
  {
    return $this->repositary->getAllDrawingIdsWithProjectId();
  }
}
