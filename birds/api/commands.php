<?php
// INSERT UPDATE DELETE
class Commands
{
    private $conn;
    private $table;

    function __construct($conn, $table)
    {
        $this->conn = $conn;
        $this->table = $table;
    }

    function create($data)
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), '?'));
        $sql = "INSERT INTO $this->table ($columns) VALUES ($placeholders)";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
        $stmt->bind_param(str_repeat('s', count($data)), ...array_values($data));
        if ($stmt->execute()) {
            return true;
        } else {
           
            error_log("Error executing statement: " . $stmt->error);
            return false;
        }
        } else {
      
        error_log("Error preparing statement: " . $this->conn->error);
        return false;
    }
    }

    function update($data, $id)
    {
        $set = '';
        foreach ($data as $column => $value) {
            $set .= "$column = ?, ";
        }
        $set = rtrim($set, ', ');
    
        $sql = "UPDATE $this->table SET $set WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $types = str_repeat('s', count($data)) . 'i';
            $values = array_values($data);
            $values[] = $id;
            $stmt->bind_param($types, ...$values);
            if ($stmt->execute()) {
                return true;
            } else {
                                error_log("Error executing statement: " . $stmt->error);
                return false;
            }
        } else {            
            error_log("Error preparing statement: " . $this->conn->error);
            return false;
        }
    }

    function delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('i', $id);
            if ($stmt->execute()) {
                return true;
            } else {
                // Aquí puedes manejar el error como prefieras
                error_log("Error executing statement: " . $stmt->error);
                return false;
            }
        } else {
            // Aquí puedes manejar el error como prefieras
            error_log("Error preparing statement: " . $this->conn->error);
            return false;
        }
    }
}
?>