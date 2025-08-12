<?php
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../api/debug.log');

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../service/departmentservice.php'; // assuming this is your actual class

class DepartmentController {
    private $conn;
    private $service;
    public function __construct() {
        $db = new Database();
        
        session_start(); 
        $this->conn = $db->getConnection();
    }
    public function createDepartment() {
        error_log("=== in createdepartment controller===");
        $input = json_decode(file_get_contents("php://input"));  
        error_log("input ");
        if (!$input) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid input"]);
            return;
        }
        $service= new DepartmentService(); 
        $result = $service->process($this->conn, $input);
        session_destroy(); 
        echo json_encode($result);
    }
    public function getAllDepartments(){
        $service= new DepartmentService(); 
        $result = $service->getAllDepartments($this->conn); 
        session_destroy(); 
        echo json_encode($result); 
    }
}

?>
