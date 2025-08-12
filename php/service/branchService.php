<?php
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../api/debug.log');

require_once __DIR__ . '/../model/BranchModel.php';
require_once __DIR__ . '/../model/AddressModel.php';
require_once __DIR__ . '/../model/FileModel.php';

class BranchService {
    private $bModel;
    private $fModel;
    private $aModel;

    public function __construct() {
        $this->bModel = new BranchModel();
        $this->fModel = new FileModel();
        $this->aModel = new AddressModel();
    }

    public function process($conn, $data) {
          error_log("=== in process service===");
        $conn->begin_transaction();
        try {
            $id = $this->bModel->saveBranch($conn, $data);
            error_log("id is  " . $id);

            if ($id != null) {
                $this->fModel->saveFile($conn, $data, 'branch', 'logo', $id);
                $this->aModel->saveAddress($conn, $data, 'branch', 'office', $id);
            }

            $conn->commit();
            return (["success" => true, "id" => $id]);
        } catch (Exception $e) {
            $conn->rollback();
            error_log("Transaction failed: " . $e->getMessage());
            return ["error" => $e->getMessage()];
        }
    }
 public function getAllBranches($conn) {
        $conn->begin_transaction();
        $data;
        try {
            return $this->bModel->getAllBranches($conn);   
        } catch (Exception $e) {
            $conn->rollback();
            error_log("Transaction failed: " . $e->getMessage());
            return ["error" => $e->getMessage()];
        }
    }
}
?>
