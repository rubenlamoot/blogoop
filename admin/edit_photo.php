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

if(empty($_GET['id'])){
    redirect('photos.php');

}else{
    $photo = Photo::find_by_id($_GET['id']);
    if(isset($_POST['update'])){
        if($photo){
            $photo->title = $_POST['title'];
            $photo->caption = $_POST['caption'];
            $photo->alternate_text = $_POST['alternate_text'];
            $photo->description = $_POST['description'];
//            if($photo->created_at = "0000-00-00 00:00:00"){
//                $photo->created_at = date("Y-m-d H:i:s");
//            }
            $photo->updated_at = date("Y-m-d H:i:s");
            $photo->update();
            redirect('photos.php');
        }
    }
}

?>

<?php include ("includes/sidebar.php"); ?>
<?php include ("includes/content_top.php"); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1>Welcome edit pagina</h1>

            <form action="edit_photo.php?id=<?php echo $photo->id; ?>" method="post">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $photo->title; ?>">
                        </div>
                        <div class="form-group">
                            <label for="caption">Caption</label>
                            <input type="text" name="caption" class="form-control" value="<?php echo $photo->caption; ?>">
                        </div>
                        <div class="form-group">
                            <label for="alternate_text">Alternate_text</label>
                            <input type="text" name="alternate_text" class="form-control" value="<?php echo $photo->alternate_text; ?>">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" cols="30" rows="10">
                                <?php echo $photo->description; ?>
                            </textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="photo-info-box">
                            <div class="info-box-header">
                                <h4>Save <span id="toggle" class="fas fa-arrow-up"></span> </h4>
                            </div>
                            <div class="inside">
                                <div class="box-inner">
                                    <p class="text">
                                        <span class="fas fa-calendar">Uploaded on: <?php echo $photo->created_at; ?></span>
                                    </p>
                                    <p class="text">
                                       Updated on: <span class="data photo_id_box"><?php echo $photo->updated_at; ?></span>
                                    </p>
                                    <p class="text">
                                        Photo Id: <span class="data"><?php echo $photo->id; ?></span>
                                    </p>
                                    <p class="text">
                                        Filename: <span class="data"><?php echo $photo->filename ?></span>
                                    </p>
                                    <p class="text">
                                        File Type: <span class="data"><?php echo $photo->type; ?></span>
                                    </p>
                                    <p class="text">
                                        File Size: <span class="data"><?php echo $photo->size; ?></span>
                                    </p>
                                </div>
                                <div class="info-box-footer">
                                    <div class="info-box-delete float-left">
                                        <a class="btn btn-danger btn-lg" href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a>
                                    </div>
                                    <div class="info-box-update float-right">
                                        <input class="btn btn-primary btn-lg" type="submit" name="update" value="Update">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>


<?php include ("includes/footer.php"); ?>




