<?php

class BaseValidation
{
    protected $name;
    protected $value;
    protected $pattern;
    protected $errors = [];
    protected $message = '';
    
    public function name($name)
	{
        $this->message = '';
        $this->name = $name;
        return $this;
    }
        
    public function value($value)
    {  
        $this->value = $value;
        return $this;
    }

    public function message($message)
    {
        $this->message = $message;
        return $this;
    }

    public function isSuccess()
    {
        if(empty($this->errors)) return true;
    }
        
    public function getErrors()
    {
        if(!$this->isSuccess()) return $this->errors;
    }

}