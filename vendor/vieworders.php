<html>
    <head>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }

            .container {
                width: 90%;
                max-width: 1200px;
                margin: 20px auto;
            }

            .pdt_card {
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                padding: 20px;
                margin-bottom: 20px;
                transition: transform 0.3s ease;
            }

            .pdt_card:hover {
                transform: scale(1.02);
            }

            .pdt_card div {
                margin-bottom: 10px;
            }

            .pdt_card strong {
                color: #333;
            }

            .pdt_card .order_id {
                font-size: 1.2em;
                font-weight: bold;
                color: #2a9d8f;
            }

            .pdt_card .product_name {
                font-size: 1.1em;
                color: #e76f51;
            }

            .pdt_card .status {
                font-size: 1.1em;
                font-weight: bold;
                color: #264653;
            }

            /* Button styling */
            .pdt_card button {
                background-color: #2a9d8f;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .pdt_card button:hover {
                background-color: #21867a;
            }

            /* Mobile responsiveness */
            @media (max-width: 768px) {
                .pdt_card {
                    padding: 15px;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <?php
            include "authguard.php";
            include "../shared/connection.php";

            // Ensure the user is a vendor
            if ($_SESSION['login_status'] != 'vendor') {
                echo "Access denied.";
                exit;
            }

            // Get the vendor_id from the session
            $vendor_id = $_SESSION['user_id'];

            $order_query = "SELECT o.*, p.name AS product_name FROM orders o 
                            JOIN product p ON o.pid = p.pid 
                            WHERE p.owner = $vendor_id 
                            ORDER BY o.order_id DESC";
            $result = mysqli_query($conn, $order_query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='pdt_card'>
                            <div class='order_id'><strong>Order ID:</strong> $row[order_id]</div>
                            <div><strong>Product ID:</strong> $row[pid]</div>
                            <div class='product_name'><strong>Product Name:</strong> $row[product_name]</div>
                            <div><strong>Name:</strong> $row[name]</div>
                            <div><strong>Mobile Number:</strong> $row[mobilenumber]</div>
                            <div><strong>Address:</strong> $row[address]</div>
                            <div><strong>Email:</strong> $row[email]</div>
                            <div><strong>Order Date:</strong> $row[order_date]</div>
                            <div class='status'><strong>Order Status:</strong> $row[order_status]</div>
                          </div>
                          </br>";
                }
            } else {
                echo "No orders found.";
            }
            ?>
        </div>
    </body>
</html>
