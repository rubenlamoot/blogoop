<?php

include ("includes/header.php"); ?>
<?php
if(!$session->is_signed_in()){
    redirect("login.php");
}

$user = new User();

if(isset($_POST['submit'])){
    if($user){
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        $user->set_file($_FILES['user_image']);
        $user->save_user_and_image();
        redirect("users.php");
    }
}


?>

<?php include ("includes/sidebar.php"); ?>
<?php include ("includes/content_top.php"); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="users.php" class="btn btn-success my-3">All user</a>
            <h1>User toevoegen</h1>


            <form action="add_user.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="file" name="user_image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="first_name">Firstname</label>
                            <input type="text" name="first_name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Lastname</label>
                            <input type="text" class="form-control" name="last_name">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Create user" name="submit">
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>


<?php include ("includes/footer.php"); ?>




