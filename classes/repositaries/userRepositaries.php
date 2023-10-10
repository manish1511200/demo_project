<?php

namespace dummy\repositaries;

class  userRepositaries
{
  private $conn;
  public function __construct($conn)
  {
    $this->conn = $conn;
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
  ): bool {
    $rowCount = $this->checkEmailExists($email);
    if ($rowCount == 0) {
      $stmt = $this->conn->prepare("INSERT INTO `user`(`first_name`, `last_name`,
       `email`, `password`, `address`, `date_of_birth`, `user_type`,`image_Path`) VALUES (:first_name, 
       :last_name, :email, :encpassword, :address, :date_of_birth, :user_type, :image_Path)");
      $stmt->bindParam(':first_name', $first_name);
      $stmt->bindParam(':last_name', $last_name);
      $stmt->bindParam(':email', $email);
      $stmt->bindParam(':encpassword', $encpassword);
      $stmt->bindParam(':address', $address);
      $stmt->bindParam(':date_of_birth', $date_of_birth);
      $stmt->bindParam(':user_type', $user_type);
      $stmt->bindParam(':image_Path', $image_Path);
      $stmt->execute();
      return true;
    }
    return false;
  }

  public function checkEmailExists(string $email): bool
  {
    $stmt = $this->conn->prepare("SELECT COUNT(*) FROM user  WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $rowCount = $stmt->fetchColumn();
    return $rowCount;
  }

  public function readWholeUsersData(): array
  {
    $stmt = $this->conn->prepare("SELECT * FROM user");
    $stmt->execute();
    $showWHoleData = $stmt->fetchAll();
    return $showWHoleData;
  }

  public function readUserTypeData($user_type)
  {
    $stmt = $this->conn->prepare("SELECT * FROM user WHERE user_type = :user_type");
    $stmt->bindParam(':user_type', $user_type,);
    $stmt->execute();
    $showUserTypeData = $stmt->fetchAll();
    return $showUserTypeData;
  }

  public function viewUserType(): array
  {
    $stmt = $this->conn->prepare("SELECT * FROM permission_type");
    $stmt->execute();
    $showWHoleUserType = $stmt->fetchAll();
    return $showWHoleUserType;
  }

  public function signIn(string $email, string $encpassword)
  {
    $stmt = $this->conn->prepare("SELECT email, password FROM user 
    WHERE email = :email AND password = :password");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $encpassword);
    $stmt->execute();
    $login = $stmt->fetch();
    return $login;
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

    $stmt = $this->conn->prepare("UPDATE user SET first_name = :first_name, 
    last_name = :last_name, email=:email, address = :address, date_of_birth = :date_of_birth ,user_type= :user_type WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':first_name', $first_name);
    $stmt->bindParam(':last_name', $last_name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':date_of_birth', $date_of_birth);
    $stmt->bindParam(':user_type', $user_type);
    $stmt->execute();
  }

  public function getUserId(string $id): array
  {
    $stmt =  $this->conn->prepare("SELECT * FROM user where id=:id ");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $userId = $stmt->fetchAll();
    return $userId;
  }

  public function deleteUserData(int $id): bool
  {
    $stmt = $this->conn->prepare("DELETE FROM user WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->execute();
    return $result;
  }

  public function deleteProjectData(string $id): bool
  {
    $stmt = $this->conn->prepare("DELETE FROM projects WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->execute();
    return $result;
  }

  public function deleteCategoryData(string $id): bool
  {
    $stmt = $this->conn->prepare("DELETE FROM category WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->execute();
    return $result;
  }

  public function deleteDrawingData(string $id): bool
  {
    $stmt = $this->conn->prepare("DELETE FROM drawings WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
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

  public function getNameByEmail(string $email)
  {
    $stmt = $this->conn->prepare("SELECT id,first_name,email, user_type FROM user WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $resultAsNameUserType = $stmt->fetch();
    return $resultAsNameUserType;
  }

  public function getUserIdByEmail(string $email)
  {
    $stmt = $this->conn->prepare("SELECT id FROM user WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $resultAsUserId = $stmt->fetch();
    return $resultAsUserId;
  }

  public function assignProjectToUser($user_id, $checkboxes)
  {

    $stmt = $this->conn->prepare("INSERT INTO `user_project`(`user_id`, `project_id`) VALUES (:user_id, :project_id)");
    $stmt->bindParam(':user_id', $user_id);
    foreach ($checkboxes as $project_id) {
      $stmt->bindParam(':project_id', $project_id);
      $stmt->execute();
    }
  }

  public function getAllAssignProjects(int $user_id)
  {
    $stmt = $this->conn->prepare("SELECT * FROM user_project WHERE user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $userAssignedProjects = $stmt->fetchAll();
    return $userAssignedProjects;
  }

  public function deleteAssignedProject(int $user_id): bool
  {
    $stmt = $this->conn->prepare("delete from user_project where user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    return true;
  }

  public function numOfProjects()
  {
    $stmt = $this->conn->prepare("SELECT `project_name` FROM projects");
    $stmt->execute();
    $projectNames = $stmt->fetchAll(\PDO::FETCH_COLUMN, 0);
    return $projectNames;
  }

  public function countUsersPerProject()
  {
    $stmt = $this->conn->prepare("SELECT project_id, COUNT( user_id) AS user_count FROM user_project GROUP BY project_id");
    $stmt->execute();
    $userCounts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $userCounts;
  }

  public function getAllDrawingIdsWithProjectId()
  {
    $stmt = $this->conn->prepare("SELECT project_id, COUNT(id) AS drawing_count FROM drawings GROUP BY project_id");
    $stmt->execute();
    $drawingCounts = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $drawingCounts;
  }
}
