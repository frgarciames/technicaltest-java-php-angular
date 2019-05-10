<?php

/**
* Request
*/
class Request {
    
    /**
    * @var string
    */
    private $method;
    
    /**
    * @var string
    */
    private $action;
    
    /**
    * @var array
    */
    private $queryString;
    
    /**
    * @var array
    */
    private $body;
    
    /**
    * @var string
    */
    private $requestParam;
    
    function __construct(array $args){
        foreach($args as $key=>$val)
        $this->$key = $val;
    }
    
    /**
    * Get method
    *
    * @return string
    */
    public function getMethod() {
        return $this->method;
    }
    
    /**
    * Set method
    * @param string $method
    *
    * @return Request
    */
    public function setMethod($method) {
        $this->method = $method;
        return $this;
    }
    
    /**
    * Set action
    *
    * @param string $action
    *
    * @return Request
    */
    public function setAction($action) {
        $this->action = $action;
        
        return $this;
    }
    
    /**
    * Get action
    *
    * @return string
    */
    public function getAction() {
        return $this->action;
    }
    
    /**
    * Set queryString
    *
    * @param string $queryString
    *
    * @return Request
    */
    public function setQueryString($queryString) {
        $this->queryString = $queryString;
        
        return $this;
    }
    
    /**
    * Get queryString
    *
    * @return string
    */
    public function getQueryString() {
        return $this->queryString;
    }
    
    /**
    * Set body
    *
    * @param array $body
    *
    * @return Request
    */
    public function setBody($body) {
        $this->body = $body;
        
        return $this;
    }
    
    /**
    * Get body
    *
    * @return array
    */
    public function getBody() {
        return $this->body;
    }
    
    /**
    * Set requestParam
    *
    * @param string $requestParam
    *
    * @return Request
    */
    public function setRequestParam($requestParam) {
        $this->requestParam = $requestParam;
        
        return $this;
    }
    
    /**
    * Get requestParam
    *
    * @return string
    */
    public function getRequestParam() {
        return $this->requestParam;
    }
}