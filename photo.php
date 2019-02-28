<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18/02/2019
 * Time: 13:56
 */
include ("includes/header.php");
require_once ("admin/includes/init.php");
?>

<?php

if(empty($_GET['id'])){
    redirect('index.php');
}
if(isAdmin()){
    $active_user = User::find_by_id($session->user_id);
}

$comments = Comment::find_the_comments($_GET['id']);
$users = User::find_all_users();
$photo = Photo::find_by_id($_GET['id']);


$new_comment = new Comment();
if(isset($_POST['submit'])){
    if($new_comment){
        $new_comment->photo_id = $_GET['id'];
        $new_comment->user_id = $active_user->id;
        $new_comment->author = $active_user->first_name ." ". $active_user->last_name;
        $new_comment->body = trim($_POST['body']);
        $new_comment->date_time = date("Y-m-d H:i:s");

        $new_comment->create();

        redirect("photo.php?id={$photo->id}");
    }else{
        $message = "There were some problems saving";
    }
}else{
    $author = "";
    $body = "";
}

$sub_comment = new Subcomment();
if(isset($_POST['update'])){
    if($sub_comment){
        $sub_comment->comment_id = $comment->id;
        $sub_comment->user_id = $active_user->id;
        $sub_comment->body = trim($_POST['commentBody']);
        $sub_comment->date_time = date("Y-m-d H:i:s");

        $sub_comment->create();
        redirect("photo.php?id={$photo->id}");
    }else{
        $message = "There were some problems saving";
    }
}
?>
<div class="col-md-4">
    <?php include("includes/sidebar.php"); ?>
</div>

<div class="col-md-8">
    <h1>Blog Post : <?php echo $photo->title; ?></h1>

    <p class="load">
        by <a href="">Ruben Lamoot</a>
    </p>
    <hr>
    <p><span class="fas fa-clock"></span> Posted on <?php echo $photo->created_at; ?></p>
    <hr>
    <img src="admin/<?php echo $photo->picture_path(); ?>" alt="">

    <hr>

    <p class="load">
        <?php echo $photo->description; ?>
    </p>
    <hr>

    <?php
        if(isAdmin()){

            ?>
            <div class="well">
                <h4>Leave comment:</h4>
                <form role="form" method="post">
                    <div class="form-group">
                        <label for="author">Author:</label>
                        <p><?= $active_user->first_name ." ". $active_user->last_name; ?></p>
                    </div>
                    <div class="form-group">
                <textarea name="body" rows="3" class="form-control">

                </textarea>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
    <?php    }
    ?>


    <hr>
    <?php foreach ($comments as $comment) : ?>
    <div class="media">
        <div class="float-left mr-3">
            <?php $user = User::find_by_id($comment->user_id);?>
            <img src="admin/<?php echo $user->image_path_and_placeholder(); ?>" alt="" height="64" width="64" class="media-body">
        </div>
        <div class="media-body">
            <div class="d-flex flex-row">
                <h4 class="media-heading"><?php echo $comment->author; ?>
                    <small><?php echo $comment->date_time; ?></small>
                </h4>

                <?php
                     if(isAdmin()){ ?>
<!--                    <button class="btn btn-danger ml-3 mb-3">comment</button>-->
                         <!-- Button trigger modal -->
                         <button type="button" class="btn btn-primary ml-3 mb-3" data-toggle="modal" data-target="#commentModal">
                             Comment
                         </button>

                         <!-- Modal -->
                         <div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                             <div class="modal-dialog modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                     <form method="post">

                                         <div class="modal-header">
                                             <h5 class="modal-title" id="exampleModalCenterTitle">Leave a comment</h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                 <span aria-hidden="true">&times;</span>
                                             </button>
                                         </div>
                                         <div class="modal-body">
                                             <p><?php echo $comment->id; ?></p>
                                                 <div class="form-group">
                                                     <label for="author">Author:</label>
                                                     <p><?= $active_user->first_name ." ". $active_user->last_name; ?></p>
                                                 </div>
                                                 <div class="form-group">
                                                     <label for="commentBody">Comment:</label>
                                                     <textarea class="form-control" id="commentBody" name="commentBody" rows="3">

                                                     </textarea>
                                                 </div>
                                                 <div class="modal-footer">
                                                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                     <button type="submit" name="update" class="btn btn-primary">Submit</button>
                                                 </div>

                                         </div>
                                     </form>

                                 </div>
                             </div>
                         </div>
                    <?php } ?>
            </div>

            <?php echo $comment->body; ?>
        </div>
    </div>
    <?php endforeach; ?>
<!--    <h3 class="my-3">--><?php //echo $message ?><!--</h3>-->
</div>


<?php include("includes/footer.php"); ?>