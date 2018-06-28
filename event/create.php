<?php

  header("Access-Control-Allow-Origin: *");
  header("Content-Type: application/json; charset=UTF-8");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  include_once '../config/database.php';
  include_once '../objects/event.php';

  $database = new Database();
  $db = $database->getConnection();

  $event = new Event($db);

  $data = json_decode(file_get_contents("php://input"));
  //var_dump($data);
  $event->event = $_POST["event"];
  $event->description = $_POST["description"];
  $event->date = $_POST["date"];
  $event->status = "created";
  $event->importance = $_POST["importance"];

  if ($event->create()) {
    echo '{"message":"Event was created"}';
    // code...
  }

  else{
    echo '{"message": "Unable to create event."}';
}
 ?>
