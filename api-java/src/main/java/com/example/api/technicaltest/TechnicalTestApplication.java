package com.example.api.technicaltest;

import com.example.api.technicaltest.domain.Employee;
import com.example.api.technicaltest.repository.EmployeeRepository;
import org.springframework.boot.CommandLineRunner;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.context.annotation.Bean;

import java.text.SimpleDateFormat;
import java.util.Date;

@SpringBootApplication
public class TechnicalTestApplication {

    public static void main(String[] args) {
        SpringApplication.run(TechnicalTestApplication.class, args);
    }

    @Bean
    CommandLineRunner runner(EmployeeRepository repository) {
        return new CommandLineRunner() {
            @Override
            public void run(String... args) throws Exception {
                SimpleDateFormat df = new SimpleDateFormat("dd/MM/yyy");
                repository.deleteAll();

                final Employee employee1 = new Employee("Pepe", new Date(), new Date(), true);
                final Employee employee2 = new Employee("Paco", new Date(), new Date(), true);
                final Employee employee3 = new Employee("Antonio", new Date(), new Date(), false);


                repository.save(employee1);
                repository.save(employee2);
                repository.save(employee3);
            }
        };
    }

}
