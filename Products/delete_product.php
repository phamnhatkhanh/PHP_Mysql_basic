<?php
 require '../component/header.php';

if (isset($_GET["id_product"])) {
    $id_product = $_GET["id_product"];
    
}

$sql_getData = "SELECT * FROM products WHERE id=$id_product";
$res = mysqli_query($conn, $sql_getData);
$row = mysqli_fetch_assoc($res);
$count = mysqli_num_rows($res);
if ($count == 1) {
    $curr_image = $row["image"];
    if ($curr_image != "") {
        $remove_path =
            dirname(__DIR__, 1) . "/public/images/products/" . $curr_image;
        $remove = unlink($remove_path);
        if ($remove == true) {
            echo "remove img done";
        } else {
            echo "falit";
        }
    }

    $sql = "DELETE FROM products WHERE id=$id_product";
  
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $_SESSION["messenger"] ="Delete Product Success";
        header("location:" . SITE_URL . "Products/manage_product.php");
    } else {
   
        $_SESSION["messenger"] ="Can't Delete Product";
         header("location:" . SITE_URL . "Products/manage_product.php");
    }
} else {
    $_SESSION["messenger"] ="Not exist user";
    header("location:" . SITE_URL . "Products/manage_product.php");
}

?>
