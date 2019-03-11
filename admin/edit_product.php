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

if(empty($_GET['id'])) {
    redirect("admin_products.php");
}

$product = Product::find_by_id($_GET['id']);

if(isset($_POST['update'])){
    if($product){
        $product->title = $_POST['title'];

        $product->description = $_POST['description'];

        if (empty($_FILES['product_image'])){
            $product->save();

        }else{
            $product->set_file_product($_FILES['product_image']);
            $product->save_product_and_image();

        }
        redirect("admin_products.php");

    }
}


?>

<?php include ("includes/sidebar.php"); ?>
<?php include ("includes/content_top.php"); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <a href="admin_products.php" class="btn btn-success my-3">All products</a>
            <h1>Edit product</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="file" name="product_image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control"
                            value="<?= $product->title; ?>">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" rows="3"><?= $product->description; ?></textarea>
                        </div>

                        <div class="form-group my-3">
                            <input type="submit" class="btn btn-primary" value="Edit product" name="update">
                        </div>
                    </div>

                </div>

            </form>
        </div>
        <div class="col-md-4">
            <img src="<?php echo $product->image_path_and_placeholder_product(); ?>" alt="" class="img-fluid">
        </div>
    </div>



</div>


<?php include ("includes/footer.php"); ?>




