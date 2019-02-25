<?php

include ("includes/header.php"); ?>
<?php
if(!isAdmin2($session->user_id)){
    redirect("login.php");
}

if(empty($_GET['id'])){
    redirect('photos.php');
}

$photo = Photo::find_by_id($_GET['id']);
if($photo){
    $photo->delete_photo();
    redirect('photos.php');
}else{
    redirect('photos.php');
}
?>
<?php include ("includes/sidebar.php"); ?>
<?php include ("includes/content_top.php"); ?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Welcome delete pagina</h1>
        </div>
    </div>
</div>


<?php include ("includes/footer.php"); ?>




