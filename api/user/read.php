<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/User.php';

  $database = new Database();
  $db = $database->connect();

  $user = new User($db);

  $result = $user->read();
  $num = $result->rowCount();

  if($num > 0) {
    $users_arr = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $user_item = array(
			'id' => $id,
			'address' => $address,
			'avatar' => $avatar,
			'banner' => $banner,
			'email' => $email,
			'fullName' => $fullName,
			'role' => $role,
			'created_at' => $created_at,
      );

      // Push to "data"
      array_push($users_arr, $user_item);
      // array_push($users_arr['data'], $user_item);
    }

    // Turn to JSON & output
    echo json_encode($users_arr);

  } else {
    // No Users
    echo json_encode(
      array('message' => 'No Users Found')
    );
  }
