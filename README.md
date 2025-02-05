# E-Commerce Website

## Overview
This is a simple E-Commerce website built using HTML, Bootstrap for the frontend, and PHP with MySQL for the backend. The project is structured into three main folders:
- **Customer**: Contains files related to the customer-side functionalities.
- **Vendor**: Includes vendor-related features for product management.
- **Shared**: Contains common files used by both customers and vendors.

## Features
### Customer Features:
- User registration and login
- Product browsing and search
- Add to cart and checkout functionality
- Order history tracking

### Vendor Features:
- Vendor registration and login
- Product addition, editing, and removal
- Order management

### Admin Features (if applicable):
- Managing users and vendors
- Monitoring orders and transactions

## Installation Guide
### Prerequisites:
- PHP (>=7.4 recommended)
- MySQL database
- Apache server (XAMPP, LAMP, or WAMP recommended)

### Steps to Set Up:
1. Clone the repository:
   ```sh
   git clone https://github.com/MNaveenReddy123/ECommerce.git
   ```
2. Move the project folder to your web server directory (e.g., `htdocs` for XAMPP).
3. Import the database:
   - Locate the `database.sql` file in the repository.
   - Open phpMyAdmin and create a new database (e.g., `ecommerce`).
   - Import the SQL file into the database.
4. Configure database connection:
   - Open the `db_connection.php` or equivalent file in the `shared` folder.
   - Update database credentials (host, username, password, database name).
5. Start Apache and MySQL in XAMPP/WAMP.
6. Open the project in a browser:
  

## Usage
- **Customers** can browse products, add them to the cart, and complete purchases.
- **Vendors** can log in, manage products, and track orders.
- **Admin** (if implemented) can manage users, vendors, and orders.

## Technologies Used
- **Frontend**: HTML, Bootstrap, JavaScript
- **Backend**: PHP, MySQL
- **Database**: MySQL

## License
This project is licensed under the MIT License.

