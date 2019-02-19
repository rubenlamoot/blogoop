<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 7/02/2019
 * Time: 15:03
 */

require_once("includes/header.php");

$session->logout();

redirect("login.php");

?>