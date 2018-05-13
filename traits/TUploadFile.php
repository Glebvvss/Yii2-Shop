<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 13.05.2018
 * Time: 15:29
 */

namespace app\traits;


trait TUploadFile {

   public $name_form_model = 'AddProduct';
   public $file_field_name = 'img';
   public $file_directory = 'images/product/';

    public function uploadFile( $id_product ) {
        if ( !$_FILES[ $this->name_form_model ] ) return;

        $extension = explode('/', $_FILES[ $this->name_form_model ]['type']['img']);
        $new_name_file = 'product' . $id_product . '.' . $extension[1];
        $tmp_name = $_FILES['EditProduct']['tmp_name']['img'];
        $name = $this->file_directory . $new_name_file;
        copy($tmp_name, $name);

        return $new_name_file;
    }

    protected function setFormModelClass($name_form_model) {
        $this->name_form_model = $name_form_model;
        return $this;
    }

    protected function setFileFieldName( $file_field_name ) {
        $this->file_field_name = $file_field_name;
        return $this;
    }

    protected function setDirectoryFile( $file_directory ) {
        $this->file_directory = $file_directory;
    }

}