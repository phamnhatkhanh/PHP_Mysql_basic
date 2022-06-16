<?php include "../component/header.php"; ?>



<div class="container mt-4">
<h3>Please Login Here:</h3>
<hr>

<form action="" method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" name="username" class="form-control" 
    id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Username"
    value="<?php if (!empty($_COOKIE["member_login"])) {
        echo $_COOKIE["member_login"];
    } ?>"
    >
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" 
    id="exampleInputPassword1" placeholder="Enter Password"
    value="<?php if (isset($_COOKIE["member_password"])) {
        echo $_COOKIE["member_password"];
    } ?>"
    >
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember_me">
    <label class="form-check-label" for="exampleCheck1">Remember me</label>
  </div>
  <button type="submit" name ='submit' class="btn btn-primary">Submit</button>
</form>



</div>

<!-- /Applications/XAMPP/xamppfiles/htdocs/code/Admin_PHP/ -->
<?php if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    // $hash_password = password_hash($password, PASSWORD_DEFAULT);
   

    $sql = "SELECT * FROM users WHERE username='$username' ";

    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $user = mysqli_fetch_assoc($res);

    $count = mysqli_num_rows($res);
    if ((password_verify($password, $user["password"]))) {
        //cookies
        if (!empty($_POST["remember_me"])) {
            setcookie(
                "member_login",
                $username,
                time() + 10 * 365 * 24 * 60 * 60
            );
            setcookie(
                "member_password",
                $password,
                time() + 10 * 365 * 24 * 60 * 60
            );
          
        } else {
            if (isset($_COOKIE["member_login"])) {
                setcookie("member_login", "");
            }
            if (isset($_COOKIE["member_password"])) {
                setcookie("member_password", "");
            }
        }

      
        $_SESSION["username"] = $username;
        $_SESSION["id_user"] = $user["id"];


        if ($user["role"] == 1) {
            $_SESSION["admin"] = 1;
        } else {
            $_SESSION["admin"] = 0;
            
        }
        header("location:" . SITE_URL . "index.php");
    } else {
        echo "fail";
    }
} ?>
<?php include "../component/footer.php"; ?>
