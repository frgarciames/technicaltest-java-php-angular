package com.example.api.technicaltest.controller;

import com.example.api.technicaltest.domain.Employee;
import com.example.api.technicaltest.manager.EmployeeManager;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.server.ResponseStatusException;

import java.util.Collections;
import java.util.List;
import java.util.stream.Collectors;

@RestController
@CrossOrigin(origins = "*")
@RequestMapping("/api/employee")
public class EmployeeController {

    @Autowired
    private EmployeeManager manager;

    @GetMapping
    public List<Employee> getEmployees(
            @RequestParam(value = "id", required = false) String id,
            @RequestParam(value = "active", required = false) Boolean active,
            @RequestParam(value = "name", required = false) String name
    ) {
        List<Employee> employeeList = (List<Employee>) manager.findAll();

        if (null != id) {
            return (List<Employee>) Collections.singletonList(manager.findById(id));
        }

        if (null != name) {
            List<Employee> employeeListFilteredByName = employeeList.stream()
                    .filter(employee -> name.equalsIgnoreCase(employee.getName()))
                    .collect(Collectors.toList());
            if (null != active) {
                return employeeListFilteredByName.stream()
                        .filter(employee -> active.equals(employee.isActive()))
                        .collect(Collectors.toList());
            }
            return employeeListFilteredByName;
        }

        if (null != active) {
            return employeeList.stream().filter(employee -> active.equals(employee.isActive())).collect(Collectors.toList());
        }
        return employeeList;
    }

    @PostMapping
    public Employee create(@RequestBody final Employee employee) {
        return manager.save(employee);
    }

    @DeleteMapping("/{id}")
    public List<Employee> remove(@PathVariable String id) {
        manager.remove(manager.findById(id));
        return (List<Employee>) manager.findAll();
    }

    @PutMapping("/{id}")
    public Employee update(@PathVariable String id, @RequestBody Employee employee) {

        Employee employeeToUpdate = manager.findById(id);
        if (null != employeeToUpdate) {
            employeeToUpdate.setName(employee.getName());
            employeeToUpdate.setClockIn(employee.getClockIn());
            employeeToUpdate.setClockOut(employee.getClockOut());
            employeeToUpdate.setActive(employee.isActive());
            return manager.update(employeeToUpdate);
        }
        throw new ResponseStatusException(HttpStatus.NOT_FOUND);
    }
}
