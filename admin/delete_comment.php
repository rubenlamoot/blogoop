
<?php

include ("includes/header.php"); ?>
<?php
if(!$session->is_signed_in()){
    redirect("../index.php");
}else{
    if(!isAdmin2($session->user_id)){
        redirect("login.php");
    }
}

if(empty($_GET['id'])){
    redirect('comments.php');
}

$subcomment = Subcomment::find_by_id($_GET['id']);
if($subcomment){
    $subcomment->delete();
    redirect("comments.php");
}else{
    redirect("comments.php");
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