<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/product.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog product object
  $product = new Product($db);

  // Get raw producted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $product->id = $data->id;

  $product->brand = $data->brand;
	$product->date_added = $data->date_added;
	$product->description = $data->description;
	$product->image = $data->image;
	$product->is_featured = $data->is_featured;
	$product->is_recommended = $data->is_recommended;
	$product->max_quantity = $data->max_quantity;
	$product->name = $data->name;
	$product->name_lower = $data->name_lower;
	$product->price = $data->price;
	$product->quantity = $data->quantity;

  // Update product
  if($product->update()) {
    echo json_encode(
      array('message' => 'product Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'product Not Updated')
    );
  }

