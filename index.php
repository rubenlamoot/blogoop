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

$items_per_page = !empty($_GET['pageSelect']) ? (int)$_GET['pageSelect'] : 5;
$items_total_count = Photo::count_all();

// constructor aanroepen
$paginate = new Paginate($page, $items_per_page, $items_total_count);

$sql = "SELECT * FROM photos ";
$sql .= "LIMIT {$items_per_page} ";
$sql .= "OFFSET {$paginate->offset()}";

$photos = Photo::find_this_query($sql);

?>

<div class="col-md-4">
    <?php include ("includes/sidebar.php"); ?>
</div>

<div class="col-md-8">
    <h1 class="text-center my-5">MIJN BLOG PAGINA</h1>
   <form name="myForm" action="index.php">
       <div class="form-group">
           <label for="pageSelect">Show photos per page:</label>
           <select class="form-control" style="width: 15%" id="pageSelect" name="pageSelect" onchange="document.myForm.submit();">
               <option value="0" selected>choose option</option>
               <option value="2">2</option>
               <option value="4">4</option>
               <option value="6">6</option>
               <option value="8">8</option>
           </select>
       </div>
   </form>
    <div class="row">
        <?php
        foreach ($photos as $photo) :
        ?>
        <div class="col-md-4">
            <div class="card h-100" style="width: 100%;">
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
                                <a class="page-link" href="index.php?page=<?php echo $paginate->previous() ."&pageSelect=". $items_per_page; ?>"
                                tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <?php
                        }

                        for ($i = 1; $i <= $paginate->page_total(); $i++) {
                            if ($i == $paginate->current_page) {
                                echo "<li class='page-item active' aria-current='page'><a class='page-link' href='index.php?page={$i}&pageSelect={$items_per_page}'>{$i}</a></li>";
                            } else {
                                echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}&pageSelect={$items_per_page}'>{$i}</a></li>";
                            }
                        }
                        if ($paginate->has_next()) {
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="index.php?page=<?php echo $paginate->next() ."&pageSelect=". $items_per_page; ?>">Next</a>
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

<script>
    // function myPaginate(event){
    //     // document.myForm.submit();
    //     var selectElement = event.target;
    //     var value = selectElement.value;
    //     document.myForm.submit(value);
    // }
</script>


