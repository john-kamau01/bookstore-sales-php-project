-- Create the database
CREATE DATABASE IF NOT EXISTS bookstore;

-- Switch to the newly created database
USE bookstore;

-- Create the sales table
CREATE TABLE IF NOT EXISTS `sales` (
    `sale_id` INT NOT NULL,
    `customer_name` VARCHAR(255) NOT NULL,
    `customer_mail` VARCHAR(255) NOT NULL,
    `product_name` VARCHAR(255) NOT NULL,
    `product_price` DECIMAL(10, 2) NOT NULL,
    `sale_date` DATETIME NOT NULL,
    PRIMARY KEY (`sale_id`)
);
