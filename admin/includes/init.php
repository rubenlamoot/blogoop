<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 6/02/2019
 * Time: 10:12
 */


defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', DS . 'wamp64' . DS . 'www' . DS . 'Blog_oop');
defined('INCLUDES_PATH') ? null : define('INCLUDES_PATH', SITE_ROOT.DS.'admin'.DS.'includes');
defined('IMAGES_PATH') ? null : define('IMAGES_PATH', SITE_ROOT.DS.'admin'.DS.'img');




require_once(INCLUDES_PATH.DS."functions.php");

require_once(INCLUDES_PATH.DS."config.php");
require_once(INCLUDES_PATH.DS."Database.php");

require_once(INCLUDES_PATH.DS."Dbobject.php");
require_once(INCLUDES_PATH.DS."User.php");
require_once(INCLUDES_PATH.DS."Photo.php");
require_once (INCLUDES_PATH.DS."Comment.php");
require_once(INCLUDES_PATH.DS."Subcomment.php");
require_once(INCLUDES_PATH.DS."Session.php");
require_once(INCLUDES_PATH.DS."Paginate.php");


?>