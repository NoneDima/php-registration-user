<?php

namespace app\Models;

class Validator {
    protected $commands = [];

    public function required(){
        $this->commands['required'] = fn($str) => strlen($str) != 0;

        return $this;
    }

    public function length($min, $max = false){
        $this->commands['length'] = fn($str) => strlen($str) > $min && ($max === false || strlen($str) < $max);

        return $this;
    }

    public function email(){
        $this->commands['email'] = fn($str) => preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $str);

        return $this;
    }

    public function phone(){
        $this->commands['phone'] = fn($str) => preg_match("/^\+?[1-9]\d{1,14}$/", $str);

        return $this;
    }

    public function validate($str){
        foreach($this->commands as $name => $fn){
            if(!$fn($str)){
                return false;
            }
        }

        return true;
    }

    public static function validateSchema($schema, $data){
        $valide = true;
        $errors = [];
        foreach($schema as $field => $validator){
            if(!$validator->validate($data[$field])){
                $valide = false;

                array_push($errors, $field);
            }
        }

        if($valide){
            return true;
        }
    
        return $errors;
    }

    public static function simpleSchemaValidation($schema, $data){
        foreach($schema as $field => $validator){
            if(!$validator->validate($data[$field])){
                return "$field is not valide.\n";
            }
        }
    
        return "All right\n";
    }
}