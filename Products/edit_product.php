<?php
 require '../component/header.php';
ob_start();
if (isset($_GET["id_product"])) {
    $id_product = $_GET["id_product"];
    
    $sql_getData = "SELECT * FROM products WHERE id=$id_product";
    $res = mysqli_query($conn, $sql_getData);
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $id_user = $_SESSION["id_user"];
        $id_cate = $row["id_cate"];
        $title = $row["title"];
        $curr_image = $row["image"];
        $quantity = $row["quantity"];
        $description = $row["description"];
        $price = $row["price"];
    } else {
        
       $_SESSION["messenger"] = 'Not Found Data Product';
        header("location:" . SITE_URL . "Products/manage_product.php");
    }
} else {
 
}
?>

<div class="main-concept">
        <div class="wapper">
            <h2>UPDATE PRODUCT</h2>
            <br>
            <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form-add-categories">
                        <tr>
                            <td>Title:</td>
                            <td><input type="text" name="title" style="width: 15em"  value="<?php echo $title; ?>"></td>
                        </tr>
                          <tr>
                            <td>Update Image:</td>
                            <td>
                                <input type="file" name="image_product">
                            </td>
                        </tr>
                         <tr>
                            <td>Quantity:</td>
                            <td>
                                <input type="number" name="quantity" style="width: 15em" value="<?php echo $quantity; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Description:</td>
                            <td><textarea name="description" style="width: 15em" rows="5" ><?php echo $description; ?></textarea></td>
            
                        </tr>
                        <tr>
                            <td>Price:</td>
                            <td>
                                <input type="number" name="price" style="width: 15em" value="<?php echo $price; ?>">
                            </td>
                        </tr>
                        
                      
                        <tr>
                            <td>Categories:</td>
                            <td>
                                <select name="category">

                                    <?php //push kind categoris from DB


                                    $sql_category = "SELECT * FROM categories";
                                    $res_categoy = mysqli_query(
                                        $conn,
                                        $sql_category
                                    );
                                    $count = mysqli_num_rows($res_categoy);
                                    if ($count > 0) {
                                        while (
                                            $row = mysqli_fetch_assoc(
                                                $res_categoy
                                            )
                                        ) {

                                            $category_id = $row["id"];
                                            $category_kind =
                                                $row["name_category"];
                                            ?>
                                                    <option  value="<?php echo $category_id; ?>" 
                                                    <?php if (
                                                        $id_cate == $category_id
                                                    ) {
                                                        echo 'selected="selected"';
                                                    } ?>>
                                                    <?php echo $category_kind; ?>
                                                  </option>
                                                <?php
                                        }
                                    } else {
                                     
                                        ?>
                                                <option value="0">Catgories Empty</option>
                                            <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                      
                      
                        <tr>
                            <td>
                                <input type="submit" name="submit" value="Update Product" class="btn-submit">
                            </td>
                        </tr>
                        
                    </table>

                </form>
        </div>
    </div>

    
<?php if (isset($_POST["submit"])) {
    // Get information.
    $id_user = $_SESSION["id_user"];
    $id_cate = $_POST["category"];
    $title = $_POST["title"];
    $update_image = $_FILES["image_product"]["name"];
  
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    if (!empty($_FILES["image_product"]["name"])) {
        $update_image = $_FILES["image_product"]["name"];

        if ($update_image != "") {
            $tmp_ext = explode(".", $update_image); 
            $ext = end($tmp_ext);
            $update_image = "product_" . rand(000, 200) . "." . $ext;

            $source_path = $_FILES["image_product"]["tmp_name"];
            $destination_path =
                dirname(__DIR__, 1) .
                "/public/images/products/" .
                $update_image;

            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload == false) {
                $_SESSION["messenger"] ="Upload product fail";

                header("location:".SITE_URL."Products/manage_product.php");
              
            } else {
            
                $remove_path =
                    dirname(__DIR__, 1) .
                    "/public/images/products/" .
                    $curr_image;
                $remove = unlink($remove_path);
                // checked remove;
                if ($remove == false) {
                      
                    echo $remove_path . "<br>";
                    echo "remove image fali" . "<br>";
                } else {
                    echo "remove succes";
                }

                echo " upload sucess" . "<br>";
            }
        } else {
           // not image 
            $update_image = $curr_image;
        }
    } else {
        // not file 
        $update_image = $curr_image;
    }

    
    $sql_update = "UPDATE products SET id_user= $id_user, id_cate=$id_cate, title='$title',image='$update_image', quantity=$quantity,description='$description',price=$price WHERE id= $id_product";
    
    ($res_update = mysqli_query($conn, $sql_update)) or die(mysqli_error($con));
    if ($res_update == true) {
        $_SESSION["messenger"] ="Update Product Success";
        header("location:" . SITE_URL . "Products/manage_product.php");
    } else {
       $_SESSION["messenger"] ="Can't Update Product";
        header("location:" . SITE_URL . "Products/manage_product.php");
    }
}

?>
