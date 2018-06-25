<?php

/**
 *
 */
class Event
{
  public $id;
  public $name;
  public $date;
  public $description;
  public $status;
  public $importance;

  private $conn;
  private $table_name = "event";

  function __construct($db)
  {
    $this->conn = $db;
    // code...
  }

  function read(){
    $query = "SELECT * FROM event Order by date";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }



}


 ?>
