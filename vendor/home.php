<?php
include "authguard.php";
include "menu.html";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
    <form action="upload.php" method="post" class="w-50 bg-warning p-4" enctype="multipart/form-data">
      <h4 class="text-center">Upload Product</h4>
      <input class="form-control mt-3" type="text" name="pname" placeholder="Product Name">
      <input class="form-control mt-2" type="number" name="pprice" placeholder="Product Price">
      <textarea class="form-control mt-3" name="pdetail" rows="3" placeholder="Product Description"></textarea>
      <input class="form-control mt-2" name="pdtimg" type="file" accept=".jpg,.png,.jpeg">
      
      <div class="text-center mt-3">
        <button class="btn btn-danger">Upload Product</button>
      </div>
    </form>
  </div>
</body>
</html>
