<?php

function filterEmployeesByAttributes ($employeesList, $queryString) {
    $filteredData = array_filter($employeesList, function($employee) use($queryString) {
        $coincidencesArr = [];
        foreach ($queryString as $key => $value) {
            if(isset($employee[$key])) {
                if('active' === $key) {
                    $value = json_encode($value);
                    $employee[$key] = json_encode($employee[$key]);
                    if($value === $employee[$key]) {
                        array_push($coincidencesArr, true);
                    } else {
                        array_push($coincidencesArr, false);
                    }
                } else {
                    if(strcasecmp($employee[$key], $value) == 0) {
                        array_push($coincidencesArr, true);
                    } else {
                        array_push($coincidencesArr, false);
                    }
                }
            }
        }
        if(in_array(false, $coincidencesArr)) {
            return false;
        }
        return true;
    });
    return $filteredData;
}

function getEmployeeById($employeeList, $id) {
    foreach ($employeeList as $employee) {
        if($employee['id'] == $id) {
            return $employee;
        }
    }
}

function removeEmployeeFromEmployeeList($employeeList, $id) {
    return array_filter($employeeList, function($employee) use($id) {
        return $employee['id'] != $id;
    });
}