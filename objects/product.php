<?php
class Product{

  // Connect to database and table.
  private $conn;
  private $table_name = "products";

  // Object properties.
  public $id;
  public $name;
  public $description;
  public $price;
  public $category_id;
  public $category_name;
  public $created;

  // Constructor with $db variable as a database connection.
  public function __construct($db){
    $this->conn = $db;
  }

  // Read products
  function readAll(){
    // Select all query
    $query = "SELECT c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created FROM " . $this->table_name . " p

    LEFT JOIN
    categroies c
    ON p.$category_name_id = c.id
    ORDER BY
    p.created DESCRIPTION";

  // Prepare query statement
  $stmt = $this->conn->prepare($query);

  // Execute query
  $stmt->execute();
  return $stmt;
  }

}

?>
