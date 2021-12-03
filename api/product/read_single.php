<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  $database = new Database();
  $db = $database->connect();

  $product = new Product($db);

  $product->id = isset($_GET['id']) ? $_GET['id'] : die();

  $product->read_single();

  $product_arr = array(
    'id' => $product->id,
    'brand' => $product->brand,
    'date_added' => $product->date_added,
    'description' => $product->description,
    'image' => $product->image,
    'is_featured' => $product->is_featured,
		'is_recommended' => $product->is_recommended,
		'max_quantity' => $product->max_quantity,
		'name' => $product->name,
		'name_lower' => $product->name_lower,
		'price' => $product->price,
		'quantity' => $product->quantity,
  );

  print_r(json_encode($product_arr));