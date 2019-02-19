<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 19/02/2019
 * Time: 16:08
 */
include ("includes/header.php");
require_once ("admin/includes/init.php");
?>

<?php
    $photos = Photo::find_all();
?>

<div class="container-fluid">
    <h1 class="text-center">MIJN BLOG PAGINA</h1>
    <div class="row">
        <?php
        foreach ($photos as $photo) :
        ?>
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img src="admin/<?php echo $photo->picture_path(); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $photo->title; ?></h5>
                    <p class="card-text"><?php echo $photo->caption; ?></p>
                    <a href="photo.php?id=<?php echo $photo->id; ?>" class="btn btn-primary">View article</a>
                </div>
            </div>
        </div><?php endforeach; ?>

    </div>
</div>




