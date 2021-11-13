<?php

// creating all four tables
class m0001_initial
{
    public function up()
    {
        $db = \app\core\Application::$app->db;
        $sql = "CREATE TABLE `mismatch_category` (
            `category_id` int(11) NOT NULL,
            `name` varchar(100) DEFAULT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
          
          INSERT INTO `mismatch_category` (`category_id`, `name`) VALUES
            (1, 'Appearance'),
            (2, 'Entertainment'),
            (3, 'Food'),
            (4, 'People'),
            (5, 'Activities');

            CREATE TABLE `mismatch_response` (
            `response_id` int(11) NOT NULL,
            `response` varchar(4) DEFAULT '0',
            `user_id` int(11) DEFAULT NULL,
            `topic_id` int(11) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            
            CREATE TABLE `mismatch_topic` (
            `topic_id` int(11) NOT NULL,
            `name` varchar(100) DEFAULT NULL,
            `category_id` int(11) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            INSERT INTO `mismatch_topic` (`topic_id`, `name`, `category_id`) VALUES
            (1, 'Tattoos', 1),
            (2, 'Gold chains', 1),
            (3, 'Body piercing', 1),
            (4, 'Cowboys boots', 1),
            (5, 'Long hair', 1),
            (6, 'Reality TV', 2),
            (7, 'Professional wrestling', 2),
            (8, 'Horror movies', 2),
            (9, 'Easy listening music', 2),
            (10, 'The opera', 2),
            (11, 'Sushi', 3),
            (12, 'Spam', 3),
            (13, 'spicy food', 3),
            (14, 'Peanut butter & banana sandwiches', 3),
            (15, 'Martinis', 3),
            (16, 'Howard Stern', 4),
            (17, 'Barbara Sterisand', 4),
            (18, 'Bill Gates', 4),
            (19, 'Hugh Hefner', 4),
            (20, 'Martha Stewart', 4),
            (21, 'Yoga', 5),
            (22, 'Weightlifting', 5),
            (23, 'Cube puzzle', 5),
            (24, 'Karaoke', 5),
            (25, 'Hiking', 5);

            CREATE TABLE `mismatch_users` (
            `user_id` int(11) NOT NULL,
            `email` varchar(200) DEFAULT NULL,
            `password` varchar(255) DEFAULT NULL,
            `join_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
            `firstname` varchar(60) DEFAULT NULL,
            `lastname` varchar(60) DEFAULT NULL,
            `gender` char(1) DEFAULT NULL,
            `birthdate` varchar(200) DEFAULT NULL,
            `city` varchar(60) DEFAULT NULL,
            `state` varchar(4) DEFAULT NULL,
            `picture` varchar(100) DEFAULT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

            ALTER TABLE `mismatch_category`
            ADD PRIMARY KEY (`category_id`);

            ALTER TABLE `mismatch_response`
            ADD PRIMARY KEY (`response_id`);

            ALTER TABLE `mismatch_topic`
            ADD PRIMARY KEY (`topic_id`),
            ADD KEY `fk_mismatch_topic_topic_id` (`category_id`);

            ALTER TABLE `mismatch_users`
            ADD PRIMARY KEY (`user_id`);

            ALTER TABLE `mismatch_category`
            MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

            ALTER TABLE `mismatch_response`
            MODIFY `response_id` int(11) NOT NULL AUTO_INCREMENT;

            ALTER TABLE `mismatch_topic`
            MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

            ALTER TABLE `mismatch_users`
            MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

            ADD CONSTRAINT `fk_mismatch_topic_topic_id` FOREIGN KEY (`category_id`) REFERENCES `mismatch_category` (`category_id`);
          ";
        
        $db->pdo->exec($sql);

    }

    public function down()
    {
        $db = \app\core\Application::$app->db;
        $sql = "DROP TABLE mismatch_users, mismatch_topic, mismatch_response, mismatch_category;";
        $db->pdo->exec($sql);
    }
}