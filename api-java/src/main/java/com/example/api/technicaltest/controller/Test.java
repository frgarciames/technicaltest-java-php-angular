package com.example.api.technicaltest.controller;

import org.springframework.http.MediaType;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@CrossOrigin(origins = "*")
@RequestMapping(path="/api/test", produces = MediaType.APPLICATION_JSON_VALUE)
public class Test {

    @GetMapping
    public String testRestController() {
        return "It works!";
    }
}
