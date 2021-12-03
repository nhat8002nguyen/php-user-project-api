<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Product.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog product object
  $product = new Product($db);

  // Blog product query
  $result = $product->read();
  // Get row count
  $num = $result->rowCount();

  // Check if any products
  if($num > 0) {
    // Product array
    $products_arr = array();
    // $products_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $product_item = array(
        'id' => $id,
        'brand' => $brand,
        'date_added' => html_entity_decode($date_added),
        'description' => $description,
        'image' => $image,
        'is_featured' => $is_featured,
				'is_recommended' => $is_recommended,
				'max_quantity' => $max_quantity,
				'name' => $name,
				'name_lower' => $name_lower,
				'price' => $price,
				'quantity' => $quantity,
      );

      // Push to "data"
      array_push($products_arr, $product_item);
      // array_push($products_arr['data'], $product_item);
    }

    // Turn to JSON & output
    echo json_encode($products_arr);

  } else {
    // No Products
    echo json_encode(
      array('message' => 'No Products Found')
    );
  }
