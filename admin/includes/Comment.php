<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18/02/2019
 * Time: 13:39
 */

class Comment extends Dbobject
{
    protected static $db_table = "comments";
    protected static $db_table_fields = array('photo_id', 'user_id', 'author', 'body', 'date_time');

    public $id;
    public $photo_id;
    public $user_id;
    public $author;
    public $body;
    public $date_time;

    public static function create_comment($photo_id, $author="Test", $body=""){
        if(!empty($photo_id) && !empty($author) && !empty($body)){
            $comment = new Comment();
            $comment->photo_id = (int)$photo_id; //typecasting
            $comment->author = $author;
            $comment->body = $body;

            return $comment;
        }else{
            return false;
        }
    }

    public static function find_the_comments($photo_id){
        global $database;
        $sql = "SELECT * FROM " .self::$db_table;
        $sql .= " WHERE photo_id = " .$database->escape_string($photo_id);
        $sql .= " ORDER BY photo_id ASC";

        return self::find_this_query($sql);
    }
}

?>