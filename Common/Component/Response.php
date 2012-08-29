<?php
namespace Common\Component;

class Response
{
    public $data;
    public $status;
    public $errors = array();
    
    const SUCCESS = 'success';
    const NOT_FOUND = 'not found';
    const ERROR_VALIDATION = 'validation error';
    
    public function __construct($data = null)
    {
        $this->data = $data;
    }
}