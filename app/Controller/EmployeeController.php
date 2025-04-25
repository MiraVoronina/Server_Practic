<?php
// app/Controller/EmployeeController.php

require_once "../app/Model/Employee.php";  // Подключаем модель Employee

class EmployeeController {
    private $db;
    private $employee;

    public function __construct() {
        $this->db = (new Database())->getConnection(); // Получаем подключение к базе данных
        $this->employee = new Employee($this->db); // Создаем экземпляр модели Employee
    }

    // Метод для получения всех сотрудников
    public function getAllEmployees() {
        $employees = $this->employee->getAll(); // Получаем всех сотрудников из базы данных
        // Преобразуем данные в формат JSON и выводим
        echo json_encode($employees->fetchAll(PDO::FETCH_ASSOC));
    }

    // Метод для добавления нового сотрудника
    public function createEmployee($data) {
        // Получаем данные из запроса и передаем их в модель для добавления в базу данных
        $result = $this->employee->create(
            $data['first_name'],
            $data['last_name'],
            $data['middle_name'],
            $data['login'],
            $data['password'],
            $data['phone'],
            $data['position_id']
        );
        if ($result) {
            echo json_encode(["message" => "Employee added successfully"]);
        } else {
            echo json_encode(["message" => "Failed to add employee"]);
        }
    }
}
?>
