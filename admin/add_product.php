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

$product = new Product();

if(isset($_POST['submit'])){
    if($product){
        $product->title = $_POST['title'];

        $product->description = $_POST['description'];

        $product->set_file_product($_FILES['product_image']);
        $product->save_product_and_image();
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
            <h1>Product toevoegen</h1>


            <form action="add_product.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="file" name="product_image" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="description" id="description" cols="30" rows="10"></textarea>
                        </div>

                        <div class="form-group my-3">
                            <input type="submit" class="btn btn-primary" value="Create product" name="submit">
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>


<?php include ("includes/footer.php"); ?>




