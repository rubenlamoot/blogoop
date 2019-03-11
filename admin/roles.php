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

$roles = Role::find_all();
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="add_role.php" class="btn btn-primary my-3">Add Role</a>
            <table>
                <thead>
                <tr>
                    <th>id</th>
                    <th class="text-center">Role</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($roles as $role) : ?>
                    <tr>
                        <td><?php echo $role->id; ?></td>
                        <td><?php echo $role->role; ?></td>
                        <td>
                            <a href="edit_role.php?id=<?php echo $role->id; ?>" class="btn btn-success">Edit</a>
                        </td>
                        <td>
                            <a href="delete_role.php?id=<?php echo $role->id; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include ("includes/footer.php"); ?>
