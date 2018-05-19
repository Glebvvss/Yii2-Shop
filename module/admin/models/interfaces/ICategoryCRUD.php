<?php

namespace app\admin\interfaces;

interface ICategoryCRUD {

    public function addCategory( $category, $id_parent );

    public function deleteCategory( $id_category, $delete_products_by_category );

}