<?php

namespace app\models;

use app\core\DbModel;


class CustomerModel extends DbModel
{
    
    public string $firstname = "";
    public string $lastname = "";
    public string $gender = "";

    public string $city = "";
    public string $province = "";
    public string $postal_code = "";
    public string $address = "";
    public string $phone_number = "";

    public string $email = "";
    public string $password = "";
    public string $confirmPassword = "";

    public string $captcha = "";
    public string $pass_prase = "";

    public function __construct()
    {
        $this->pass_prase = $_SESSION['pass_phrase'];
    }

    public function register()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        return $this->save();
    }

    public function updateProfile()
    {
        // return $this->update();
    }

    public static function tableName(): string
    {
        return 'customers';
    }

    public function attributes(): array
    {
        return ['firstname', 'lastname', 'gender', 'password', 'email', 'province', 'address', 'postal_code', 'phone_number', 'city'];
    }

    public function updateAttributes(): array
    {
        return ['firstname', 'lastname', 'gender', 'password', 'email', 'province', 'address', 'postal_code', 'phone_number', 'city'];
    }
      

    public function Rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'gender' => [self::RULE_REQUIRED],
            'city' => [self::RULE_REQUIRED],
            'province' => [self::RULE_REQUIRED],
            'postal_code' => [self::RULE_REQUIRED],
            'address' => [self::RULE_REQUIRED],
            'phone_number' => [self::RULE_REQUIRED, self::RULE_NUMBER, [self::RULE_MIN, 'min' => 11], [self::RULE_MAX, 'max' => 11]],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 20]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
            'captcha' => [self::RULE_REQUIRED, [self::RULE_CAPTCHA, 'match' => 'pass_prase']],
        ];
    }

    public static function primaryKey(): string
    {
        return 'customer_id';
    }

    public function getDisplayName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}