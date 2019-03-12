<?php include ("includes/header.php"); ?>
<?php include ("includes/sidebar.php"); ?>
<?php include ("includes/content_top.php"); ?>

<?php
if(!$session->is_signed_in()){
    redirect("../index.php");
}else{
    if(!isAdmin2($session->user_id)){
        redirect("login.php");
    }
}

$users = User::find_all_users();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="add_user.php" class="btn btn-primary my-3">Add User</a>
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Photo</th>
                        <th>Username</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?php echo $user->id; ?></td>
                        <td class="d-flex flex-row">
                            <img class="mr-3" src="<?php echo $user->image_path_and_placeholder(); ?>"
                                 alt="<?php echo $user->first_name . ' ' . $user->last_name; ?>" width="62" height="62">
                            <div class="pt-3">
                                <a href="delete_user.php?id=<?php echo $user->id; ?>" class="btn btn-danger">Delete</a>
                                <a href="edit_user.php?id=<?php echo $user->id; ?>" class="btn btn-warning">Edit</a>
                                <a href="" class="btn btn-success mr-3">View</a>
                            </div>
                        </td>
                        <td><?php echo $user->username; ?></td>
                        <td><?php echo $user->first_name; ?></td>
                        <td><?php echo $user->last_name; ?></td>
                        <td><?php
                                $roles = Role::find_the_roles($user->id);
                               foreach ($roles as $role) :
                                   echo $role->role .' / ';
                            endforeach;
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include ("includes/footer.php"); ?>
