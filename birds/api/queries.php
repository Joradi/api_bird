<?php
require_once "structs.php";

// Select Queries
class Queries
{
    private $conn;
    private $table;

    function __construct($conn, $table)
    {
        $this->conn = $conn;
        $this->table = $table;
    }

    function list($params)
    {
        $sql = "SELECT * FROM $this->table";
        if (isset($params["id"])) {
            $sql .= " WHERE id = " . $params["id"];
        }
        $result = $this->conn->query($sql);
        if ($result) {
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return false;
        }
    }
}
