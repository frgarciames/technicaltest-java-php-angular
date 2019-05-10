<?php

class Test_Controller {
    
    private static $instance;
    
    public static function getInstance() {
        if(!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }
    
    public function index_get($request) {
        return 'It works!';
    }
    
}