<?php

namespace dummy\repositaries;

class  projectRepositaries
{
  private $conn;
  public function __construct($conn)
  {
    $this->conn = $conn;
  }

  public function insertProjectData(
    string $project_name,
    string $project_number,
    string $address,
    string $start_date,
    string $end_date,
    string  $image,
    string $userId
  ) {
    $stmt = $this->conn->prepare("INSERT INTO `projects`(`project_name`, `project_number`,`address`,
     `start_date`, `end_date`,`image`,`userId`) VALUES (:project_name,
      :project_number,:address, :start_date, :end_date, :image,:userId)");
    $stmt->bindParam(':project_name', $project_name);
    $stmt->bindParam(':project_number', $project_number);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
  }

  public function readProjectData(): array
  {
    $stmt = $this->conn->prepare("SELECT * FROM projects");
    $stmt->execute();
    $showWHoleProjectData = $stmt->fetchAll();
    return $showWHoleProjectData;
  }

  public function updateProjectData(
    $id,
    string $project_name,
    string $project_number,
    string $address,
    string $start_date,
    string $end_date
  ) {
    $stmt = $this->conn->prepare("UPDATE projects SET project_name = :project_name,
     project_number = :project_number,address = :address, 
     start_date = :start_date , end_date =:end_date WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':project_name', $project_name);
    $stmt->bindParam(':project_number', $project_number);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':start_date', $start_date);
    $stmt->bindParam(':end_date', $end_date);
    $result = $stmt->execute();
    return $result;
  }

  public function allProjectsName()
  {
    $stmt = $this->conn->prepare("SELECT id ,`project_name` FROM projects");
    $stmt->execute();
    $projectName = $stmt->fetchAll();
    return $projectName;
  }

  public function projectByUser(string $userId)
  {
    $stmt = $this->conn->prepare("SELECT * FROM projects where userId = :userId");
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    $viewProjectByUsers = $stmt->fetchAll();
    return  $viewProjectByUsers;
  }

  public function getProjectId($id): array
  {
    $stmt =  $this->conn->prepare("SELECT * FROM projects where id=:id ");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $projectId = $stmt->fetchAll();
    return $projectId;
  }

  public function getNameByEmail(string $email): array
  {
    $stmt = $this->conn->prepare("SELECT first_name, user_type FROM user WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $resultAsNameUserType = $stmt->fetch();
    return $resultAsNameUserType;
  }
}
