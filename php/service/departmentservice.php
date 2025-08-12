<?php
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../api/debug.log');

require_once __DIR__ . '/../model/departmentModel.php';

class DepartmentService {
    private $dModel;
    public function __construct() {
        $this->dModel = new Departmentodel();

    }

    public function process($conn, $data) {
          error_log("=== in process service department==");
        $conn->begin_transaction();
        try {
            $id = $this->dModel->saveDepartment($conn, $data);
            $conn->commit();
            return (["success" => true, "id" => $id]);
        } catch (Exception $e) {
            $conn->rollback();
            error_log("Transaction failed: " . $e->getMessage());
            return ["error" => $e->getMessage()];
        }
    }
 public function getAllDepartments($conn) {
     error_log("=== in process service getAllDepartment==");
        $conn->begin_transaction();
        $data;
        try {
            return $this->dModel->getAllDepartments($conn);   
        } catch (Exception $e) {
            $conn->rollback();
            error_log("Transaction failed: " . $e->getMessage());
            return ["error" => $e->getMessage()];
        }
    }
}
?>
