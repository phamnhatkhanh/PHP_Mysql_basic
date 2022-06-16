<?php
ob_start();
require "../component/header.php";


if (isset($_GET["id_category"])) {
    $id_category = $_GET["id_category"];
    // get data in DB and display date in web.
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
         $_SESSION["messenger"] = "Not exist category";
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
                            <td><input type="text" name="title" style="width: 15em"  ></td>
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
                                <input type="submit" name="submit" value="Add Category" class="btn-submit">
                            </td>
                        </tr>
                        
                    </table>

                </form>
        </div>
    </div>

    
<?php if (isset($_POST["submit"])) {
    $title = $_POST["title"];
    $image_name = $_FILES["image_product"]["name"];
    $belong_category = $_POST["category"];
    
    if (!empty($_FILES["image_product"]["name"])) {
        $image = $_FILES["image_product"]["name"];

        if ($image_name != "") {
            $tmp_ext = explode(".", $image_name); 
            $ext = end($tmp_ext);
            $image_name = "category_" . rand(000, 200) . "." . $ext;

            $source_path = $_FILES["image_product"]["tmp_name"];
            $destination_path =
                dirname(__DIR__, 1) .
                "/public/images/categories/" .
                $image_name;

            $upload = move_uploaded_file($source_path, $destination_path);
            if ($upload == false) {
                echo "fail";
            }
        }
    } else {
        $image_name = "";
    }

    $sql_update = "INSERT INTO categories( name_category,image_category,belong_category) 
                    VALUES ('$title','$image_name',$belong_category)";

    
    ($res_update = mysqli_query($conn, $sql_update)) or die(mysqli_error($conn));
    if ($res_update == true) {
       $_SESSION["messenger"] = "Add Category Success";
         header("location:" . SITE_URL . "Categories/manage_category.php");
    } else {
         $_SESSION["messenger"] = "Can't Add Category";
        header("location:" . SITE_URL . "Categories/manage_category.php");
        
    }
}

?>
