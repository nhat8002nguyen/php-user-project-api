<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Image.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog image object
  $image = new Image($db);

  // Get raw imageed data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $image->id = $data->id;

  // Delete image
  if($image->delete()) {
    echo json_encode(
      array('message' => 'Image Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Image Not Deleted')
    );
  }

