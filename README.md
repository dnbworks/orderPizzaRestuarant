
# pizza websites

This is a pizza order website. It follows MVC design and REST for data retrieval. 
This website has the following features.

1. user authentication
2. storing orders in the database
3. keeping track of customer orders
4. Has CMS to manage products and orders for customers.

## Installation

1. Download the archive or clone the project using git
2. Create database schema
3. Create `.env` file from `.env.example` file and adjust database parameters (including schema name)
4. Run `composer install`
5. Run migrations by executing `php migrations.php` from the project root directory
6. Go to the `public` folder  `cd public`
7. Start php server by running           command `php -S 127.0.0.1:8080` 
8. Open in browser http://127.0.0.1:8080