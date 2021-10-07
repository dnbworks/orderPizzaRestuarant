<?php

namespace app\models;

use app\core\Application;
use app\helpers\Graph;

class MismatchModel {


    public static function fetchResponse()
    {
        $errors = [];
        $data = [];

        // only look for a mismatch if the user has answers questionnaire responds
        $sql = "SELECT * FROM mismatch_response WHERE user_id = '"  . Application::$app->user->user_id . "'";
        $statement = self::prepare($sql);
        
        $statement->execute();
        $responses = $statement->fetchAll();

        // if response count isn't 0 that means he answered some or  he answered 0
        if(count($responses) != 0){
            $sql = "SELECT mr.response_id, mr.topic_id, mr.response, mt.name AS topic_name, mc.name AS category_name " .
            "FROM mismatch_response AS mr " .
            "INNER JOIN mismatch_topic AS mt USING (topic_id) " .
            "INNER JOIN mismatch_category AS mc USING (category_id) " .
            "WHERE mr.user_id = '" . Application::$app->user->user_id . "'";

            $statement = self::prepare($sql);
        
            $statement->execute();
            $user_responses = $statement->fetchAll();
           



            // Initialize the mismatch search results
            $mismatch_score = 0;
            $mismatch_user_id = -1;
            $mismatch_topics = array();
            $mismatch_categories = array();

            // select users who aren't logged in
            $sql = "SELECT user_id FROM mismatch_users WHERE user_id != '". Application::$app->user->user_id . "'";
            $statement = self::prepare($sql);
            $statement->execute();
            $members = $statement->fetchAll();

            

            foreach($members as $member){
                $sql = "SELECT response_id, topic_id, response FROM mismatch_response WHERE user_id = '" . $member['user_id'] . "'";
                $statement = self::prepare($sql);
                $statement->execute();
                $mismatch_responses = $statement->fetchAll();

                // Compare each response and calculate a mismatch total
                $score = 0;
                $topics = array();
                $categories = array();

                for ($i = 0; $i < count($user_responses); $i++) { 
                    if(((int)$user_responses[$i]['response'] + (int)$mismatch_responses[$i]['response']) == 3){
                        $score += 1;
                        array_push($topics, $user_responses[$i]['topic_name']);
                        array_push($categories, $user_responses[$i]['category_name']);
                    }
                }

                if($score > $mismatch_score){
                    // we found a better mismatch, so update the mismatch seach results
                    $mismatch_score = $score;
                    $mismatch_user_id = $member['user_id'];
                    $mismatch_topics = array_slice($topics, 0);
                    $mismatch_categories = array_slice($categories, 0);
                }

            } // End of outer foreach loop

        

            if($mismatch_user_id != -1){

                $sql = "SELECT user_id, firstname, lastname, city, state, picture FROM mismatch_users WHERE user_id = '$mismatch_user_id'";
                
                $statement = self::prepare($sql);
                $statement->execute();
                $mismatch_user = $statement->fetchAll();
             
            
                if(count($mismatch_user) == 1){
                   
                    // Calculate the mismatched category totals
                    $category_totals = array(array($mismatch_categories[0], 0));
                    foreach ($mismatch_categories as $category) {
                        if ($category_totals[count($category_totals) - 1][0] != $category) {
                            array_push($category_totals, array($category, 1));
                        }
                        else {
                            $category_totals[count($category_totals) - 1][1]++;
                        }
                    }

                    $data = [
                        'user' => $mismatch_user,
                        'topics' => $mismatch_topics,
                        'category_total' => $category_totals  
                    ];
                   
                        
                    $graph = new Graph(480, 240, $category_totals, 5,  Application::$ROOT_DIR . '/public/uploads/' . Application::$app->user->user_id . '-mymismatchgraph.png');
                
                    $graph->createGraph();

        
                } else {
                    $errors['errors'][] = 'No user was mismatched to you';
                }
        
            } else {
                $errors['errors'][] = '<p>You must first <a href="/questionaire">answer the questionaire</a> before you can be mismatched</p>';
            }
         
        }

        if(empty($errors)){
            return $data;
            exit;
        }

        return $errors;
    }


    public static function prepare($sql){
        return Application::$app->db->pdo->prepare($sql);
    }
}