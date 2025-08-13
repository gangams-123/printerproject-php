<?php
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../api/debug.log');
class DesignationModel {
    public function saveDesignation($conn, $data) {
          error_log("=== in saveDesignationModel ===");
        $id = null;
        $name= mysqli_real_escape_string($conn, $data->designationName);
        $deprtmentId=mysqli_real_escape_string($conn, $data->departmentId);
        $sql = "INSERT INTO designation (name,deptId,createdAt, createdBy)
                VALUES ('$name','$deprtmentId',NOW(), 'ganga')";
            error_log("sql DesignationModel save  " . $sql);
        $res = mysqli_query($conn, $sql);
        if ($res) 
            $id = mysqli_insert_id($conn); 
        error_log("DesignationModel save end");
        return $id;
    }
    public function getAllDesignations($conn){
             $data = [];
         $sql =  "SELECT b.name AS designationName,a.name AS departmentName,b.id   AS designationId,b.deptId AS departmentId
                    FROM department a JOIN designation b ON a.id = b.deptId";
            error_log("sql designation  " . $sql);
        $res = mysqli_query($conn, $sql);
         if ($res && $res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                $data[] = $row;
            }
            error_log("All rows: " . json_encode($data)); // now inside the if
        } else 
            error_log("No rows found or query failed: " . mysqli_error($conn));
        return $data;
    }
     public function deleteDesignation($conn,$id){
         error_log("deleteDesignation save start");
        $sql = "DELETE FROM designation WHERE id = $id";
        error_log("sql designation delete " . $sql);
        $res = mysqli_query($conn, $sql);
        if (!$res) {
            error_log("Delete error: " . mysqli_error($conn));
            return false;
        }
        return mysqli_affected_rows($conn);
    }
}    
?>