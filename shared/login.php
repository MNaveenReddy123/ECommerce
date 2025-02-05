<?php
session_start(); // Start the session
$_SESSION["login_status"] = false;

// Establish the connection
$conn = new mysqli("localhost", "root", "", "acmegrade", 3307);

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$query = "SELECT * FROM user WHERE username = '$_POST[username]' AND password = '$_POST[password]'";

// Print the query for debugging
echo $query;

$sql_result = mysqli_query($conn, $query);
echo "<br>";
print_r($sql_result);

if (mysqli_num_rows($sql_result) > 0) {
    // Fetch the result into an associative array
    $dbrow = mysqli_fetch_assoc($sql_result);

    echo "Login success";

    // Set session variables
    $_SESSION["login_status"] = true;
    $_SESSION['username'] = $dbrow['username'];
    $_SESSION['usertype'] = $dbrow['usertype'];
    $_SESSION['user_id'] = $dbrow['user_id'];

    // Debugging purposes - Print the fetched data
    echo "<br>";
    print_r($dbrow);

    // Redirect based on usertype
    if ($dbrow['usertype'] == "vendor") {
        header("Location: ../vendor/home.php");
        exit();
    } else if ($dbrow['usertype'] == 'customer') {
        echo "Inside customer";
        header("Location: ../customer/home.php");
        exit();
    }
} else {
    echo "Login failed";
}

// Close the connection
$conn->close();
?>
