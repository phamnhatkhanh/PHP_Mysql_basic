<?php
require "../component/header.php";

if (isset($_GET["id_product"]) && isset($_GET["id_user"])) {
    $id_product = $_GET["id_product"];
    $id_user = $_GET["id_user"];
    $role_user = $_GET["role_user"];

}

$sql_getData = "SELECT * FROM products WHERE id=$id_product AND id_user=$id_user";

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

    $sql = "DELETE FROM products WHERE id=$id_product AND id_user=$id_user";


    $res = mysqli_query($conn, $sql);
    
    if ($res == true) {
        echo "delete done";
        $_SESSION["messenger"] = "Delete Product User Success";
        header("location:" ."show_product_user.php?id_user=".$id_user."&&role_user=".$role_user);
    } else {
         $_SESSION["messenger"] = "Can't Delete Product User";
        header("location:" ."show_product_user.php?id_user=".$id_user."&&role_user=".$role_user);
    }
} else {
     $_SESSION["messenger"] = "Not exist product user";
        header("location:" ."show_product_user.php?id_user=".$id_user."&&role_user=".$role_user);
}

?>
