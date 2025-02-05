<?php
include "authguard.php";
include "../shared/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieving and sanitizing inputs
    $pid = mysqli_real_escape_string($conn, $_POST['pid']);
    $name = mysqli_real_escape_string($conn, $_POST['pname']);
    $price = mysqli_real_escape_string($conn, $_POST['pprice']);
    $detail = mysqli_real_escape_string($conn, $_POST['pdetail']);
    $user_id = $_SESSION['user_id'];

    // Handling file upload
    $source = $_FILES['pdtimg']['tmp_name'];
    $filename = $_FILES['pdtimg']['name'];
    $target = "../shared/images/" . $filename;

    if (!empty($filename)) {
        // Move the uploaded file to the target directory
        if (move_uploaded_file($source, $target)) {
            // Update with the new image path
            $update_query = "UPDATE product SET name='$name', price=$price, impath='$target', detail='$detail' WHERE pid=$pid AND owner=$user_id";
        } else {
            echo "Error uploading image.";
            exit;
        }
    } else {
        // Update without changing the image if no file is uploaded
        $update_query = "UPDATE product SET name='$name', price=$price, detail='$detail' WHERE pid=$pid AND owner=$user_id";
    }

    // Executing the update query
    if (mysqli_query($conn, $update_query)) {
        echo "Product updated successfully!";
        
        header("location:view.php");
    } else {
        echo "Error updating product: " . mysqli_error($conn);
    }
   
}
?>
