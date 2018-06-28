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
  private $table_name = "events";

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

  function create(){
    $query = "INSERT into event SET event=:event, date=:date, description=:description, status=:status, importance=:importance";
    $stmt = $this->conn->prepare($query);

    $this->event = htmlspecialchars(strip_tags($this->event));
    $this->date = htmlspecialchars(strip_tags($this->date));
    $this->description = htmlspecialchars(strip_tags($this->description));
    $this->status = "created";
    $this->importance = htmlspecialchars(strip_tags($this->importance));

    $stmt->bindParam(":event", $this->event);
    $stmt->bindParam(":description", $this->description);
    $stmt->bindParam(":date", $this->date);
    $stmt->bindParam(":status", $this->status);
    $stmt->bindParam(":importance", $this->importance);

    if ($stmt->execute()) {
      // code...
      return true;
    }

    return false;
  }



}


 ?>
