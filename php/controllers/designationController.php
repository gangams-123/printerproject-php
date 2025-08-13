<?php
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../api/debug.log');

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../service/designationService.php'; // assuming this is your actual class

class DesignationController {
    private $conn;
    private $service;
    public function __construct() {
        $db = new Database();
        
        session_start(); 
        $this->conn = $db->getConnection();
    }
    public function createDesignation() {
        error_log("=== in createDesignation controller===");
        $rawData = file_get_contents("php://input");
        error_log($rawData);
        $input = json_decode($rawData);
        if (!$input) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid input"]);
            return;
        }
        $service= new DesignationService(); 
        $result = $service->saveDesigation($this->conn, $input);
        session_destroy(); 
        echo json_encode($result);
    }
    public function getAllDesignations(){
         error_log("=== in getAllDesignations controller ===");
       $service= new DesignationService(); 
        $result = $service->getAllDesignations($this->conn); 
        error_log("All rows: " . json_encode($result));
        session_destroy(); 
        echo json_encode($result); 
    }
    public function deleteDesignation(){
         $input = json_decode(file_get_contents("php://input")); 
        error_log("input " . json_encode($input));
        $id = intval($input->id); 
        error_log("id".$id);
        if (!$input) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid input"]);
            return;
        }
         error_log("=== in deleteDesignation controller deleteDept===");
         $service= new DesignationService(); 
          $result = $service->deleteDesignation($this->conn,$id); 
            session_destroy(); 
        echo json_encode($result); 
    }
}

?>
