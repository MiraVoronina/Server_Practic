<?php
// app/Model/Discipline.php
class Discipline {
    private $conn;
    private $table_name = "disciplines";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($name) {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':name', $name);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
