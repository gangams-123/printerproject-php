<?php
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../api/debug.log');
class Departmentodel {
    public function saveDepartment($conn, $data) {
          error_log("=== in saveDepartment DeptModel===");
        $id = null;
        $name       = mysqli_real_escape_string($conn, $data->name);
        $sql = "INSERT INTO department (name,createdAt, createdBy)
                VALUES ('$name',NOW(), 'ganga')";
            error_log("sql Department save  " . $sql);
        $res = mysqli_query($conn, $sql);
        if ($res) 
            $id = mysqli_insert_id($conn); 
        error_log("DeptModel save called");
        return $id;
    }
    public function getAllDepartments($conn){
         $sql = "select * from department";
            error_log("sql department  " . $sql);
        $res = mysqli_query($conn, $sql);
         $dept = [];
        if ($res && mysqli_num_rows($res) > 0) 
            while ($row = mysqli_fetch_assoc($res)) 
                 $dept[] = $row;
        return $dept; 
    }
     public function deleteDept($conn,$id){
        $sql = "DELETE FROM department WHERE id = $id";
        error_log("sql department delete " . $sql);
        $res = mysqli_query($conn, $sql);
        if (!$res) {
            error_log("Delete error: " . mysqli_error($conn));
            return false;
        }
        return mysqli_affected_rows($conn);
    }
}    
?>