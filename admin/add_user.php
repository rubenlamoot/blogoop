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

$user = new User();
$roles = Role::find_all();

if(isset($_POST['submit'])){
    if($user){
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];
        if(isset($_POST['adminCheck'])){
            $user->admin = 1;
        }else{
            $user->admin = 0;
        }
        $user->set_file($_FILES['user_image']);
        $user->save_user_and_image();
        $user->save_role_and_id($user->id ,$_POST['selectRole']);
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
                            <label for="selectRole">Role : </label>
                            <select id="selectRole" name="selectRole">
                                <?php foreach ($roles as $role) : ?>
                                <option value="<?php echo $role->id; ?>">
                                    <?php echo $role->role; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="adminCheck" name="adminCheck">
                            <label class="form-check-label" for="adminCheck">
                                is een administrator
                            </label>
                        </div>

                        <div class="form-group my-3">
                            <input type="submit" class="btn btn-primary" value="Create user" name="submit">
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>


<?php include ("includes/footer.php"); ?>




