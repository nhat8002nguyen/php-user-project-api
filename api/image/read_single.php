<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Image.php';

  $database = new Database();
  $db = $database->connect();

  $image = new Image($db);

  $image->id = isset($_GET['id']) ? $_GET['id'] : die();

  $image->read_single();

  $image_arr = array(
    'id' => $image->id,
    'url' => $image->url,
    'product_id' => $image->product_id,
    'created_at' => $image->created_at
  );

  print_r(json_encode($image_arr));