<?php
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../api/debug.log');
class FileModel {
    public function saveFile($conn, $data, $entityType, $type, $id) {

        
        
         error_log("=== in saveFile Filemodel===");
        // Sanitize/escape input
        $fileName = mysqli_real_escape_string($conn, $data->logo->fileName);
        $fileSize = (int)$data->logo->size;
        $fileData = mysqli_real_escape_string($conn, $data->logo->blob); // assuming base64 or text blob
        $entityType = mysqli_real_escape_string($conn, $entityType);
        $type = mysqli_real_escape_string($conn, $type);
        $id = (int)$id;

        $sql = "INSERT INTO files (
                    file_name, file_size, file_data,
                    uploaded_by, entity_id, uploaded_at, entity_type, type
                ) VALUES (
                    '$fileName', $fileSize, '$fileData',
                    'ganga', $id, NOW(), '$entityType', '$type'
                )";
         mysqli_query($conn, $sql);
           error_log("=== in saveFile Filemodel ends===");
    }
    
}
?>
