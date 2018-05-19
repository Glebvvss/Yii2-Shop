<?php

namespace app\admin\interfaces;

interface ISizeEdit{

    public function addSize($size, $id_product);

    public function deleteSize( $id_size, $id_product );

}