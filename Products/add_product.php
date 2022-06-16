<?php

  require '../component/header.php';
ob_start();
?>

<div class="main-concept">
        <div class="wapper">
            <h2>ADD PRODUCT</h2>
            <br>
            <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form-add-categories">
                        <tr>
                            <td>Title:</td>
                            <td><input type="text" name="title" style="width: 15em"  placeholder="Enter title food..."></td>
                        </tr>
                          <tr>
                            <td>Select Image:</td>
                            <td>
                                <input type="file" name="image_product">
                            </td>
                        </tr>
                         <tr>
                            <td>Quantity:</td>
                            <td>
                                <input type="number" name="quantity" style="width: 15em">
                            </td>
                        </tr>
                        <tr>
                            <td>Description:</td>
                            <td><textarea name="description" style="width: 15em" rows="5" placeholder="Description of the food..."></textarea></td>
                        </tr>
                        <tr>
                            <td>Price:</td>
                            <td>
                                <input type="number" name="price" style="width: 15em">
                            </td>
                        </tr>
                        
                      
                        <tr>
                            <td>Categories:</td>
                            <td>
                                <select name="category">

                                    <?php //push kind categoris from DB
                                        $sql_category="SELECT * FROM categories";
                                        $res_categoy=mysqli_query($conn,$sql_category);
                                        $count=mysqli_num_rows($res_categoy);
                                        if($count >0){
                                            while($row=mysqli_fetch_assoc($res_categoy)){
                                                $category_id=$row['id'];
                                                $category_kind=$row['name_category'];
                                                ?>
                                                    <option  value="<?php echo $category_id;?>"><?php echo $category_kind;?></option>
                                                <?php
                                            }
                                    
                                        }
                                        else{
                                            // empty
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
                                <input type="submit" name="submit" value="Add Product" class="btn-submit">
                            </td>
                        </tr>
                        
                    </table>

                </form>
        </div>
    </div>

    
<?php
        if(isset($_POST['submit'])){
        // Get information.
            $id_user = $_SESSION['id_user'];
            $id_cate = $_POST['category'];
            $title=$_POST['title'];
           $image_name=$_FILES['image_product']['name'];
            $quantity = $_POST['quantity'];
            $description=$_POST['description'];
            $price=$_POST['price'];
        

            if(!empty($_FILES['image_product']['name'])){
                 $image=$_FILES['image_product'];
                if($image_name!=""){
               
                    $tmp_ext=explode('.',$image_name);
                    $ext=end($tmp_ext);
                    $image_name="product_".rand(000,200).'.'.$ext;

                    $source_path=$_FILES['image_product']['tmp_name'];
                    $destination_path= dirname(__DIR__, 1)."/public/images/products/".$image_name;
                    
                    $upload=move_uploaded_file($source_path,$destination_path);
                    if($upload==false){
                    
                        
                        // header("location:".SITE_URL."admin/add_food.php");
                        die();
                    }
                }  
            }else{
                $image_name="";
            }
       
        // Insert data.
           $sql = "INSERT INTO products( id_user,id_cate,title, image,quantity,description, price) 
                    VALUES ($id_user,$id_cate,'$title','$image_name',$quantity,'$description',$price)
            ";
           
            $res=mysqli_query($conn,$sql) or die(mysqli_error($conn));
          
            
            if($res==true){
                $_SESSION["messenger"] ="Add Product Success";
                header("location:" . SITE_URL . "Products/manage_product.php");
              
              
            }else{
                $_SESSION["messenger"] ="Can't Add Product";
                header("location:" . SITE_URL . "Products/manage_product.php");
            }

        }
        // header("location:".);
?>
 

