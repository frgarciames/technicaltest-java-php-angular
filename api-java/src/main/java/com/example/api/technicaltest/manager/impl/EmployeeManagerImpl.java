package com.example.api.technicaltest.manager.impl;

import com.example.api.technicaltest.domain.Employee;
import com.example.api.technicaltest.manager.EmployeeManager;
import com.example.api.technicaltest.repository.EmployeeRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service
public class EmployeeManagerImpl implements EmployeeManager {

    @Autowired
    private EmployeeRepository repository;

    @Override
    public Iterable<Employee> findAll() {
        return repository.findAll();
    }

    @Override
    public Employee findById(String id) {
        return repository.findById(id).orElse(null);
    }

    @Override
    public Employee save(Employee employee) {
        return repository.save(employee);
    }

    @Override
    public Iterable<Employee> saveAll(Iterable<Employee> e) {
        return repository.saveAll(e);
    }

    @Override
    public Employee update(Employee employee) {
        return repository.save(employee);
    }

    @Override
    public void remove(Employee employee) {
        repository.delete(employee);
    }
}
