<?php

namespace app\models;

use app\core\DbModel;


class UserModel extends DbModel
{
    
    public string $firstname = "";
    public string $lastname = "";
    public string $gender = "";
    public string $day = "";
    public string $month = "";
    public string $year = "";
    public string $city = "";
    public string $state = "";
    // public string $picture = "";
    // public array $pictureArray = [];
    public string $old_image = "";
    public string $email = "";
    public string $password = "";
    public string $confirmPassword = "";
    public string $birthdate = "";




    public function register()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        // $this->birthdate =  $this->month . "-" . $this->day . "-" . $this->year;
        // echo $this->password;
        // exit;
        return $this->save();
    }

    public function updateProfile()
    {
        return $this->update();
    }

    public static function tableName(): string
    {
        return 'mismatch_users';
    }

    public function attributes(): array
    {
        return ['firstname', 'lastname', 'gender', 'password', 'birthdate', 'email', 'state', 'city'];
    }

    public function updateAttributes(): array
    {
        return ['firstname', 'lastname', 'gender', 'birthdate', 'state', 'city', 'picture'];
    }
      

    public function Rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'gender' => [self::RULE_REQUIRED],
            'day' => [self::RULE_REQUIRED],
            'month' => [self::RULE_REQUIRED],
            'year' => [self::RULE_REQUIRED],
            'city' => [self::RULE_REQUIRED],
            'state' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 20]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    public static function primaryKey(): string
    {
        return 'user_id';
    }

    public function getDisplayName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}