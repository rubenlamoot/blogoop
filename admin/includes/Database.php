<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 6/02/2019
 * Time: 10:17
 */

require_once('config.php');

class Database
{
    /** variabelen */
    public $connection;  /** object variabele */

    /** constructor, dit wordt altijd automatisch uitgevoerd bij het aanroepen van deze classe */
    function __construct()
    {
        $this->open_db_connection();
    }

    /** methodes */
    public function open_db_connection(){
        $this->connection = mysqli_connect(DB_HOST,DB_USER, DB_PASS, DB_NAME);
        if(mysqli_connect_error()){
            die("Database connectie is mislukt" .mysqli_error());
        }
    }

    /**  */
    public function query($sql){
        $result = $this->connection->query($sql);
        $this->confirm_query($result);
        return $result;
    }

    /** result voert de query op de database uit */
    private function confirm_query($result){
        if(!$result){
            die("database query kon niet worden uitgevoerd" .$this->connection->error);
        }
    }

    /** beveiliging -> sql injecties vermijden*/
    public function escape_string($string){
        $escaped_string = $this->connection->real_escape_string($string);
        return $escaped_string;

    }

    /** mysqli_insert_id haalt de laatste uitgevoerde id op van een tabel die een primary key met auto increment heeft */
    public function the_insert_id(){
        return mysqli_insert_id($this->connection);
    }

}

$database = new Database();

?>