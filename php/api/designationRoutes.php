<?php
require_once 'cors.php';
require_once __DIR__ . '/../controllers/designationController.php';

$controller = new DesignationController();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $controller->createDesignation();
        break;
    case 'GET':
        $controller->getAllDesignations();
        break;
    case 'DELETE':
        $controller->deleteDesignation();
        break;    
    default:
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
}
