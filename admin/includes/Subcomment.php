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

    public static function find_the_subcomments($commentId){
        global $database;
        $sql = "SELECT * FROM " .self::$db_table;
        $sql .= " WHERE comment_id = " .$database->escape_string($commentId);
        $sql .= " ORDER BY id ASC";

        return self::find_this_query($sql);
    }

    public static function delete_the_subcomments($commentId){
        global $database;
        $sql = "DELETE FROM " .self::$db_table;
        $sql .= " WHERE comment_id = " .$database->escape_string($commentId);

        $database->query($sql);
        return (mysqli_affected_rows($database->connection) >= 1) ? true : false;
    }
}
