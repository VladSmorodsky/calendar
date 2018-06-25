<?php

//header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");

ini_set('display_errors', 0);
  include_once '../config/database.php';
  include_once '../objects/event.php';

  $response = "";

  $database = new Database();
  $db = $database->getConnection();

  $event_db = new Event($db);

  $stmt = $event_db->read();
  $num = $stmt->rowCount();

  if($num > 0){

    $event_arr = array();
    $event_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
      extract($row);

      $event_item = array(
        "id" => $id,
        "event" => $event,
        "description" => html_entity_decode($description),
        "date" => $date,
        "status" => $status,
        "importance" => $importance
      );

      array_push($event_arr["records"], $event_item);
    }

    $response = json_encode($event_arr);
    echo $response;
  }

  else {
    echo json_encode(
      array("message" => "No products found.")
  );
    // code...
  }

 ?>
