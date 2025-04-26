<?php
// app/Controller/EmployeeController.php
namespace Controller;

use Src\View;
use Model\Employee;
use Src\Auth\Auth;
use Src\Database;

class EmployeeController
{
    private $employee;

    public function __construct()
    {
        $db = (new Database())->getConnection();
        $this->employee = new Employee($db);
    }

    public function index(): void
    {
        if (!Auth::check()) {
            header('Location: /home');
            exit;
        }

        $employees = $this->employee->getAll()->fetchAll(\PDO::FETCH_ASSOC);

        echo new View('site/employees', [
            'employees' => $employees,
            'user' => Auth::user()
        ]);
    }

    // Метод для получения всех сотрудников
    public function getAllEmployees() {
        $employees = $this->employee->getAll(); // Получаем всех сотрудников из базы данных
        // Преобразуем данные в формат JSON и выводим
        echo new View($employees->fetchAll(PDO::FETCH_ASSOC));
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
            echo new View(["message" => "Employee added successfully"]);
        } else {
            echo new View(["message" => "Failed to add employee"]);
        }
    }
}
?>
