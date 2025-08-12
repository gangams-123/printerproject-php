<?php
require_once 'cors.php';
require_once __DIR__ . '/../controllers/branchController.php';

$controller = new BranchController();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $controller->createBranch();
        break;
    case 'GET':
        $controller->getAllBranches();
        break;
    default:
        http_response_code(405);
        echo json_encode(["error" => "Method not allowed"]);
}
