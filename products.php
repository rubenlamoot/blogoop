<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/03/2019
 * Time: 11:11
 */
include("includes/header.php");
require_once("admin/includes/init.php");

$products = Product::find_all();
?>

<div class="container">
    <h1 class="text-center my-5">Mijn producten pagina</h1>
    <div class="row">

            <?php foreach ($products as $product) : ?>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="admin/<?php echo $product->picture_path_product(); ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $product->title; ?></h5>
                            <p class="card-text"><?= $product->description; ?></p>

                        </div>
                    </div>
                </div>
              <?php  endforeach; ?>

    </div>
</div>

