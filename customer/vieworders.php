<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .order-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            max-width: 600px;
        }

        .order-card div {
            margin-bottom: 10px;
        }

        .order-card strong {
            color: #333;
            font-weight: bold;
        }

        .order-card div:last-child {
            margin-bottom: 0;
        }

        /* Add some responsiveness */
        @media (max-width: 600px) {
            .order-card {
                padding: 15px;
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

<?php
include "authguard.php";
include "../shared/connection.php";

$order_query = "SELECT * FROM orders WHERE user_id = $_SESSION[user_id] ORDER BY order_id DESC";
$result = mysqli_query($conn, $order_query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='order-card'>
                <div><strong>Order ID:</strong> $row[order_id]</div>
                <div><strong>Product ID:</strong> $row[pid]</div>
                <div><strong>Name:</strong> $row[name]</div>
                <div><strong>Mobile Number:</strong> $row[mobilenumber]</div>
                <div><strong>Address:</strong> $row[address]</div>
                <div><strong>Email:</strong> $row[email]</div>
                <div><strong>Order Date:</strong> $row[order_date]</div>
                <div><strong>Order Status:</strong> $row[order_status]</div>
              </div>";
    }
} else {
    echo "No orders found.";
}
?>

</body>
</html>
