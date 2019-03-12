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
    redirect('roles.php');
}

$role = Role::find_by_id($_GET['id']);

if($role){
    $role->delete();
    redirect('roles.php');
}else{
    redirect('roles.php');
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