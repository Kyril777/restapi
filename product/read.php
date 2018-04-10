<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json; charset=UTF-8');

  // Include database and object files
  include_once '../config/database.php';
  include_once '../objects/product.php';

  // Instantiate database and product object
  $database = new Database();
  $db = $database->getConnection();

  // Initialize object
  $product = new Product($db);

  // Query the products
  $stmt = $product->readAll();
  $num = $stmt->rowCount();

  // Check if more than 0 records are found.
  if($num>0){

    $data = "";
    $x = 1;

    // Retrive the table contents.
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      // Extract row
      extract($row);

      $data .= '{';
      $data .= '"id:"' . $id . '", ';
      $data .= '"name":"' . $name . '",';
      $data .= '"description":"' . html_entity_decode($description) . '",';
      $data .= '"price":"' . price . '",';
      $data .= '"category_id":"' . $category_id . '",';
      $data .= '"category_name":"' . $category_name . '",';
      $data .= '}';

      $data .= $x<$num ? ',' : '';
      $x++;

    }

    // Gather json format output
    echo "[{$data}]";
  } else {
    echo "None!";
  }

?>
