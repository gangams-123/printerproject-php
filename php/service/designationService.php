<?php
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../api/debug.log');

require_once __DIR__ . '/../model/designationModel.php';

class DesignationService {
    private $dModel;
    public function __construct() {
        $this->dModel = new DesignationModel();

    }

    public function saveDesigation($conn, $data) {
          error_log("=== in process  DesignationService==");
        $conn->begin_transaction();
        try {
            $id = $this->dModel->saveDesignation($conn, $data);
            $conn->commit();
            if($id!=null){
                return (["success" => true, "id" => $id]);
            }else{
                return ["error" => "error in saving data"];
            }
        } catch (Exception $e) {
            $conn->rollback();
            error_log("Transaction failed: " . $e->getMessage());
            return ["error" => $e->getMessage()];
        }
    }
 public function getAllDesignations($conn) {
     error_log("=== in process service getAllDesignations==");
        $conn->begin_transaction();
        $data;
        try {
            return $this->dModel->getAllDesignations($conn);  
             
        } catch (Exception $e) {
            $conn->rollback();
            error_log("Transaction failed: " . $e->getMessage());
            return ["error" => $e->getMessage()];
        }
    }
    public function deleteDesignation($conn,$id) {
         error_log("=== in process service deleteDesignation==");
        $conn->begin_transaction();
        
        try {
            $deletedCount= $this->dModel->deleteDesignation($conn,$id); 
             if ($deletedCount > 0) {
            $conn->commit();
            return ["status" => "success", "message" => "Designation deleted successfully"];
        } else {
            $conn->rollback();
            return ["status" => "error", "message" => "No matching department found"];
        }
             return $response;
        } catch (Exception $e) {
            $conn->rollback();
            error_log("Transaction failed: " . $e->getMessage());
            return ["error" => $e->getMessage()];
        }
    }
}
?>
