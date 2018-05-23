<?php
/**
 * Created by PhpStorm.
 * User: Gleb
 * Date: 22.05.2018
 * Time: 17:19
 */

namespace app\admin\interfaces;


interface IOrderDetails {

    public function getBuyerInfo( $id_order );

    public function getDetailsOfOrder( $id_order );

}