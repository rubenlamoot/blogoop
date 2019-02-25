<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/02/2019
 * Time: 15:03
 */

require_once("includes/header.php");

/** controle of er reeds is ingelogd */
if($session->is_signed_in()){
//    redirect("index.php");
    if(isAdmin2($session->user_id)){
        redirect("index.php");
    }else{
        redirect("../index.php");
    }
}



/** isset -> kijkt of er iets aanwezig is , dus geen NULL */
if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    /** check of user bestaat */
    $user_found = User::verify_user($username, $password);
    if($user_found){
        $session->login($user_found);
//        redirect("index.php");
        if(isAdmin2($user_found->id)){
            redirect("index.php");
        }else{
            redirect("../index.php");
        }
    }else{
        $the_message = "PASSWORD OR USERNAME NOT CORRECT";
    }
}else{
    $username = "";
    $password = "";
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 my-5">
            <h3 class="bg-warning text-white text-center">
                <?php echo $the_message; ?></h3>
            <form action="" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username"
                           value="<?php echo htmlentities($username); ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password"
                           value="<?php echo htmlentities($password); ?>">
                </div>
                <div class="form-group">
                    <input type="submit" value="Login" class="btn btn-primary" name="submit">
                </div>
            </form>
        </div>
    </div>
</div>

