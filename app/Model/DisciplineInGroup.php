<?php
// app/Model/DisciplineInGroup.php
class DisciplineInGroup {
    private $conn;
    private $table_name = "disciplines_in_groups";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($group_id, $discipline_id) {
        $query = "INSERT INTO " . $this->table_name . " SET group_id=:group_id, discipline_id=:discipline_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':group_id', $group_id);
        $stmt->bindParam(':discipline_id', $discipline_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
