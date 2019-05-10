<?php

require('config/request.php');
require('controllers/employee.php');
require('controllers/test.php');

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
header('Content-Type: application/json');

$controllers = array(
'employee' => 'Employee_Controller',
'test' => 'Test_Controller'
);

$uri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];
$queryString = $_SERVER['QUERY_STRING'];
$uriArray = explode('/', $uri);
$firstPathUri = $uriArray[1];
$action = isset($queryString) ? explode('?', $uriArray[2])[0] : $uriArray[2];
$requestParam = isset($uriArray[3]) ? $uriArray[3] : null;

if ($firstPathUri !== 'api') {
    echo 'ERROR: PAGE NOT FOUND';
    return;
}

$request = new Request(array(
'method' => $requestMethod,
'action' => $action,
'queryString' => $queryString ? $queryString : null,
'body' => $requestMethod === 'POST' || $requestMethod === 'PUT' ? json_decode(file_get_contents('php://input'), true) : null,
'requestParam' => $requestParam ? $requestParam : null
));

if(isset($controllers[$action])) {
    $controller = $controllers[$action]::getInstance();
    if($action == 'test') {
        echo $controller->{'index_'.strtolower($requestMethod)}($request);
    } else {
        echo json_encode($controller->{'index_'.strtolower($requestMethod)}($request));
    }
} else {
    echo 'ERROR: ACTION <strong>'. $request->getAction().'</strong> NOT FOUND';
}