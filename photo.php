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
$comments = Comment::find_the_comments(1);
$users = User::find_all_users();


$new_comment = new Comment();
if(isset($_POST['submit'])){
    if($new_comment){
        $new_comment->photo_id = 1;
        $new_comment->user_id = 1;
        $new_comment->author = $_POST['author'];
        $new_comment->body = $_POST['body'];
        $new_comment->date_time = date("Y-m-d H:i:s");

        $new_comment->create();

        redirect("photo.php?id={$photo->id}");

    }
}else{
    $author = "";
    $body = "";
}

$photo = Photo::find_by_id($_GET['id']);
?>

<div class="col-lg-8">
    <h1><?php $photo->picture_path(); ?></h1>

    <p class="load">
        by <a href="">start bootstrap</a>
    </p>
    <hr>
    <p><span class="fas fa-clock"></span> Posted on August 24, 2013 at 9.00 PM</p>
    <hr>
    <img src="http://place-hold.it/900x300" alt="">

    <hr>

    <p class="load">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad atque commodi dolore ex magnam praesentium quae quibusdam reprehenderit tenetur veniam! At consectetur corporis dignissimos exercitationem fuga illum, magnam sit voluptas.
    </p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque, debitis repudiandae. Mollitia officia optio quas repellendus veritatis. Doloremque ducimus error explicabo, impedit iure minus nam, nemo, officiis quaerat rem suscipit?</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet autem consequuntur cupiditate earum et explicabo, in magni mollitia nam nisi possimus quasi quos suscipit tenetur vitae! Error, optio, quaerat. Facere.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem cumque distinctio dolorem ex neque, nisi nulla perspiciatis porro, recusandae saepe sequi veniam! Aperiam cupiditate delectus eaque neque quas quidem sit!</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam ea fugiat iure, nam nobis ut. Autem, blanditiis debitis distinctio esse expedita minima nostrum officiis possimus repellendus sunt tempore ullam veniam!</p>
    <hr>

    <div class="well">
        <h4>Leave comment:</h4>
        <form role="form" method="post">
            <div class="form-group">
                <label for="author">Author</label>
<!--                <input type="text" name="author" id="author" class="form-control">-->
                <select name="author" id="author" class="form-control">
                    <?php foreach ($users as $user) : ?>
                    <option value="<?php echo $user->id; ?>"><?php echo $user->last_name . " " .$user->first_name; ?></option>

                    <?php

                    endforeach;

                    ?>
                </select>

            </div>
            <div class="form-group">
                <textarea name="body" rows="3" class="form-control">

                </textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
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
<div class="col-md-4">
<?php include("includes/sidebar.php"); ?>
</div>

<?php include("includes/footer.php"); ?>