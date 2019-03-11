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
    redirect("users.php");
}

$user = User::find_by_id($_GET['id']);
$roles = Role::find_all();

$user_roles = Role::find_the_roles($_GET['id']);
$user_role_array = [];
if(isset($_POST['update'])){
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
                            <label for="selectActiveRole">Current roles of user : </label>
                            <select id="selectActiveRole" name="selectActiveRole" class="mr-3">
                                <?php foreach ($user_roles as $user_role) : ?>
                                    <option value="<?php echo $user_role->id;
                                    array_push($user_role_array, $user_role->id); ?>">
                                        <?php echo $user_role->role; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                            <label for="selectRole">Add role to user : </label>
                            <select id="selectRole" name="selectRole">
                                <?php
                                foreach ($roles as $role) :
                                        if(!in_array($role->id, $user_role_array)){ ?>
                                         <option value="<?php echo $role->id; ?>">
                                        <?php echo $role->role; ?>
                                        </option>
                                        <?php } ?>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="adminCheck" name="adminCheck" <?php if ((int)$user->admin === 1){
                                echo "checked";
                            }else{

                            } ?>>
                            <label class="form-check-label" for="adminCheck">
                                is een administrator
                            </label>
                        </div>

                        <div class="form-group my-3">
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




