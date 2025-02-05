<?php
include "authguard.php";
include "../shared/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $mobile_number = $_POST['mobile_number'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    
    // Insert into orders table
    $order_insert_query = "INSERT INTO orders (user_id, pid, name, mobilenumber, address, email, order_date, order_status) 
                           VALUES ($_SESSION[user_id], $pid, '$name', '$mobile_number', '$address', '$email', NOW(), 'pending')";
    mysqli_query($conn, $order_insert_query);
    $order_id = mysqli_insert_id($conn);

    // Redirect to payment page with order_id
    header("Location: payment.php?order_id=$order_id");
    exit();
} else {
    if (isset($_GET['cartid']) && is_numeric($_GET['cartid'])) {
        $cartid = $_GET['cartid'];

        // Retrieve cart details
        $cart_query = "SELECT * FROM cart JOIN product ON cart.pid = product.pid WHERE cartid = $cartid AND userid = $_SESSION[user_id]";
        $cart_result = mysqli_query($conn, $cart_query);

        if (mysqli_num_rows($cart_result) > 0) {
            $cart_row = mysqli_fetch_assoc($cart_result);

            // Display order form
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
        .order-form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .order-form h2 {
            text-align: center;
            color: #333333;
            margin-bottom: 20px;
        }
        .order-form label {
            color: #333333;
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .order-form input[type='text'],
        .order-form input[type='email'],
        .order-form textarea {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #cccccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }
        .order-form input[type='text']:focus,
        .order-form input[type='email']:focus,
        .order-form textarea:focus {
            border-color: #6666ff;
            outline: none;
        }
        .order-form input[type='submit'] {
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
        .order-form input[type='submit']:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class='order-form'>
        <h2>Order Details</h2>
        <form method='post' action='place_order.php'>
            <input type='hidden' name='pid' value='$cart_row[pid]'>
            <label for='name'>Name:</label>
            <input type='text' id='name' name='name' required><br>
            <label for='mobile_number'>Mobile Number:</label>
            <input type='text' id='mobile_number' name='mobile_number' required><br>
            <label for='address'>Address:</label>
            <textarea id='address' name='address' rows='3' required></textarea><br>
            <label for='email'>Email ID:</label>
            <input type='email' id='email' name='email' required><br>
            <input type='submit' value='Proceed to Payment'>
        </form>
    </div>
</body>
</html>
";
        } else {
            echo "Error: Cart item not found or does not belong to the current user.";
        }
    } else {
        echo "Invalid request.";
    }
}
?>