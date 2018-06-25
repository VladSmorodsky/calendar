<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 12.06.18
 * Time: 0:23
 */

class Database
{
    private $host = "localhost";
    private $db = "events";
    private $username = "root";
    private $password = "storm1382";
    public $conn;

    public function getConnection(){
        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" .   $this->host   .";dbname="   .   $this->db, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch (PDOException $pdoe){
            echo "Connection error: "   .   $pdoe->getMessage();
        }
        return $this->conn;
    }

}
