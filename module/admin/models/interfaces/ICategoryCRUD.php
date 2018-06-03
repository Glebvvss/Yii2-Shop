<?php

namespace app\admin\interfaces;

interface ICategoryCRUD {

    public function addCategory( $category, $id_parent = null );

    public function deleteCategory( $id_category );

}