<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Image.php';

  $database = new Database();
  $db = $database->connect();

  $image = new Image($db);

  $data = json_decode(file_get_contents("php://input"));

  $image->url = $data->url;
  $image->product_id = $data->product_id;

  if($image->create()) {
    echo json_encode(
      array('message' => 'Image Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Image Not Created')
    );
  }

