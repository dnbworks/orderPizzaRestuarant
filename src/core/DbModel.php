<?php

namespace app\core;

use app\core\Model;

abstract class DbModel extends Model{
    abstract public static function tableName(): string;

    abstract public function attributes(): array;
    abstract public function updateAttributes(): array;

    abstract public static function primaryKey(): string;

    

    public function save(){
        $tableName = $this->tableName();
       
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);

        // echo '<pre>';
        // var_dump($attributes);
        // echo '</pre>';
        // exit;

        $statement = self::prepare("INSERT INTO $tableName (". implode(",", $attributes).") VALUES (". implode(",", $params).");");


        foreach($attributes as $attribute){
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();

       return true;
        
    }


    public function update($attributes){
        $tableName = $this->tableName();
       
        $attributes = $attributes;
        $params = array_map(fn($attr) => "$attr = :$attr ", $attributes);

      

        $sql = "UPDATE $tableName SET " . implode(',', $params) . "WHERE user_id = '".Application::$app->user->user_id."'";

           //    echo '<pre>';
    //     var_dump( $params);
    //     echo '</pre>';

        // echo $sql;
        // exit;

        $statement = self::prepare($sql);


        foreach($attributes as $attribute){
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();

       return true;

 

        
    }

    public static function findOne($where)
    {
        $tableName =  static::tableName();
        $attributes = array_keys($where);

        $sql = implode("AND ", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");

     
        foreach($where as $key => $item){
            $statement->bindValue(":$key", $item);
        }


        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    public static function findAll()
    {
        $tableName =  static::tableName();

        $statement = self::prepare("SELECT user_id, firstname, lastname, gender, birthdate, city, state, picture FROM $tableName");

        $statement->execute();
        return $statement->fetchAll();
  
    }

    public static function getQuestions($where)
    {
        $tableName =  static::tableName();
        
        $sql = "SELECT * FROM $tableName WHERE user_id = '" . $where['user_id'] . "'";
        
        $statement = self::prepare($sql);

        $statement->execute();
        $questions = $statement->fetchAll();


        if(count($questions) == 0){
            $topicIds = array();
            $query = "SELECT topic_id FROM mismatch_topic ORDER BY topic_id";
            $statement = self::prepare($query);

            $statement->execute();
            $topics = $statement->fetchAll();

            foreach($topics as $topic){
                array_push($topicIds, $topic['topic_id']);
            }
     
        
            foreach($topicIds as $topicId){
        
                $sql = "INSERT INTO $tableName (`user_id`, `topic_id`) VALUES ('". $where['user_id'] ."', '$topicId') ";
                $statement = self::prepare($sql);
                $statement->execute();
        
            }
        }

        $sql = "SELECT mr.response_id, mr.topic_id, mr.response, mt.name AS topic_name, mc.name AS topic_category FROM $tableName AS mr INNER JOIN mismatch_topic AS mt USING(topic_id) INNER JOIN mismatch_category AS mc USING(category_id) WHERE mr.user_id ='" . $where['user_id'] . "'";

        $statement = self::prepare($sql);

        $statement->execute();
        $responseResults = $statement->fetchAll();

        $responses = array();

        foreach($responseResults as $result){
            array_push($responses, $result);
        }

     
        return [
            'responses' => $responses,
            'responseCount' => count($questions)
        ];

  
    }

    public static function prepare($sql){
        return Application::$app->db->pdo->prepare($sql);
    }
}