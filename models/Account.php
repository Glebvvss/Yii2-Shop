<?php
/**
 * Created by PhpStorm.
 * User: Gleb
 * Date: 23.05.2018
 * Time: 4:02
 */

namespace app\models;

use Yii;
use app\models\db\Users;
use yii\base\Model;

class Account extends Model {

    public $first_name;
    public $last_name;
    public $mobile_phone;
    public $image;

    protected $image_name;

    public function rules() {
        return [
            [['first_name', 'last_name', 'mobile_phone'], 'required'],
            [['first_name', 'last_name'], 'string', 'length' => [2, 30]],
            ['mobile_phone', 'integer'],
            ['image', 'file', 'extensions' => 'png, jpg'],
        ];
    }

    public function getUserInformation() {
        $id_user = Yii::$app->user->getId();
        return Users::findOne(['id' => $id_user]);
    }

    public function updateUser() {
        if ( !$this->validate() ) return;

        if ( $this->image ) {
            $this->image_name = $this->createNameOfImageFile();
            $this->uploadImageFile();
        }

        $this->updateUserDb();
        return;
    }

    private function uploadImageFile() {
        if ( $this->validate() && $this->image ) {
            $file_name = $this->createNameOfImageFile();
            copy( $this->image->tempName, 'images/user/' .  $file_name);
        }
    }

    private function updateUserDb() {
        $user = Users::find()->where(['id' => Yii::$app->user->getId()])->one();

        if ( $this->image_name ) {
            $user->image_name = $this->image_name;
        }

        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->mobile_phone = $this->mobile_phone;
        $user->update();
    }

    private function createNameOfImageFile() {
        $id_user = Yii::$app->user->getId();
        $image_name = 'user' . $id_user . '.' . $this->image->extension;
        return $image_name;
    }

}