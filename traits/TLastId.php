<?php

namespace app\traits;

use app\models\db\Users;
use yii\db\Expression;

trait TLastId {

    protected function getLastUserId() {
        $id = Users::find()->select([
            'last_id'  => new Expression('MAX(users.id)')
        ])->asArray()->one();
        return $id['last_id'];
    }

}