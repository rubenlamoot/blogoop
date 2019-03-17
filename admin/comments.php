<?php include ("includes/header.php"); ?>
<?php include ("includes/sidebar.php"); ?>
<?php include ("includes/content_top.php"); ?>

<?php
if(!$session->is_signed_in()){
    redirect("../index.php");
}else{
    if(!isAdmin2($session->user_id)){
        redirect("login.php");
    }
}
$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
$items_per_page = !empty($_GET['pageSelect']) ? (int)$_GET['pageSelect'] : 5;
$items_total_count = Comment::count_all();

$paginate = new Paginate($page, $items_per_page, $items_total_count);

$sql = "SELECT * FROM comments ";
$sql .= "LIMIT {$items_per_page} ";
$sql .= "OFFSET {$paginate->offset()}";

$comments = Comment::find_this_query($sql);

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h1 class="my-3">All comments</h1>
            <form name="myForm">
                <div class="form-group">
                    <label for="pageSelect">Show comments per page:</label>
                    <select class="form-control" style="width: 15%" id="pageSelect" name="pageSelect" onchange="myPaginate()">
                        <option value="0" selected>choose option</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </form>
            <table>
                <thead>
                <tr>
                    <th class="text-right">Id</th>
                    <th class="text-center">Author</th>
                    <th class="text-center">Body</th>
                    <th class="text-center">Date</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($comments as $comment) : ?>
                    <tr>

                        <td>
                            <a href="delete_comment_photo.php?id=<?php echo $comment->id; ?>" class="btn btn-danger btn-sm m-2">Delete</a>
                            <?php echo $comment->id; ?></td>

                        <td><?php echo $comment->author; ?></td>

                        <td class="text-center"><?php echo $comment->body; ?></td>
                        <td><?php echo $comment->date_time; ?></td>
                    </tr>
                    <?php
                        $subcomments = Subcomment::find_the_subcomments($comment->id);
                        if($subcomments){ ?>
                            <table class="ml-5">
                                <thead>
                                    <tr>
                                        <th class="text-right">SubId</th>
                                        <th class="text-center">Author</th>
                                        <th class="text-center">Body</th>
                                        <th class="text-center">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($subcomments as $subcomment) : ?>
                                    <tr>
                                        <td>
                                            <a href="delete_comment.php?id=<?php echo $subcomment->id; ?>" class="btn btn-danger btn-sm m-2">Delete</a>
                                            <?php echo $subcomment->id; ?></td>

                                        <td><?php
                                            $user = User::find_by_id($subcomment->user_id);
                                            echo $user->first_name ." ". $user->last_name; ?></td>

                                        <td class="text-center"><?php echo $subcomment->body; ?></td>
                                        <td><?php echo $subcomment->date_time; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                       <?php }else{
                            echo '<br>';
                        }
                    ?>

                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-12 d-flex justify-content-center">
            <nav aria-label="...">
                <ul class="pagination">
                    <?php
                    if($paginate->page_total() > 1) {
                        if ($paginate->has_previous()) { ?>
                            <li class="page-item">
                                <a class="page-link" href="comments.php?page=<?php echo $paginate->previous() ."&pageSelect=". $items_per_page; ?>"
                                   tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <?php
                        }

                        for ($i = 1; $i <= $paginate->page_total(); $i++) {
                            if ($i == $paginate->current_page) {
                                echo "<li class='page-item active' aria-current='page'><a class='page-link' href='comments.php?page={$i}&pageSelect={$items_per_page}'>{$i}</a></li>";
                            } else {
                                echo "<li class='page-item'><a class='page-link' href='comments.php?page={$i}&pageSelect={$items_per_page}'>{$i}</a></li>";
                            }
                        }
                        if ($paginate->has_next()) {
                            ?>
                            <li class="page-item">
                                <a class="page-link" href="comments.php?page=<?php echo $paginate->next() ."&pageSelect=". $items_per_page; ?>">Next</a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </nav>

        </div>
</div>

<?php include ("includes/footer.php"); ?>

<script>
    function myPaginate(){
        document.myForm.submit();

    }
</script>