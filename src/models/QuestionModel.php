<?php

namespace app\models;

use app\core\DbModel;


class QuestionModel extends DbModel
{
    public static $responses;
    
    public static function tableName(): string
    {
        return 'mismatch_response';
    }

    public function updateAttributes(): array
    {
        return [];
    }

    public function attributes(): array
    {
        return ['Appearance', 'Entertainment', 'Food', 'People', 'Activity'];
    }
      

    public function Rules(): array
    {
        return [
            'Appearance' => [],
            'Food' => [],
            'Entertainment' => [self::RULE_REQUIRED],
            'Activity' => [self::RULE_REQUIRED],
            'People' => [self::RULE_REQUIRED],
    
        ];
    }

    public static function primaryKey(): string
    {
        return 'user_id';
    }

    public function register()
    {
        foreach($_POST as $response_id => $response){
            $sql = "UPDATE `mismatch_response` SET `response`= '$response' WHERE response_id = '$response_id'";
            $statement = self::prepare($sql);
            $statement->execute();
        }
        
        return true;
    }

   
}