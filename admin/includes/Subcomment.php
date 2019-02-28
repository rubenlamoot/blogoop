<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28/02/2019
 * Time: 15:43
 */

class Subcomment extends Dbobject
{
    protected static $db_table = "subcomments";
    protected static $db_table_fields = array('comment_id', 'user_id', 'body', 'date_time');

    public $id;
    public $comment_id;
    public $user_id;
    public $body;
    public $date_time;
}