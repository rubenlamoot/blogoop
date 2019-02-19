<?php

include ("includes/header.php"); ?>
<?php
if(!$session->is_signed_in()){
    redirect("login.php");
}


if(empty($_GET['id'])) {
    redirect("users.php");
}

$user = User::find_by_id($_GET['id']);

if(isset($_POST['update'])){
    if($user){

        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];

        if (empty($_FILES['user_image'])){
            $user->save();
        }else{
            $user->set_file($_FILES['user_image']);
            $user->save_user_and_image();
            redirect("edit_user.php?id={$user->id}");
        }
    }
}



?>

<?php include ("includes/sidebar.php"); ?>
<?php include ("includes/content_top.php"); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="users.php" class="btn btn-success my-3">All user</a>
            <h1>Edit User</h1>


            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-8">
                        <div class="form-group">
                            <input type="file" name="user_image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control"
                            value="<?php echo $user->username; ?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control"
                                   value="<?php echo $user->password; ?>">
                        </div>
                        <div class="form-group">
                            <label for="first_name">Firstname</label>
                            <input type="text" name="first_name" class="form-control"
                                   value="<?php echo $user->first_name; ?>">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Lastname</label>
                            <input type="text" class="form-control" name="last_name"
                                   value="<?php echo $user->last_name; ?>">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Update user" name="update">
                        </div>
                    </div>
                    <div class="col-4">
                        <img src="<?php echo $user->image_path_and_placeholder(); ?>" alt="" class="img-fluid">
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>


<?php include ("includes/footer.php"); ?>




