<?php
require "../component/header.php";

if (isset($_GET["id_category"])) {
    $id_category = $_GET["id_category"];

    $sql_getData = "SELECT * FROM categories WHERE id=$id_category";

    $res = mysqli_query($conn, $sql_getData);
    $count = mysqli_num_rows($res);
    $row = mysqli_fetch_assoc($res);
    if ($count == 1) {
        echo "<pre>" . print_r($row) . "</pre>";
        $curr_image = $row["image_category"];

        if ($curr_image != "") {
            $remove_path =
                dirname(__DIR__, 1) .
                "/public/images/categories/" .
                $curr_image;
            $remove = unlink($remove_path);
            if ($remove == true) {
                echo "remove img done";
            } else {
                echo "falit";
            }
        }
        $sql = "DELETE FROM categories WHERE id=$id_category";

        //execute the query
        $res = mysqli_query($conn, $sql);
        //check whether the data is delete from  database or not
        if ($res == true) {
        $_SESSION["messenger"] = 'Delate Category Success';
        header("location:" . SITE_URL . "Categories/manage_category.php");
        } else {
               $_SESSION["messenger"] = "Can't Delete Category";
        header("location:" . SITE_URL . "Categories/manage_category.php");
        }
    }
} else {
     $_SESSION["messenger"] = "Not exist Category";
        header("location:" . SITE_URL . "Categories/manage_category.php");
}

?>
