<?php
require "../component/header.php";
?>

<div class="main-concept">
        <div class="wapper">
            <h2>MANAGE STORE USER</h2>

            
           
            <br>
            <br>
            <table class="format-table">
                <tr>
                        <th>S.N</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created_at</th>
                      
                    </tr>
                <!--Đẩy DATA từ DB vào Bảng-->
                <?php
                //Create a query
                $sql = "SELECT * FROM users";
                // Excuting query
                $res = mysqli_query($conn, $sql);
                //Check Excuting query
                if ($res == true) {
                    $count = mysqli_num_rows($res);
                    $sn = 1;
                    if ($count > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {

                            $id_user = $row["id"];
                            $role_user = $row["role"];
                            $username = $row["username"];
                            $email = $row["email"];
                            $created_at = $row["created_at"];
                            ?>
                                <tr>
                                <td><?php echo $sn++; ?></td>
                                <td>
                                  <a href="show_product_user.php?id_user=<?php echo $id_user; ?>&&role_user=<?php echo $role_user; ?> " class="btn-update"><b>  <?php echo $username; ?></b></a>                                  
                              
                              </td>
                                <td>
                                   
                                </td>
                                <td><?php echo $email; ?></td>
                                <td><?php
                                $date = date_create($created_at);
                                echo date_format($date, "Y/m/d");
                                ?></td>
                           

                               
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
