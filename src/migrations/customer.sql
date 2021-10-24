

 CREATE TABLE `customers` (
    `customer_id` int(11) NOT NULL UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `email` varchar(200) NOT NULL UNIQUE,
    `password` varchar(255) NOT NULL,
    `join_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `firstname` varchar(100) NOT NULL,
    `lastname` varchar(100) NOT NULL,
    `gender` char(1) NOT NULL,
    `city` varchar(100) NOT NULL,
    `province` varchar(10) NOT NULL,
    `postal_code` varchar(4) NOT NULL,
    `mobile_number` varchar(11) NOT NULL UNIQUE
    `access_updates` BOOLEAN DEFAULT 0; 
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



 CREATE TABLE `orders` (
    `order_id` int(11) NOT NULL UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `Delivery_method` int(11) NOT NULL,
    `customer_id` int(11) NOT NULL,
    `payment_method` int(11) NOT NULL,
    `ordered_item_id` int(11) NOT NULL,
    `order_status` int(11) NOT NULL,
     CONSTRAINT FOREIGN KEY(`Delivery_method`) REFERENCES Delivery(`Delivery_id`) ON DELETE SET NULL,
     CONSTRAINT FOREIGN KEY(`payment_method`) REFERENCES payment(`payment_id`) ON DELETE SET NULL
     CONSTRAINT FOREIGN KEY(`customer_id`) REFERENCES customers(`customer_id`) ON DELETE SET NULL
    
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `payment` (
    `payment_id` int(11) NOT NULL UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `payment_method` varchar(255) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
// cash on delivery
// debit card
// credit card
// paypal

CREATE TABLE `delivery` (
    `delivery_id` int(11) NOT NULL UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `delivery_method` varchar(255) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

// home delivery
// stationed delivery

order status
// processing






checkout output
order number
