<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/User.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog user object
  $user = new User($db);

  // Get raw usered data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $user->id = $data->id;
	$user->address = $data->address;
	$user->avatar = $data->avatar;
	$user->banner = $data->banner;
	$user->email = $data->email;
	$user->fullName = $data->fullName;
	$user->role = $data->role;

  // Update user
  if($user->update()) {
    echo json_encode(
      array('message' => 'user Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'user Not Updated')
    );
  }

