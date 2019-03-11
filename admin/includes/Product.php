<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11/03/2019
 * Time: 11:13
 */

class Product extends Dbobject
{
    protected static $db_table = "products";
    protected static $db_table_fields = array('title', 'description', 'photo');

    public $id;
    public $title;
    public $description;
    public $photo;
    public $upload_directory = 'img'.DS.'products';
    public $image_placeholder = 'http://place-hold.it/400x400&text=image';
    public $return_path;

    function __construct()
    {

    }

    public function picture_path_product(){
        if($this->photo !== ""){
            return $this->return_path = $this->upload_directory.DS.$this->photo;
        }else{
            return $this->return_path = "http://place-hold.it/62x62";
        }
    }
    public function set_file_product($file){
        if(empty($file) || !$file || !is_array($file)) {
            $this->errors[] = "No file uploaded";
            return false;
        }
        elseif($file['error'] != 0){
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        }else{
            $path_parts = pathinfo($file['name']);
            $this->photo = $path_parts['filename'] .'_'.time(). '.' .$path_parts['extension'];
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }

    public function save_product_and_image(){
        $target_path = SITE_ROOT . DS . "admin" . DS . $this->upload_directory . DS . $this->photo;
        if($this->id){

            move_uploaded_file($this->tmp_path, $target_path);
            $this->update();
            unset($this->tmp_path);
            return true;
        }else{
            if(!empty($this->errors)){
                return false;
            }
            if(empty($this->photo) || empty($this->tmp_path)){
                $this->errors[]= "File not available";
                return false;
            }

            if (file_exists($target_path)){
                $this->errors[] = "File {$this->photo} exists!";
                return false;
            }
            if(move_uploaded_file($this->tmp_path, $target_path)){
                if($this->create()){
                    unset($this->tmp_path);
                    return true;
                }
            }
            else{
                $this->errors[]= "This folder has no write rights!";
                return false;
            }
        }
    }
    public function image_path_and_placeholder_product(){
        return empty($this->photo) ? $this->image_placeholder : $this->upload_directory.DS.$this->photo;
    }

    public function delete_product()
    {
        if ($this->delete()) {
            $target_path = SITE_ROOT . DS . "admin" . DS . $this->image_path_and_placeholder_product();
            return unlink($target_path) ? true : false;
        } else {
            return false;
        }
    }
}