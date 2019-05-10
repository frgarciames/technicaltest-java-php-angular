<?php

require(dirname(__FILE__).'/../models/employee.php');
require(dirname(__FILE__).'/../helpers/employee.php');

class Employee_Controller {
    
    private static $instance;
    
    public static function getInstance() {
        if(!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    public function index_get($request) {
        $employeeList = json_decode(file_get_contents('http://localhost/api/config/data.json'), true);
        $employeesFiltered = [];
        if($request->getQueryString()) {
            if(isset($_GET['id'])) {
                $id = $_GET['id'];
                foreach ($employeeList as $employee) {
                    if($employee['id'] == $id) {
                        array_push($employeesFiltered, $employee);
                    }
                }
            } else {
                parse_str($request->getQueryString(), $keyAndValueQueryString);
                $filteredData = filterEmployeesByAttributes($employeeList, $keyAndValueQueryString);
                foreach ($filteredData as $data) {
                    array_push($employeesFiltered, $data);
                }
            }
            return $employeesFiltered;
        } else {
            return $employeeList;
        }
    }
    
    public function index_post($request) {
        $employeeList = json_decode(file_get_contents('http://localhost/api/config/data.json'), true);
        $employee = new Employee($request->getBody()['name'], $request->getBody()['active']);
        array_push($employeeList, array(
        "id" => $employee->getId(),
        "name" => $employee->getName(),
        "clockIn" => $employee->getClockIn(),
        "clockOut" => $employee->getClockOut(),
        "active" => $employee->getActive()
        ));
        
        file_put_contents(dirname(__FILE__).'/../config/data.json', json_encode($employeeList));
        
        return json_decode(file_get_contents(dirname(__FILE__).'/../config/data.json'), true);
    }
    
    public function index_put($request) {
        $employeeList = json_decode(file_get_contents('http://localhost/api/config/data.json'), true);
        $employee = getEmployeeById($employeeList, $request->getRequestParam());
        if(isset($employee)) {
            foreach ($request->getBody() as $key => $value) {
                $employee[$key] = $value;
            }
            
            $employeeListFiltered = removeEmployeeFromEmployeeList($employeeList, $request->getRequestParam());
            array_push($employeeListFiltered, $employee);
            file_put_contents(dirname(__FILE__).'/../config/data.json', json_encode(array_values($employeeListFiltered)));
            return json_decode(file_get_contents(dirname(__FILE__).'/../config/data.json'), true);
        }
        
        return array(
        'error' => 'Employee with id: '.$request->getRequestParam().' not found'
        );
    }
    
    public function index_delete($request) {
        $employeeList = json_decode(file_get_contents('http://localhost/api/config/data.json'), true);
        $employee = getEmployeeById($employeeList, $request->getRequestParam());
        if(isset($employee)) {
            
            $employeeListFiltered = removeEmployeeFromEmployeeList($employeeList, $request->getRequestParam());
            file_put_contents(dirname(__FILE__).'/../config/data.json', json_encode(array_values($employeeListFiltered)));
            return json_decode(file_get_contents(dirname(__FILE__).'/../config/data.json'), true);
        }
        
        return array(
        'error' => 'Employee with id: '.$request->getRequestParam().' not found'
        );
    }
    
}