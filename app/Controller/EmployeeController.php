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
        $employees = $this->employee->getAll();
        echo new View($employees->fetchAll(PDO::FETCH_ASSOC));
    }
}
?>
