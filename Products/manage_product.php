<?php

require "../component/header.php";

?>


<div class="main-concept">
        <div class="wapper">
            <h2>MANAGE PRODUCTS</h2>

            <div><?php
            if (isset($_SESSION["messenger"])) {
                echo $_SESSION["messenger"]; 
                unset($_SESSION["messenger"]);
            }
           
            ?></div>
            
            <br>
            <a href="add_product.php" class="btn-add"><b>Add Product</b></a>
            <br>
            <br>
            <table class="format-table">
                <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                <!--Đẩy DATA từ DB vào Bảng-->
                <?php
                $id_user = $_SESSION["id_user"];

                //Create a query
                $sql = "SELECT * FROM products WHERE id_user= $id_user ";
                // Excuting query
                $res = mysqli_query($conn, $sql);
                //Check Excuting query
                if ($res == true) {
                    $count = mysqli_num_rows($res);
                    $sn = 1;
                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {

                            $id = $row["id"];
                            $title = $row["title"];
                            $image = $row["image"];
                            $quantity = $row["quantity"];
                            $description = $row["description"];
                            $price = $row["price"];
                            ?>
                                <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $title; ?></td>
                                <td>
                                    <?php if (is_null($image)) {
                                        echo "null";
                                    } else {
                                        if (strpos($image, "https://") != "") {
                                            echo "<img src='$image' alt=\"\" width=\"100px\" height=\"100px\"/>";
                                        } else {
                                            echo "<img src='../public/images/products/$image' alt=\"\" width=\"100px\" height=\"100px\"/>";
                                        }
                                    } ?>
                                </td>
                                <td><?php echo $quantity; ?></td>
                                <td><?php echo $description; ?></td>
                                   <td><?php echo $price; ?></td>
                                <td>
                                    
                                    <a href="edit_product.php?id_product=<?php echo $id; ?>" class="btn-update"><b>Update Food</b></a>
                                    <a href="delete_product.php?id_product=<?php echo $id; ?>" class="btn-delete"><b>Delete Food</b></a>
                                 
                                </td>
                            </tr>
                                <?php
                        }
                    } else {
                        echo '<div class="notification-success-update">DataBase Not Data</div>';
                    }
                } else {
                    
                    echo "Cannot Connect To DataBase";
                }
                ?>
            </table>
        </div>
    </div>





    <?php include "../component/footer.php"; ?>
