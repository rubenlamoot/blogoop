<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/03/2019
 * Time: 13:29
 */

class Role extends Dbobject
{
    protected static $db_table = "roles";
    protected static $db_table_fields = array('role');

    public $id;
    public $role;

    public static function find_the_roles($id){
        return static::find_this_query("SELECT roles.id, role FROM roles INNER JOIN users_roles ON roles.id = users_roles.role_id INNER JOIN users ON users_roles.user_id = users.id WHERE user_id = " .$id);
    }

    public function check_user_roles($id, $array_roles){
        $total = count($array_roles);
        for($i = 0; $i < $total; $i++){
            if($id === $array_roles[$i]){
                return true;
                break;
            }
        }
        return false;
    }

}