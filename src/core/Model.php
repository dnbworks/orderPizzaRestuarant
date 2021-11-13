<?php

namespace app\core;

abstract class Model {
   const RULE_REQUIRED = 'required';
   const RULE_EMAIL = 'email';
   const RULE_MIN = 'min';
   const RULE_MAX = 'max';
   const RULE_MATCH = 'match';
   const RULE_UNIQUE = 'unique';
   const RULE_OPTIONAL = 'optional';

   public array $errors = [];

   public function loadData($data)
   {
       foreach($data as $key => $value){
           if(property_exists($this, $key)){
            $this->{$key} = $value;
           }
       }
    //    return [
    //        'firstname' => $this->firstname,
    //        'lastname' => $this->lastname,
    //        'email' => $this->email,
    //        'gender' => $this->gender,
    //        'province' => $this->province,
    //        'postal_code' => $this->postal_code,
    //        'address' => $this->address,
    //        'phone_number' => $this->phone_number,
    //        'password' => $this->password
    //    ];

   }

   abstract function Rules(): array;

   public function validate()
   {
       
       foreach($this->Rules() as $attribute => $rules){
           $value = $this->{$attribute};
    
            foreach($rules as $rule){
                $ruleName = $rule;

                if(!is_string($rule)){
                    $ruleName = $rule[0];
                }
                // echo $ruleName . "<br>";
                // echo $value . "<br>";
              
                if($ruleName === self::RULE_REQUIRED && !$value){
                    $this->addErrorForRule($attribute, self::RULE_REQUIRED);
                }
                // evaluate the value of it is a valid email
                if($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)){
                    $this->addErrorForRule($attribute, self::RULE_EMAIL);
                }
                // checks whether the value passes the required min length
                if($ruleName === self::RULE_MIN && strlen($value) < $rule['min']){
                    $this->addErrorForRule($attribute, self::RULE_MIN, $rule);
                }
                // checks whether the value surpasses the required max length
                if($ruleName === self::RULE_MAX && strlen($value) > $rule['max']){
                    $this->addErrorForRule($attribute, self::RULE_MAX, $rule);
                }
                // checks whether the password matches the confirm password
                if($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']}){
                    $this->addErrorForRule($attribute, self::RULE_MATCH, $rule);
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
                        $this->addErrorForRule($attribute, self::RULE_UNIQUE, ['field' => $attribute]);
                    }
                }
            } 
       }

       return empty($this->errors);
   }

   public function errorMessages()
   {
       return [
        self::RULE_REQUIRED => 'This field is required',
        self::RULE_EMAIL => 'This field must be a valid email',
        self::RULE_MIN => 'Min length of this field must be {min}',
        self::RULE_MAX => 'Min length of this field must be {max}',
        self::RULE_MATCH => 'This field must be the same as {match}',
        self::RULE_UNIQUE => 'Record with this {field} already exists',
       ];
   }

   private function addErrorForRule(string $attribute, string $rule, $params = [])
   {
        $errorMessage = $this->errorMessages()[$rule] ?? "";
        // replace the placeholder {max/min} with the actual number
        foreach($params as $key => $value){
            $errorMessage = str_replace("{{$key}}", $value, $errorMessage);
        }

        $this->errors[$attribute][] = $errorMessage;
   }

   public function addError(string $attribute, string $message)
   {
        $this->errors[$attribute][] = $message;
   }

   public function hasError($attribute)
   {
       return $this->errors[$attribute] ?? false;
   }

   public function getFirstError($attribute)
   {
       $errors = $this->errors[$attribute] ?? [];
       return $errors[0] ?? '';
   }
}