<?php
/**
 * Created by PhpStorm.
 * User: Gleb
 * Date: 30.05.2018
 * Time: 20:56
 */

namespace app\admin\models;

use Yii;
use yii\db\Query;
use app\admin\interfaces\IRoleEditor;

class RoleEditor implements IRoleEditor {

    public function changeRole(int $id_user, string $new_role) {
        $current_role = $this->getCurrentRole($id_user);
        if ( !$this->validateData( $id_user, $new_role, $current_role ) ) {
            return;
        };

        $this->removeCurrentRole($current_role, $id_user);
        $this->setNewRole( $new_role, $id_user);
    }

    private function validateData($id_user, $new_role, $current_role ) {
        $query = new Query();
        $check_new_role = $query->select('name')->from('auth_item')->where(['name' => $new_role])->createCommand()->queryOne();
        if ( $current_role == $new_role || !$current_role || !$check_new_role ) {
            return false;
        }
        return true;
    }

    private function setNewRole(string $role_name, int $id_user) {
        $auth = Yii::$app->authManager;
        $authorRole = $auth->getRole($role_name);
        $auth->assign($authorRole, $id_user);
    }

    private function removeCurrentRole(string $current_role, int $id_user) {
        $manager = Yii::$app->authManager;
        $item = $manager->getRole($current_role);
        $manager->revoke($item, $id_user);
    }

    private function getCurrentRole(int $id_user) {
        $query = new Query();
        $current_role = $query->select('item_name')
            ->from('auth_assignment')
            ->where(['user_id' => $id_user])
            ->createCommand()
            ->queryOne();

        return $current_role['item_name'];
    }

}