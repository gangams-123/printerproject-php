<?php
require_once 'cors.php';
require_once __DIR__ . '/../controllers/departmentController.php';

$controller = new DepartmentController();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $controller->createDepartment();
        break;
    case 'GET':
        $controller->getAllDepartments();
        break;
    default:
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
}
