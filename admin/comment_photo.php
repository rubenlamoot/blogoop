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


if(empty($_GET['id'])){
    redirect("photos.php");
}
$comments = Comment::find_the_comments($_GET['id']);
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <table>
                <thead>
                <tr>
                    <th>id</th>
                    <th>author</th>
                    <th>body</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($comments as $comment) : ?>
                    <tr>

                        <td>
                            <a href="delete_comment_photo.php?id=<?php echo $comment->id; ?>" class="btn btn-danger btn-sm m-2">Delete</a>
                            <?php echo $comment->id; ?></td>

                        <td><?php echo $comment->author; ?></td>

                        <td><?php echo $comment->body; ?></td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include ("includes/footer.php"); ?>

