package com.example.api.technicaltest.repository;

import com.example.api.technicaltest.domain.Employee;
import org.springframework.data.mongodb.repository.MongoRepository;
import org.springframework.stereotype.Service;

@Service
public interface EmployeeRepository extends MongoRepository<Employee, String> {
}
