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
/** variabelen voor het vullen van de parameters constructor van de class Paginate */
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = 4;
$items_total_count = Photo::count_all();

// constructor aanroepen
$paginate = new Paginate($page, $items_per_page, $items_total_count);

$sql = "SELECT * FROM photos ";
$sql .= "LIMIT {$items_per_page} ";
$sql .= "OFFSET {$paginate->offset()}";

$photos = Photo::find_this_query($sql);

//    $photos = Photo::find_all();
?>

<div class="col-md-4">
    <?php include ("includes/sidebar.php"); ?>
</div>

<div class="col-md-8">
    <h1 class="text-center my-5">MIJN BLOG PAGINA</h1>
    <div class="row">
        <?php
        foreach ($photos as $photo) :
        ?>
        <div class="col-md-4">
            <div class="card" style="width: 100%;">
                <img src="admin/<?php echo $photo->picture_path(); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $photo->title; ?></h5>
                    <p class="card-text"><?php echo $photo->caption; ?></p>
                    <a href="photo.php?id=<?php echo $photo->id; ?>" class="btn btn-primary">View article</a>
                </div>
            </div>
        </div><?php endforeach; ?>
    </div>
    <div class="row my-5">
        <div class="col-12 d-flex justify-content-center">
            <nav aria-label="...">
                    <ul class="pagination">
                        <?php
                    if($paginate->page_total() > 1) {
                        if ($paginate->has_previous()) { ?>
                            <li class="page-item">
                                <a class="page-link" href="index.php?page=<?php echo $paginate->previous(); ?>"
                                   tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <?php
                        }

                        for ($i = 1; $i <= $paginate->page_total(); $i++) {
                            if ($i == $paginate->current_page) {
                                echo "<li class='page-item active' aria-current='page'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
                            } else {
                                echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
                            }
                        }
                        if ($paginate->has_next()) {
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="index.php?page=<?php echo $paginate->next(); ?>">Next</a>
                            </li>
                            <?php
                        }
                    }
                        ?>
                    </ul>
                </nav>

        </div>
    </div>
</div>




