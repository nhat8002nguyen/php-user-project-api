<?php 
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/Database.php';
  include_once '../../models/Post.php';

  $database = new Database();
  $db = $database->connect();

  $user = new User($db);

  $user->id = isset($_GET['id']) ? $_GET['id'] : die();

  $user->read_single();

  $user_arr = array(
    'id' => $user->id,
    'address' => $user->address,
    'avatar' => $user->avatar,
    'banner' => $user->banner,
    'email' => $user->email,
    'fullName' => $user->fullName,
		'role' => $user->role,
		'created_at' => $user->created_at,
		'updated_at' => $user->updated_at,
  );

  print_r(json_encode($user_arr));