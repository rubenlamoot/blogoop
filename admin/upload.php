<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14/02/2019
 * Time: 10:47
 */
include("includes/header.php");
include("includes/sidebar.php");
include("includes/content_top.php");
if(!$session->is_signed_in()){
    redirect('login.php');
}
$message = "";
if(isset($_POST['submit'])) {
    $photo = new Photo();
    $photo->title = $_POST['title'];
    $photo->set_file($_FILES['file']);
    if($photo->save()) {
        $message = "Photo uploaded successfully";
    } else {
        $message = join("<br>", $photo->errors);
    }
}
?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2 class="page-header">
                    UPLOAD
                </h2>
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="file" name="file" class="form-control">
                    </div>
                    <input type="submit" name="submit" value="submit" class="btn btn-primary">
                </form>
                <h3 class="my-3"><?php echo $message ?></h3>
            </div>
        </div>
    </div>
<?php include("includes/footer.php");  ?>