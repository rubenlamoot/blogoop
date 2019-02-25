<?php include ("includes/header.php"); ?>
<?php include ("includes/sidebar.php"); ?>
<?php include ("includes/content_top.php"); ?>

<?php

if(!isAdmin2($session->user_id)){
    redirect("login.php");
}

$photos = Photo::find_all();

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2 class="text-center">Photos</h2>
            <table class="table table-header">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>id</th>
                        <th>Title</th>
                        <th>Caption</th>
                        <th>Alternate Text</th>
                        <th>Filename</th>
                        <th>Size</th>
                        <th>Comments</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($photos as $photo): ?>
                        <tr>
                            <td><img src="<?php echo $photo->picture_path(); ?>" alt="" width="62" height="62" class="img-fluid mb-1">
                                <div class="d-flex flex-row">
                                    <a class="btn btn-danger rounded-0" href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a>
                                    <a class="btn btn-warning rounded-0 mx-3" href="edit_photo.php?id=<?php echo $photo->id; ?>">Edit</a>
                                    <a class="btn btn-success rounded-0" href="../photo.php?id=<?php echo $photo->id; ?>">view</a>
                                </div>
                            </td>
                            <td><?php echo $photo->id; ?></td>
                            <td><?php echo $photo->title; ?></td>
                            <td><?php echo $photo->caption; ?></td>
                            <td><?php echo $photo->alternate_text; ?></td>
                            <td><?php echo $photo->filename; ?></td>
                            <td><?php echo $photo->size; ?></td>
                            <td>
                                <a href="comment_photo.php?id=<?php echo $photo->id; ?>">
                                <?php
                                    $comments = Comment::find_the_comments($photo->id);
                                    echo count($comments);
                                ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>






<?php include ("includes/footer.php"); ?>
