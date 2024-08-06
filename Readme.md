# PHP Application for Representing Sales

- In this project, I will build a PHP project that has the sales records that come from the MySQL database.

- Project Structure:

1. config/config.php - This is the configuration file for database connection
2. models/Sales.php - Model to handle database operations (Insert and Filter data)
3. views/filter.php - view to display the filter form and results
4. public/index.php - Entry point of the app
5. public/sales_data.json - JSON file containing the sales data
6. init/setup.php - Initialization script for setting up the DB

- Database

- The MySQL database will have one table for now, called sales. This will contain information such as:
  1. Customer name
  2. Customer email
  3. Product name
  4. Product price
  5. Sale date
