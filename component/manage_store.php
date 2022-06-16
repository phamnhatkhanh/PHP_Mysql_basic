<?php session_start(); ?>

      <li class="nav-item active">
        <a class="nav-link" href="<?php echo SITE_URL; ?>Products/manage_product.php">Products </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo SITE_URL; ?>Categories/manage_category.php">Categories </a>
      </li>
      <?php if (!empty($_SESSION["admin"])) { ?>
         <li class="nav-item active">
        <a class="nav-link" href="<?php echo SITE_URL; ?>Admin/manage_admin.php">Admin </a>
      </li>

<?php } ?>
       
     
      <li class="nav-item">
        <a class="nav-link" href="<?php echo SITE_URL; ?>Auth/logout.php">Logout</a>
      </li>
      