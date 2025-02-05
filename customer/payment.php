<?php
include "authguard.php";
include "../shared/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order_id = $_POST['order_id'];
    $payment_method = $_POST['payment_method'];
    $amount = $_POST['amount'];

    // Insert into payments table
    $payment_insert_query = "INSERT INTO payments (order_id, amount, payment_date, payment_method, payment_status) 
                             VALUES ($order_id, $amount, NOW(), '$payment_method', 'pending')";
    mysqli_query($conn, $payment_insert_query);

    // Update order status to 'paid'
    $update_order_query = "UPDATE orders SET order_status = 'paid' WHERE order_id = $order_id";
    mysqli_query($conn, $update_order_query);

    echo "<div class='success-message' id='successMessage'>Payment successful!</div>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .success-message {
            display: none;
            padding: 20px 40px;
            background-color: #4caf50;
            color: white;
            font-size: 1.5em;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 1s forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const message = document.getElementById('successMessage');
            message.style.display = 'block';
        });
    </script>";
    // Optionally, you can redirect or display a success message
} else {
    if (isset($_GET['order_id']) && is_numeric($_GET['order_id'])) {
        $order_id = $_GET['order_id'];

        // Retrieve order details
        $order_query = "SELECT o.*, p.price FROM orders o 
                        JOIN product p ON o.pid = p.pid 
                        WHERE o.order_id = $order_id AND o.user_id = $_SESSION[user_id]";
        $order_result = mysqli_query($conn, $order_query);

        if (mysqli_num_rows($order_result) > 0) {
            $order_row = mysqli_fetch_assoc($order_result);
            $total_amount = $order_row['price'];

            // Display payment form
            echo "<html>
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
                                height: 100vh;
                            }
                            .auth-info {
                                position: fixed;
                                top: 10px;
                                left: 10px;
                                background-color: #007bff;
                                color: white;
                                padding: 10px;
                                border-radius: 5px;
                            }
                            .payment-form {
                                background-color: #ffffff;
                                padding: 20px;
                                border-radius: 10px;
                                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                                max-width: 400px;
                                width: 100%;
                                text-align: center;
                            }
                            .payment-form h2 {
                                text-align: center;
                                color: #333333;
                                margin-bottom: 20px;
                            }
                            .payment-form label {
                                color: #333333;
                                display: block;
                                margin-bottom: 5px;
                                font-weight: bold;
                                text-align: left;
                            }
                            .payment-form select,
                            .payment-form input[type='text'] {
                                width: calc(100% - 20px);
                                padding: 10px;
                                margin-bottom: 20px;
                                border: 1px solid #cccccc;
                                border-radius: 5px;
                                transition: border-color 0.3s;
                            }
                            .payment-form select:focus,
                            .payment-form input[type='text']:focus {
                                border-color: #6666ff;
                                outline: none;
                            }
                            .payment-form input[type='submit'] {
                                width: 100%;
                                padding: 10px;
                                background-color: #4CAF50;
                                border: none;
                                border-radius: 5px;
                                color: white;
                                font-size: 16px;
                                cursor: pointer;
                                transition: background-color 0.3s;
                            }
                            .payment-form input[type='submit']:hover {
                                background-color: #45a049;
                            }
                            .success-message {
                                background-color: #4CAF50;
                                color: white;
                                padding: 10px;
                                border-radius: 5px;
                                text-align: center;
                                margin-top: 20px;
                            }
                        </style>
                    </head>
                    <body>
                        <div class='auth-info'>
                            <div>$_SESSION[user_id]</div>
                            <div>$_SESSION[username]</div>
                            <div>$_SESSION[login_status]</div>
                            <a class='text-white' href='../shared/logout.php'>LOGOUT</a>
                        </div>
                        <div class='payment-form'>
                            <h2>Payment Details</h2>
                            <form method='post' action='payment.php'>
                                <input type='hidden' name='order_id' value='$order_id'>
                                <label for='payment_method'>Select Payment Method:</label>
                                <select id='payment_method' name='payment_method' required>
                                    <option value='credit_card'>Credit Card</option>
                                    <option value='debit_card'>Debit Card</option>
                                    <option value='paypal'>PayPal</option>
                                </select>
                                <label for='amount'>Amount:</label>
                                <input type='text' id='amount' name='amount' value='$total_amount' readonly>
                                <input type='submit' value='Pay Now'>
                            </form>
                        </div>
                    </body>
                </html>";
        } else {
            echo "Error: Order not found or does not belong to the current user.";
        }
    } else {
        echo "Invalid request.";
    }
}
?>