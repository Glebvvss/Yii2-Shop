<?php
/**
 * Created by PhpStorm.
 * User: Gleb
 * Date: 30.05.2018
 * Time: 21:12
 */

namespace app\admin\interfaces;


interface IRoleEditor {

    public function changeRole( int $id_user, string $new_role);

}