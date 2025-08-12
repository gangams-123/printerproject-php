<?php
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../api/debug.log');

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../service/branchService.php'; // assuming this is your actual class

class BranchController {
    private $conn;

    public function __construct() {
        $db = new Database();
        session_start(); // ✅ session start
        $this->conn = $db->getConnection();
    }
    public function createBranch() {
        error_log("=== in createBranch controller===");
        $input = json_decode(file_get_contents("php://input"));  
        error_log("input ");
        if (!$input) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid input"]);
            return;
        }

        $service = new BranchService(); // or BranchService, if you renamed it
        $result = $service->process($this->conn, $input); // ✅ use $this->conn

        session_destroy(); // ✅ semicolon added
        echo json_encode($result);
    }
    public function getAllBranches(){
        $service = new BranchService(); // or BranchService, if you renamed it
        $result = $service->getAllBranches($this->conn); // ✅ use $this->conn

        session_destroy(); // ✅ semicolon added
        echo json_encode($result); 
    }
}

?>
