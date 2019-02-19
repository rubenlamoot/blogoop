<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12/02/2019
 * Time: 15:11
 */

class Dbobject
{
    public static function find_this_query($sql){
        global $database;
        $result = $database->query($sql);
        $the_object_array = array();
        while ($row = mysqli_fetch_array($result)){
            $the_object_array[] = static::instantie($row);
        }

        return $the_object_array;
    }

    public static function find_all(){
//        global $database;
//        $result = $database->query("SELECT * FROM users");
//        return $result;
        return static::find_this_query("SELECT * FROM " .static::$db_table);
    }



    public static function find_by_id($id){
//        global $database;
//        $result = $database->query("SELECT * FROM users WHERE id = $id");
//        return $result;
        $the_result_array = static::find_this_query("SELECT * FROM " .static::$db_table . " WHERE id = $id LIMIT 1");
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function instantie($found_user){
        $calling_class = get_called_class(); /** late static binding */
        $the_object = new $calling_class;

//        $the_object = new self();
//        $the_object->id = $found_user['id'];
//        $the_object->username = $found_user['username'];
//        $the_object->password = $found_user['password'];
//        $the_object->first_name = $found_user['first_name'];
//        $the_object->last_name = $found_user['last_name'];

        foreach ($found_user as $the_attribute => $value){
            if($the_object->has_the_attribute($the_attribute)){
                $the_object->$the_attribute = $value;
            }
        }
        return $the_object;
    }

    private function has_the_attribute($the_attribute){
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }

    public function create()
    {
        global $database;
        $properties = $this->clean_properties(); /** object array variabele */

//        $sql = "INSERT INTO users (username, password, first_name, last_name) ";
        $sql = "INSERT INTO " .static::$db_table . " (" .implode(",", array_keys($properties)) . ") ";
        $sql .= "VALUES ('" .implode("','", array_values($properties)) . "')";

//        $sql .= $database->escape_string($this->username) . "', '";
//        $sql .= $database->escape_string($this->password) . "', '";
//        $sql .= $database->escape_string($this->first_name) . "', '";
//        $sql .= $database->escape_string($this->last_name) . "')";

        if($database->query($sql)){
            $this->id = $database->the_insert_id();
            return true;

        }else{
            return false;
        }
        $database->query($sql);
    }

    public function update(){
        global $database;
        $properties = $this->clean_properties();
        $properties_assoc = array();

        foreach ($properties as $key => $value) {
            $properties_assoc[] = "{$key}='{$value}'";
        }

//        $sql = "UPDATE users SET ";
        $sql = "UPDATE " . static::$db_table . " SET ";
        $sql .= implode(", ", $properties_assoc);
        $sql .= "WHERE id = " . $database->escape_string($this->id);

//        $sql .= "username= '" .$database->escape_string($this->username) . "', ";
//        $sql .= "password= '" .$database->escape_string($this->password) . "', ";
//        $sql .= "first_name= '" .$database->escape_string($this->first_name) . "', ";
//        $sql .= "last_name= '" .$database->escape_string($this->last_name) . "' ";
//        $sql .= "WHERE id= " .$database->escape_string($this->id);

        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;  /** checkt hoeveel rows er zouden veranderen */
    }

    public function delete(){
        global $database;

//        $sql = "DELETE FROM users ";
        $sql = "DELETE FROM " . static::$db_table . " ";
        $sql .= "WHERE id=" .$database->escape_string($this->id);
        $sql .= " LIMIT 1";

        $database->query($sql);
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;

    }

    public function save(){
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function properties(){
//        return get_object_vars($this);  /** alle variablen van een class worden automatisch ingelezen */
        $properties = array();
        foreach (static::$db_table_fields as $db_fields){
            if(property_exists($this, $db_fields)){
                $properties[$db_fields] = $this->$db_fields;
            }
        }
        return $properties;
    }

    public function clean_properties(){
        global $database;
        $clean_properties = array();

        foreach ($this->properties() as $key => $value) {
            $clean_properties[$key] = $database->escape_string($value);
        }
        return $clean_properties;
    }

    public static function count_all(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$db_table;
        $result = $database->query($sql);
        $row = mysqli_fetch_array($result);

        return array_shift($row);
    }
}

?>