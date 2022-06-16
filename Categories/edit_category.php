<?php
require "../component/header.php";
ob_start();
if (isset($_GET["id_category"])) {
    $id_category = $_GET["id_category"];
    $sql_getData = "SELECT * FROM categories WHERE id=$id_category";

    $res = mysqli_query($conn, $sql_getData);
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $id_category = $row["id"];
        $title = $row["name_category"];
        $curr_image = $row["image_category"];
        $belong_category = $row["belong_category"];
    } else {
        $_SESSION["messenger"] = 'Not exist category';
        header("location:" . SITE_URL . "Categories/manage_category.php");
    }
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
                            <td>Belong Category:</td>
                            <td>
                                  <select name="category">

                                    <?php 


                                    $sql_category = "SELECT * FROM categories";
                                    $res_categoy = mysqli_query($conn,$sql_category);
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
                                                        $category_id == $belong_category
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
                                <input type="submit" name="submit" value="Update Category" class="btn-submit">
                            </td>
                        </tr>
                        
                    </table>

                </form>
        </div>
    </div>

    
<?php if (isset($_POST["submit"])) {
    $belong_category = $_POST["category"];
    $title = $_POST["title"];
    

    if (!empty($_FILES["image_product"]["name"])) {
        $update_image = $_FILES["image_product"]["name"];

        if ($update_image != "") {
            $tmp_ext = explode(".", $update_image); 
            $ext = end($tmp_ext);
            $update_image = "category_" . rand(000, 200) . "." . $ext;

            $source_path = $_FILES["image_product"]["tmp_name"];
            $destination_path =
                dirname(__DIR__, 1) .
                "/public/images/categories/" .
                $update_image;

            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload == false) {
                echo "uploade fail";
                
            } else {
                echo $curr_image . "<br>" . $update_image . "<br>";
                $remove_path =
                    dirname(__DIR__, 1) .
                    "/public/images/categories/" .
                    $curr_image;
                $remove = unlink($remove_path);

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

    //update DB.
    $sql_update = "UPDATE categories SET name_category='$title',image_category='$update_image',belong_category=$belong_category WHERE id= $id_category";

    ($res_update = mysqli_query($conn, $sql_update)) or
        die(mysqli_error($conn));
    if ($res_update == true) {
         $_SESSION["messenger"] = 'Update Category Success';
        header("location:" . SITE_URL . "Categories/manage_category.php");
    } else {
         $_SESSION["messenger"] = "Can't Update Category";
        header("location:" . SITE_URL . "Categories/manage_category.php");
    }
}

?>
