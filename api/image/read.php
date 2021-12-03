<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Image.php';

  $database = new Database();
  $db = $database->connect();

  $image = new Image($db);

  $result = $image->read();
  $num = $result->rowCount();

  if($num > 0) {
    $images_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $image_item = array(
        'id' => $id,
        'url' => $url,
        'product_id' => $product_id,
        'created_at' => $created_at,
      );

      array_push($images_arr, $image_item);
    }

    echo json_encode($images_arr);

  } else {
    echo json_encode(
      array('message' => 'No Images Found')
    );
  }
