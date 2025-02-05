<?php
include "authguard.php";
include "../shared/connection.php";
include "menu.html";

// Fetch all products from the database
$sql_result = mysqli_query($conn, "select * from product where owner=$_SESSION[user_id]");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card {
            margin: 20px 0;
            background-color: #FFFFF7;
            border-radius: 20px;
        }
        .product-img {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }
    </style>
    
</head>
<body>
    <div class="container">
        <div class="row">
            <?php
            // Loop through each product and display its details in a Bootstrap card
            while ($dbrow = mysqli_fetch_assoc($sql_result)) {
            ?>
                <div class="col-md-4">
                    <div class="card product-card">
                        <img src="<?php echo $dbrow['impath']; ?>" class="card-img-top product-img" alt="Product Image">
                        <div class="card-body">
                            <h4 class="card-title"><?php echo $dbrow['name']; ?></h4>
                            <p class="card-text"><?php echo $dbrow['detail']; ?></p>
                            <p class="card-text" style="color:green"><strong>Price:</strong> ₹<?php echo number_format($dbrow['price']); ?></p>
                            
                            <div class="d-flex justify-content-between">
                            <div>   
                                <a href='delete.php?pid=<?php echo $dbrow['pid']; ?>'>
                                    <button class="btn btn-danger">
                                        delete
                                    </button>
                                </a>
                            </div>
                            <div>
                                <a href='edit.php?pid=<?php echo $dbrow['pid']; ?>'>
                                    <button class="btn btn-warning">
                                        Edit
                                    </button>
                                </a>
                            </div>

                                
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
