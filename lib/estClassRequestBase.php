<?php

class estClassRequestBase {

    function __construct() {
        class_alias('estClassRequestBase', 'request');
    }

    public static function get($key) {
 
        if (isset($_GET[$key]) && ($_GET[$key] != '')) {
            return $_GET[$key];
        }
        else {
            return '';
        }
 
    }
 

    public static function post($key) {
 
        if (isset($_POST[$key]) && ($_POST[$key] != '')) {
            return $_POST[$key];
        }
        else {
            return '';
        }
 
    }

    public static function set($key, $val) {
        $val = $_REQUEST[$key];
    }
    
}