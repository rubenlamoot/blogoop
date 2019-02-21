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
<!--                        <select name="author" id="author" class="form-control">-->
<!--                            --><?php //foreach ($users as $user) : ?>
<!--                                <option value="--><?php //echo $user->id; ?><!--">--><?php //echo $user->last_name . " " .$user->first_name; ?><!--</option>-->
<!---->
<!--                            --><?php
//
//                            endforeach;
//
//                            ?>
<!--                        </select>-->

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
        <a href="" class="float-left mr-3">
            <?php $user = User::find_by_id($comment->user_id);?>
            <img src="admin/<?php echo $user->image_path_and_placeholder(); ?>" alt="" height="64" width="64" class="media-body">
        </a>
        <div class="media-body">
            <h4 class="media-heading"><?php echo $comment->author; ?>
                <small><?php echo $comment->date_time; ?></small>

            </h4>
            <?php echo $comment->body; ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>


<?php include("includes/footer.php"); ?>