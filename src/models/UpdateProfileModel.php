<?php

namespace app\models;

use app\core\DbModel;


class UpdateProfileModel extends DbModel
{
    
    public string $firstname = "";
    public string $lastname = "";
    public string $gender = "";
    public string $day = "";
    public string $month = "";
    public string $year = "";
    public string $city = "";
    public string $state = "";
    public $picture = "";
    public array $pictureArray = [];
    public string $old_image = "";
    public string $birthdate = "";



    public function updateProfile($attributes)
    {
        $this->birthdate =  $this->month . "/" . $this->day . "/" . $this->year;
        return $this->update($attributes);
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
            'state' => [self::RULE_REQUIRED]
        ];
    }

    public static function primaryKey(): string
    {
        return 'user_id';
    }

}