<?php include ("includes/header.php"); ?>
<?php
if(!isAdmin2($session->user_id)){
    redirect("login.php");
}
?>
<?php include ("includes/sidebar.php"); ?>
<?php include ("includes/content_top.php"); ?>
<?php include ("includes/content.php"); ?>
<?php include ("includes/footer.php"); ?>
