<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 01.04.2018
 * Time: 21:02
 */

namespace app\interfaces;

interface ICategoriesOfSidebar {

    public function getCategories(int $id_category);

}