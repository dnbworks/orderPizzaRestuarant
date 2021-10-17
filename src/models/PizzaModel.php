<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;

class PizzaModel 
{
    public function offer(): array
    {
        $sql = " SELECT p.product_id, p.title, p.description, p.price, p.img, c.name AS category FROM products AS p INNER JOIN category AS c ON c.id = p.category_id INNER JOIN offers USING (product_id)";
        $statement = self::prepare($sql);
        
        $statement->execute();
        $result = $statement->fetchAll();

   
        return [
            'data' => $result
        ];
     
    }

    public function read(string|int $category): array
    {
        $sql = "SELECT * FROM products WHERE featured = '"  . (int) $category . "'";
        $statement = self::prepare($sql);
        
        $statement->execute();
        $result = $statement->fetchAll();

        
        function type($type){
            switch ($type) {
                case 1:
                    $category = 'Special Offers';
                    break;
                case 2;
                    $category = 'Pizza';
                    break;
                case 3:
                    $category = 'Pasta';
                    break;
                case 4:
                    $category = 'Group Meals';
                    break;
                case 5:
                    $category = 'Solo Meals';
                    break;
                case 6:
                    $category = 'Chicken';
                    break;
                case 7:
                    $category = 'Drinks';
                    break;
            }

            return $category;
        }
        return [
            'type' => type($category),
            'data' => $result
        ];
     
    }

    public function getType(string $type): array
    {
        $sql = "";
      
        if($type == 'Special Offers'){
            $sql = "SELECT p.product_id, p.title, p.description, p.price, p.img, c.name AS category FROM products AS p INNER JOIN category AS c ON c.id = p.category_id INNER JOIN offers USING (product_id)";
        } else {
            $sql =  "SELECT p.product_id, p.title, p.description, p.price, p.img, c.name AS category FROM products AS p INNER JOIN category AS c ON c.id = p.category_id WHERE c.name ='" . $type . "'";
        }

    
        $statement = self::prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        return [
            'data' => $result,
            'sql' => $sql
        ];
    }

    public function findOne(string $type, string $name): array
    {
       
        $sql = "SELECT  p.product_id, p.title, p.description, p.price, p.img, c.name AS category FROM products AS p INNER JOIN category AS c ON c.id = p.category_id WHERE p.title = '" . $name . "'" .  " AND c.name ='" .$type . "'";

        $statement = self::prepare($sql);
        
        $statement->execute();
        $result = $statement->fetchAll();

        return $result;
       
    }

    public function getById(int $id): array
    {
       
        $sql = "SELECT  p.product_id, p.title, p.price, p.img, c.name AS category FROM products AS p INNER JOIN category AS c ON c.id = p.category_id WHERE p.product_id ='" . $id . "'";

        $statement = self::prepare($sql);
        
        $statement->execute();
        $result = $statement->fetchAll();

        return $result;
       
    }

    public function edit()
    {
        
    }

    public function create()
    {
        
    }

    public function delete()
    {
        
    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }

  
}

// SELECT p.product_id, p.title, p.description, p.price, p.img, c.name AS category FROM products AS p INNER JOIN category AS c ON c.id = p.category_id INNER JOIN offers USING (product_id);

// SELECT p.product_id, p.title, p.description, p.price, p.img, c.name AS category FROM products AS p INNER JOIN category AS c ON c.id = p.category_id WHERE c.name = 'pizza' OR p.featured = '1';