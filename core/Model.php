<?php

namespace app\core;
use app\core\Application;

class Model{

    public const RULE_REQUIRED = 'requred';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    const RULE_UNIQUE = 'unique';
    
    public array $errors = [];

    public function loadData($data)
    {
        foreach ($data as $key => $value)
        {
            if(property_exists($this, $key))
            {
                $this->{$key} = $value;
            }
        }
    }

    public function attributes()
    {
        return [];
    } 
    public function updateAttributes()
    {
        return [];
    }
    
    public function labels()
    {
        return [];
    }
    public function updaterules(){
        return [];
    }
    public function getLabel($attribute)
    {
        return $this->labels()[$attribute] ?? $attribute;
    }

    public function rules()
    {
        return [];
    }

    public function validate(){
        foreach($this->rules() as $attribute => $rules)
        {
            $value = $this->{$attribute};
            foreach ($rules as $rule) 
            {
                $ruleName = $rule;
                if (!is_string($rule)) 
                {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) 
                {
                    $this->addErrorForByRule($attribute, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {

                    $this->addErrorForByRule($attribute, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {

                    $this->addErrorForByRule($attribute, self::RULE_MIN, $rule);
                }
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {

                    $this->addErrorForByRule($attribute, self::RULE_MAX, $rule);
                }
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}) {

                    $this->addErrorForByRule($attribute, self::RULE_MATCH, $rule);
                }
                if ($ruleName === self::RULE_UNIQUE) {
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();
                    $db = Application::$app->db;
                    $statement = $db->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :$uniqueAttr");
                    $statement->bindValue(":$uniqueAttr", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if ($record) {
                        $this->addErrorForByRule($attribute, self::RULE_UNIQUE);
                    }
                }
            }
        }
        return empty($this->errors);
    }
    public function updatevalidate(){
        foreach($this->updaterules() as $attribute => $rules)
        {
            $value = $this->{$attribute};
            foreach ($rules as $rule) 
            {
                $ruleName = $rule;
                if (!is_string($rule)) 
                {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value) 
                {
                    $this->addErrorForByRule($attribute, self::RULE_REQUIRED);
                }
            }
        }
        return empty($this->errors);
    }

    public function errorMessages()
    {
        return  [
            self::RULE_REQUIRED => 'This field is required.',
            self::RULE_EMAIL => 'This field must be valid email address.',
            self::RULE_MIN => 'Min lenght of this field must be {min} characters.',
            self::RULE_MAX => 'Max lenght of this field must be {max} characters.',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_UNIQUE => 'Record with this {field} alredy exists',
        ];
    }

    public function errorMessage($rule)
    {
        return $this->errorMessages()[$rule];
    }

    protected function addErrorForByRule(string $attribute, string $rule, $params = [])
    {
        $params['field'] ??= $attribute;
        $errorMessage = $this->errorMessage($rule);
        foreach ($params as $key => $value) {
            $errorMessage = str_replace("{{$key}}", $value, $errorMessage);
        }
        $this->errors[$attribute][] = $errorMessage;
    }

    public function addError(string $attribute, string $message)
    {
        $this->errors[$attribute][] = $message;
    }

    public  function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        $errors = $this->errors[$attribute] ?? [];
        return $errors[0] ?? '';
    }

}