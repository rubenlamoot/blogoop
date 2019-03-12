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

if(empty($_GET['id'])) {
    redirect("roles.php");
}

$role = Role::find_by_id($_GET['id']);

if(isset($_POST['update'])){
    if($role){
        $role->role = trim($_POST['role_name']);
        $role->save();
        redirect("roles.php");
    }
}


?>

<?php include ("includes/sidebar.php"); ?>
<?php include ("includes/content_top.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <a href="roles.php" class="btn btn-success my-3">All Roles</a>
                <h1>Edit role</h1>


                <form action="" method="post">
                    <div class="row">
                        <div class="col-12">

                            <div class="form-group">
                                <label for="role_name">Name of role</label>
                                <input type="text" class="form-control" name="role_name"
                                value="<?php echo $role->role; ?>">
                            </div>

                            <div class="form-group my-3">
                                <input type="submit" class="btn btn-primary" value="Edit role" name="update">
                            </div>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>


<?php include ("includes/footer.php"); ?>