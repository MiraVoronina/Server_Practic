<?php
// app/Model/Attendance.php
class Attendance {
    private $conn;
    private $table_name = "attendance";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($student_id, $schedule_id, $status) {
        $query = "INSERT INTO " . $this->table_name . " SET student_id=:student_id, schedule_id=:schedule_id, status=:status";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':student_id', $student_id);
        $stmt->bindParam(':schedule_id', $schedule_id);
        $stmt->bindParam(':status', $status);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
