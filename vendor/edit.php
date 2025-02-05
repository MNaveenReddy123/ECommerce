<?php
include "../shared/connection.php";
include "authguard.php";
include "menu.html";
$pid = $_GET['pid'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <form action="update_product.php" method="post" class="w-50 bg-warning p-4" enctype="multipart/form-data">
            <h4 class="text-center">Update Product</h4>
            <input class="form-control mt-3" type="text" name="pname" placeholder="New Product Name">
            <input class="form-control mt-2" type="number" name="pprice" placeholder="New Product Price">
            <textarea class="form-control mt-3" name="pdetail" rows="3" placeholder="New Product Description"></textarea>
            <label for="img">Add new image?</label>
            <input class="form-control mt-2" name="pdtimg" type="file" accept=".jpg,.png,.jpeg" id="img">
            
            <!-- Correct hidden input for pid -->
            <input type="hidden" name="pid" value="<?php echo $pid; ?>"><br>
            <button class="btn btn-danger">Submit</button>
        </form>
    </div>
</body>
</html>
