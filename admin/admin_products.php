<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/03/2019
 * Time: 11:42
 */
include("includes/header.php");
require_once("includes/init.php");
include ("includes/sidebar.php");
include ("includes/content_top.php");

if(!$session->is_signed_in()){
    redirect("../index.php");
}else{
    if(!isAdmin2($session->user_id)){
        redirect("login.php");
    }
}

$products = Product::find_all();

?>
<div class="container-fluid">
    <h1 class="text-center my-5">Producten</h1>
    <a href="add_product.php" class="btn btn-primary my-3">Add Product</a>

    <div class="row">
        <?php foreach ($products as $product) : ?>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img src="<?php echo $product->picture_path_product(); ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product->title; ?></h5>
                        <p class="card-text"><?= $product->description; ?></p>
                        <div class="d-flex flex-row">
                            <a href="edit_product.php?id=<?= $product->id; ?>" class="btn btn-success my-3 mr-3">Edit</a>
                            <a href="delete_product.php?id=<?= $product->id; ?>" class="btn btn-danger my-3">Delete</a>
                        </div>


                    </div>
                </div>
            </div>
        <?php  endforeach; ?>

    </div>
</div>

<?php include ("includes/footer.php"); ?>