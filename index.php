<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Headers: Content-Type');
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
ini_set('max_execution_time', 9999);

require 'Core/Functions.php';
use Core\Functions;

include('routes.php');

$f = new Functions('localhost', 3306, 'mentorprenuer', 'root', '');


$directory = 'Controllers/';
$files = glob($directory . '*.php');
foreach ($files as $file) {
    include $file;
}


$url = rtrim($_SERVER['REQUEST_URI'], '/');
$url = explode('?', $url)[0];
$prefix = '/mentorprenuerBackend';
if (strpos($url, $prefix) === 0) {
    $url = substr($url, strlen($prefix));
}

$method = $_SERVER['REQUEST_METHOD'];

if (isset($routes[$method])) {
    foreach ($routes[$method] as $route => $function) {
        // Replace placeholders with capturing groups
        $pattern = preg_replace('#\{([^/]+)\}#', '(?<$1>[^/]+)', $route);
        $pattern = str_replace('/', '\/', $pattern);
        if (preg_match('#^' . $pattern . '$#', $url, $matches)) {
            
            $params = array_slice($matches, 1); // Extract parameters from matches
            
            // Get additional POST parameters
            if ($method === 'POST') {
                // Read raw input and decode JSON
                $json = file_get_contents('php://input');
                $data = json_decode($json, true);
                
                // Add the decoded JSON data as the last parameter
                $params[] = $data;
            }
            
            // Call the function with the extracted parameters
            call_user_func_array($function, $params);
            exit;
        }
    }
}

$f->outPut("Endpoint not found", 404, []);
