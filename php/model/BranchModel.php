<?php
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../api/debug.log');
class BranchModel {
    public function saveBranch($conn, $data) {
          error_log("=== in saveBranch BranchModel===");
        $id = null;
        // Escape all inputs to prevent syntax errors and injection (bare minimum)
        $name       = mysqli_real_escape_string($conn, $data->name);
        $email      = mysqli_real_escape_string($conn, $data->email);
        $url        = mysqli_real_escape_string($conn, $data->url);
        $landline   = mysqli_real_escape_string($conn, $data->landline);
        $mobile     = mysqli_real_escape_string($conn, $data->mobile);
        $officeType = mysqli_real_escape_string($conn, $data->branchType);
        $eDate      = mysqli_real_escape_string($conn, $data->eDate);

        $sql = "INSERT INTO branchmaster (name, email, url, phoneNo, mobile, officeType, eDate, createdAt, createdBy)
                VALUES ('$name', '$email', '$url', '$landline', '$mobile', '$officeType', '$eDate', NOW(), 'ganga')";
            error_log("sql branch  " . $sql);
        $res = mysqli_query($conn, $sql);
        if ($res) 
            $id = mysqli_insert_id($conn); // ✅ Get the last inserted ID
        error_log("BranchModel save called");
        return $id;
    }
    public function getAllBranches($conn){
         $sql = "select * from branchmaster";
            error_log("sql branch  " . $sql);
        $res = mysqli_query($conn, $sql);
         $branches = [];
        if ($res && mysqli_num_rows($res) > 0) 
            while ($row = mysqli_fetch_assoc($res)) 
                 $branches[] = $row;
        return $branches; // ✅ Return as array
    }
}
?>
