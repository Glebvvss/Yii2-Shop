<?php

namespace app\admin\interfaces;


interface IOrderFilter {

    public function getOrdersInDataProviderFormat( $filter = 'all' );

    public function changeStatusById( $id_order, $status );

}