<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 14.05.2018
 * Time: 1:32
 */

namespace app\admin\interfaces;

interface ITagEdit {

    public function addTag($tag, $id_product);

    public function deleteTag( $id_tag, $id_product );

}