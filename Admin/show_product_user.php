
<?php
require "../component/header.php";
if (isset($_GET["id_user"]) && isset($_GET["role_user"])) {
    $id_user = $_GET["id_user"];
    $role_user = $_GET["role_user"];
}


?>

<div class="main-concept">
    
        <div class="wapper">
            <h2>ALL PRODUCTS USER</h2>

            <div><?php
                if (isset($_SESSION["messenger"] )) {
                    echo $_SESSION["messenger"];
                    unset($_SESSION["messenger"]);
                }

               
                ?></div>
            
            <br>
            <a href="manage_admin.php" class="btn-add"><b>Back Admin Page</b></a>
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
     
                <?php
 
                $sql = "SELECT * FROM products WHERE id_user= $id_user ";
       
                $res = mysqli_query($conn, $sql);
                if ($res == true) {
                    $count = mysqli_num_rows($res);
                    $sn = 1;
                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {

                            $id_product = $row["id"];
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
                                    <?php if (
                                        $role_user == 0 ||
                                        $id_user == $_SESSION["id_user"]
                                    ) { ?>


                                    <a href="edit_product_user.php?id_user=<?php echo $id_user; ?>&&role_user=<?php echo $role_user; ?>&&id_product=<?php echo $id_product; ?>" class="btn-update"><b>Update Food</b></a>
                                    <a href="delete_product_user.php?id_user=<?php echo $id_user; ?>&&role_user=<?php echo $role_user; ?>&&id_product=<?php echo $id_product; ?>" class="btn-delete"><b>Delete Food</b></a>
                                    <?php } ?>


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
