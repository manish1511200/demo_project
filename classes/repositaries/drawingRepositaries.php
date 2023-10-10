<?php

namespace dummy\repositaries;

class drawingRepositaries
{
  private $conn;

  public function __construct($conn)
  {
    $this->conn = $conn;
  }

  public function insertDrawingData(
    string $project_id,
    string $drawing_number,
    string  $drawing_name,
    string $drawing_status,
    string $pdf_file,
    string $category,
    string $userId
  ) {
    $stmt = $this->conn->prepare("INSERT INTO `drawings`(`project_id`, `drawing_number`, 
   `drawing_name`, `drawing_status`, `pdf_file`, `category`,`userId`) 
    VALUES (:project_id,:drawing_number, :drawing_name, :drawing_status,:pdf_file,:category, :userId)");
    $stmt->bindParam(':project_id', $project_id);
    $stmt->bindParam(':drawing_number', $drawing_number);
    $stmt->bindParam(':drawing_name', $drawing_name);
    $stmt->bindParam(':drawing_status', $drawing_status);
    $stmt->bindParam(':pdf_file', $pdf_file);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
  }

  public function readDrawingData(): array
  {
    $stmt = $this->conn->prepare("SELECT D.*, 
    P.project_name FROM drawings D
    JOIN projects P ON D.project_id = P.id");
    $stmt->execute();
    $showWholeDrawingData = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $showWholeDrawingData;
  }

  public function updateDrawingData(
    $id,
    string $drawing_number,
    string $drawing_name,
    string  $drawing_status,
    string $category
  ): bool {
    $stmt = $this->conn->prepare("UPDATE drawings SET drawing_number= :drawing_number,drawing_name= :drawing_name,
      drawing_status=:drawing_status,category= :category WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':drawing_number', $drawing_number);
    $stmt->bindParam(':drawing_name', $drawing_name);
    $stmt->bindParam(':drawing_status', $drawing_status);
    $stmt->bindParam(':category', $category);
    $updateDrawing = $stmt->execute();
    return $updateDrawing;
  }

  public function getDrawingId($id): array
  {
    $stmt =  $this->conn->prepare("SELECT * FROM drawings where id=:id ");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $drawingId = $stmt->fetchAll();
    return $drawingId;
  }

  public function getNameByEmail(string $email): array
  {
    $stmt = $this->conn->prepare("SELECT first_name, user_type FROM user WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $resultAsNameUserType = $stmt->fetch();
    return $resultAsNameUserType;
  }

  public function allProjectsName()
  {
    $stmt = $this->conn->prepare("SELECT id ,`project_name` FROM projects");
    $stmt->execute();
    $projectName = $stmt->fetchAll();
    return $projectName;
  }

  public function showProjectByUsersAssign($user_id)
  {
    $stmt = $this->conn->prepare("SELECT P.id, UP.user_id, UP.project_id, P.project_name
    FROM `user_project` UP
    JOIN `projects` P ON UP.project_id = P.id
    WHERE UP.user_id = :user_id");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    $viewAssignPbyUsers = $stmt->fetchAll();
    return  $viewAssignPbyUsers;
  }

  public function createCategory($category_name)
  {
    $stmt = $this->conn->prepare("INSERT INTO `category`(`category_name`) VALUES (:category_name)");
    $stmt->bindParam(':category_name', $category_name);
    $stmt->execute();
  }

  public function createSubCategory($cId, $parentId)
  {
    $stmt = $this->conn->prepare("INSERT INTO `category`(`parentId`,`category_name`) VALUES ( :cId ,:parentId)");
    $stmt->bindParam(':cId', $cId);
    $stmt->bindParam(':parentId', $parentId);
    $stmt->execute();
  }

  public function viewCategory()
  {
    $stmt = $this->conn->prepare("SELECT * FROM `category` where parentId = 0");
    $stmt->execute();
    $showCategory = $stmt->fetchAll();
    return $showCategory;
  }

  public function drawingByProject($project_id)
  {
    $stmt = $this->conn->prepare("SELECT D.id, D.project_id, D.drawing_number,
      D.drawing_name, D.drawing_status, D.category, P.project_name
      FROM drawings D
      JOIN projects P ON D.project_id = P.id
      WHERE D.project_id = :project_id");
    $stmt->bindParam(':project_id', $project_id);
    $stmt->execute();
    $viewDrawingByProjects = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $viewDrawingByProjects;
  }

  public function getCategoryId($id): array
  {
    $stmt =  $this->conn->prepare("SELECT * FROM category where id=:id ");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $categoryId = $stmt->fetchAll();
    return $categoryId;
  }

  public function updateCategoryData($id, string $category_name)
  {
    $stmt = $this->conn->prepare("UPDATE category SET category_name= :category_name WHERE id =:id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':category_name', $category_name);
    $updateCategory = $stmt->execute();
    return $updateCategory;
  }

  public function viewSubCategory($parentId)
  {
    $stmt = $this->conn->prepare("SELECT * FROM `category` WHERE parentId = :parentId ");
    $stmt->bindParam(':parentId', $parentId);
    $stmt->execute();
    $showCategory = $stmt->fetchAll();
    return $showCategory;
  }

  public function viewCategory4()
  {
    $stmt = $this->conn->prepare("SELECT * FROM `category` WHERE parentId =0");
    $stmt->execute();
    $categories = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    foreach ($categories as &$category) {
      $category['subcategories'] = $this->getSubcategories($category['id']);
    }

    return $categories;
  }

  public function getSubcategories($parentId)
  {
    $stmt = $this->conn->prepare("SELECT * FROM `category` WHERE parentId = :parentId");
    $stmt->bindParam(':parentId', $parentId, \PDO::PARAM_INT);
    $stmt->execute();
    $subcategories = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    foreach ($subcategories as &$subcategory) {
      $subcategory['subcategories'] = $this->getSubcategories($subcategory['id']);
    }
    return $subcategories;
  }
}
