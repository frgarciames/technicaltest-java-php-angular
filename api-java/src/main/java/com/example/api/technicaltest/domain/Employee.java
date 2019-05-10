package com.example.api.technicaltest.domain;

import org.springframework.data.annotation.Id;
import org.springframework.data.mongodb.core.mapping.Document;

import java.util.Date;

@Document(collection = "employees")
public class Employee {

    @Id
    private String id;
    private String name;
    private Date clockIn;
    private Date clockOut;
    private boolean active;

    public Employee(String name, Date clockIn, Date clockOut, boolean active) {
        this.name = name;
        this.clockIn = clockIn;
        this.clockOut = clockOut;
        this.active = active;
    }

    public void setId(String id) {
        this.id = id;
    }

    public void setName(String name) {
        this.name = name;
    }

    public void setClockIn(Date clockIn) {
        this.clockIn = clockIn;
    }

    public void setClockOut(Date clockOut) {
        this.clockOut = clockOut;
    }

    public void setActive(boolean active) {
        this.active = active;
    }

    public String getId() {
        return id;
    }

    public String getName() {
        return name;
    }

    public Date getClockIn() {
        return clockIn;
    }

    public Date getClockOut() {
        return clockOut;
    }

    public boolean isActive() {
        return active;
    }
}
