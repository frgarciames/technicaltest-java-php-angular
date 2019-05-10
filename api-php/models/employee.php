<?php

/**
* Employee
*/
class Employee {
    
    /**
    * @var integer
    */
    private $id;
    
    /**
    * @var string
    */
    private $name;
    
    /**
    * @var \DateTime
    */
    private $clockIn;
    
    /**
    * @var \DateTime
    */
    private $clockOut;
    
    /**
    * @var boolean
    */
    private $active;
    
    function __construct($name, $active) {
        $this->id = uniqid();
        $this->name = $name;
        $this->clockIn = null;
        $this->clockOut = null;
        $this->active = $active;
    }
    
    /**
    * Get id
    *
    * @return integer
    */
    public function getId() {
        return $this->id;
    }
    
    /**
    * Set id
    * @param integer $id
    *
    * @return Employee
    */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }
    
    /**
    * Set name
    *
    * @param string $name
    *
    * @return Employee
    */
    public function setName($name) {
        $this->name = $name;
        
        return $this;
    }
    
    /**
    * Get name
    *
    * @return string
    */
    public function getName() {
        return $this->name;
    }
    
    /**
    * Set clockIn
    *
    * @param \DateTime $clockIn
    *
    * @return Employee
    */
    public function setClockIn($clockIn) {
        $this->clockIn = $clockIn;
        
        return $this;
    }
    
    /**
    * Get clockIn
    *
    * @return \DateTime
    */
    public function getClockIn() {
        return $this->clockIn;
    }
    
    /**
    * Set clockOut
    *
    * @param \DateTime $clockOut
    *
    * @return Employee
    */
    public function setClockOut($clockOut) {
        $this->clockOut = $clockOut;
        
        return $this;
    }
    
    /**
    * Get clockOut
    *
    * @return \DateTime
    */
    public function getClockOut() {
        return $this->clockOut;
    }
    
    /**
    * Set active
    *
    * @param boolean $active
    *
    * @return Employee
    */
    public function setActive($active) {
        $this->active = $active;
        
        return $this;
    }
    
    /**
    * Get active
    *
    * @return boolean
    */
    public function getActive() {
        return $this->active;
    }
}