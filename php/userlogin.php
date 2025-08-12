<?php 
   // Allow requests from specific origin
header("Access-Control-Allow-Origin: http://localhost:4200");

// Allow specific HTTP methods (e.g., POST for login)
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

// Allow specific headers (e.g., Content-Type)
header("Access-Control-Allow-Headers: Content-Type");
 header('Content-Type: application/json; charset=utf-8');
// Allow credentials (e.g., cookies, authorization headers) if needed
header("Access-Control-Allow-Credentials: true");
   require_once 'config.php'; 
    $postdata=file_get_contents("php://input");
     ob_end_clean();
    if(isset($postdata)&&!empty($postdata)){
        $credential=json_decode($postdata);
      
         if ($credential == null &&!empty($credential)){ 
            
        }
        else{
            $username=$credential->username;
            $password=$credential->password;
          
            if( $username==null && $password==null)
               echo json_encode(array("message"=>"the username or password cannot be empty"));
            
            else{
               echo json_encode(array("message"=>"the login successful" ));
               // Close connection (important for resource management)
               mysqli_close($conn);
            }
            
        }
    }
    else
         echo json_encode(array("message"=>"the login successful"));
?>
