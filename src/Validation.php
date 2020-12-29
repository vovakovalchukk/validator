<?php

require 'BaseValidation.php';
require 'ValidationInterface.php';

final class Validation extends BaseValidation implements ValidationInterface {

	private $patterns = [
		'url'    => FILTER_VALIDATE_URL,
		'email'  => FILTER_VALIDATE_EMAIL
	];

	public function pattern($name)
	{           
        if(!isset($this->patterns[$name]))
        {
            $this->errors[] = 'Паттерн не найден: '. $name;
        }
        if($this->value != '' && !filter_var($this->value, $this->patterns[$name]))
        {   
            $this->errors[] = empty($this->message) ?  'Ошибка валидации: '. $this->name : $this->message;
        }
        return $this; 
    }

    public function customPattern($pattern)
    {  
        $regex = '/^('.$pattern.')$/u';
        if($this->value != '' && !preg_match($regex, $this->value))
        {
            $this->errors[] = empty($this->message) ?  'Ошибка валидации: '. $this->name : $this->message;
        }
        return $this;    
    }

    public function required()
    {
        if($this->value == '' || $this->value == null)
        {
            $this->errors[] = 'Заполните поле: ' . $this->name;
        }            
        return $this;       
    }

}