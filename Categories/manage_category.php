<?php

require "../component/header.php";

?>

   <div class="main-concept">
        <div class="wapper">
            <h2>MANAGE CATEGORIES</h2>
            <div>
                <?php
                if (isset($_SESSION["messenger"] )) {
                    echo $_SESSION["messenger"];
                    unset($_SESSION["messenger"]);
                }

               
                ?>
            </div>
            
            <br>
            <a href="add_category.php" class="btn-add"><b>Add Categories</b></a>
            <br>
            <br>
            <table class="format-table">
                <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Images</th>
                        <th>Actino </th>
                </tr>
 <?php // Lấy dữ liệu từ DB.


 $sql = "SELECT * FROM categories";
 $res = mysqli_query($conn, $sql);
 if ($res == true) {
     $count = mysqli_num_rows($res);
     $sn = 1;
     if ($count > 0) {
         while ($row = mysqli_fetch_assoc($res)) {

             $id = $row["id"];
             $title = $row["name_category"];
             $image = $row["image_category"];
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
                                           echo "<img src='../public/images/categories/$image' alt=\"\" width=\"100px\" height=\"100px\"/>";
                                       }
                                   } ?>
                                   
                                </td>
 
                                   <td> 

                                    <a href="edit_category.php?id_category=<?php echo $id; ?>" class="btn-update"><b>Update Food</b></a>
                                    <a href="delete_category.php?id_category=<?php echo $id; ?>"  class="btn-delete"><b>Delete Food</b></a>
                                    
                                </td>
                            </tr>
                            <?php
         }
     }
 }
 ?>
            
            </table>
        </div>
        
    </div>
    




    <?php include "../component/footer.php"; ?>
