<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 12.05.2018
 * Time: 14:32
 */

namespace app\admin\models;

use app\models\db\Sizes;
use app\models\db\SizeProduct;
use app\admin\interfaces\ISizeEdit;

class SizeEdit implements ISizeEdit {

    public function addSize($size, $id_product) {
        $size = trim($size);
        if ( $size == null ) return;

        $size = strtoupper($size);
        $id_size = $this->getSizeId( $size );
        $this->addRowSizeProductToDb( $id_size, $id_product );
    }

    private function getSizeId( $size ) {
        $selected_tag = Sizes::findOne(['size' => $size]);

        if ( !$selected_tag ) {
            $tags = new Sizes();
            $tags->size = $size;
            $tags->save();

            $selected_tag = Sizes::findOne(['size' => $size]);
        }
        return $selected_tag->id;
    }

    private function addRowSizeProductToDb( $id_size, $id_product ) {
        $rowUnique = $this->checkDbRowOnUnique( $id_size, $id_product );

        if ( $rowUnique ) {
            $size_product = new SizeProduct();
            $size_product->id_size = $id_size;
            $size_product->id_product = $id_product;
            $size_product->save();
        }
    }

    private function checkDbRowOnUnique( $id_size, $id_product  ) {
        $check_db = SizeProduct::find()->where([
            'id_size' => $id_size,
            'id_product' => $id_product
        ])->one();

        if ( !$check_db ) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteSize( $id_size, $id_product ) {
        SizeProduct::findOne([ 'id_product' => $id_product, 'id_size' => $id_size ])->delete();

        $useless = $this->checkToUselessSize( $id_size );
        if ( $useless === true ) {
            Sizes::findOne(['id' => $id_size])->delete();
        }
    }

    private function checkToUselessSize( $id_size ) {
        $check = SizeProduct::find()->where([ 'id_size' => $id_size ])->all();
        if ( $check ) {
            return false;
        }
        return true;
    }

}