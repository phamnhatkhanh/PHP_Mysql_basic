<?php include "../component/header.php"; ?>

<div class="container mt-4">
<h3>Please Register Here:</h3>
<hr>
<form action="" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Username</label>
      <input type="text" class="form-control" name="username" id="inputEmail4" placeholder="Username" value="<?php echo isset(
          $_POST["username"]
      )
          ? $_POST["username"]
          : ""; ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Email</label>
      <input type="email" class="form-control" name ="email" id="inputEmail" placeholder="Email" value="<?php echo isset(
          $_POST["email"]
      )
          ? $_POST["email"]
          : ""; ?>">
    </div>
  </div>
  <div class="form-group">
       <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" name ="password" id="inputPassword" placeholder="Password" >
    </div>

  <button type="submit" name='submit' class="btn btn-primary">Sign in</button>
 
               
</form>
 <?php
// if(isset($_SESSION['add_acc'])){
//     echo $_SESSION['add_acc'];
//     unset($_SESSION['add_acc']);}
?>
</div>




<?php if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users(username,email,password) VALUES('$username','$email','$hash_password')";


    ($res = mysqli_query($conn, $sql)) or die(mysqli_error($conn));
    if ($res == true) {
        $_SESSION["username"] = $username;

        //get id_user -> base on add product
        $sql = "SELECT * FROM users WHERE username='$username' ";
        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        $user = mysqli_fetch_assoc($res);
        $_SESSION["id_user"] = $user["id"];

        header("location:" . SITE_URL . "index.php");

        echo "add sucess";
    } else {
        echo "fail";
    }
} ?>

<?php include "../component/footer.php"; ?>
