<?php 
require_once ("component/header.php");
if (empty($_SESSION["username"])) {
    header("location:" . SITE_URL . "Auth/login.php");
}
?>



<div class="container mt-4">
<h3><?php echo "Welcome ". $_SESSION['username']?>! You can now use this website</h3>
<hr>
</div>

<?php require_once('component/footer.php')?>