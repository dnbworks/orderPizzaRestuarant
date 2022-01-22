

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
    `order_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `delivery_id` int(11) UNSIGNED NOT NULL,
    `customer_id` int(11) UNSIGNED NOT NULL,
    `payment_id` int(11) UNSIGNED NOT NULL DEFAULT 1,
    `pickup_branch_id` int(11) UNSIGNED, 
    `order_status` int(11) UNSIGNED NOT NULL DEFAULT 1,
    `total` decimal(10,2) NOT NULL,
    CONSTRAINT FOREIGN KEY(`pickup_branch_id`) REFERENCES pickup_branches(`pickup_branch_id`) ON UPDATE CASCADE,
     CONSTRAINT FOREIGN KEY(`delivery_id`) REFERENCES delivery(`delivery_id`) ON UPDATE CASCADE,
     CONSTRAINT FOREIGN KEY(`payment_id`) REFERENCES payment(`payment_id`) ON UPDATE CASCADE,
     CONSTRAINT FOREIGN KEY(`customer_id`) REFERENCES customers(`customer_id`) ON UPDATE CASCADE,
     CONSTRAINT FOREIGN KEY(`order_status`) REFERENCES order_statuses(`order_status_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `order_items` (
    `order_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `cart_item_id` int(11) NOT NULL,
    `product_id` tinyint(3) UNSIGNED NOT NULL,
    `quantity` int(11) NOT NULL,
    PRIMARY KEY (`order_id`, `cart_item_id`),
    CONSTRAINT `fk_order_items_order` FOREIGN KEY(`order_id`) REFERENCES orders(`order_id`) ON UPDATE CASCADE,
    CONSTRAINT `fk_order_items_products` FOREIGN KEY(`product_id`) REFERENCES products(`product_id`) ON UPDATE CASCADE
);


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
