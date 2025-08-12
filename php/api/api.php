<?php
require_once 'cors.php';
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/debug.log'); // you choose the filename
error_log("=== starting program execution ===");
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Adjust if you're working inside a subfolder (like /myproject)
$basePath = '/php/api';
if (str_starts_with($uri, $basePath)) {
    $uri = substr($uri, strlen($basePath));
}
error_log("Cleaned URI: " . $uri);

// Simple router dispatcher
$routes = [
    '/branchMaster' => __DIR__ . '/branchRoutes.php',
    '/deptMaster'=> __DIR__ . '/departmentRoutes.php',
];

if (isset($routes[$uri])) {
    require $routes[$uri];
} else {
    http_response_code(404);
    echo json_encode(["error" => "Route not found: $uri"]);
}
