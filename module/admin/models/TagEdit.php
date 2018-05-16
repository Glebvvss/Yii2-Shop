<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 12.05.2018
 * Time: 14:32
 */

namespace app\admin\models;

use app\models\db\Tags;
use app\models\db\TagProduct;

use app\admin\interfaces\ITagEdit;

class TagEdit implements ITagEdit {

    public function addTag($tag, $id_product) {
        $tag = trim($tag);
        if ( $tag == null ) return;

        $tag = mb_strtolower($tag);
        $id_tag = $this->getTagId( $tag );
        $this->addRowTagProductToDb( $id_tag, $id_product );
    }

    private function getTagId( $tag ) {
        $selected_tag = Tags::findOne(['tag' => $tag]);

        if ( !$selected_tag ) {
            $tags = new Tags();
            $tags->tag = $tag;
            $tags->save();

            $selected_tag = Tags::findOne(['tag' => $tag]);
        }
        return $selected_tag->id;
    }

    private function addRowTagProductToDb( $id_tag, $id_product ) {
        $rowUnique = $this->checkDbRowOnUnique( $id_tag, $id_product );

        if ( $rowUnique ) {
            $tag_product = new TagProduct();
            $tag_product->id_tag = $id_tag;
            $tag_product->id_product = $id_product;
            $tag_product->save();
        }
    }

    private function checkDbRowOnUnique( $id_tag, $id_product  ) {
        $check_db = TagProduct::find()->where([
            'id_tag' => $id_tag,
            'id_product' => $id_product
        ])->one();

        if ( !$check_db ) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteTag( $id_tag, $id_product ) {
        TagProduct::findOne([ 'id_product' => $id_product, 'id_tag' => $id_tag ])->delete();

        $useless = $this->checkToUselessTag( $id_tag );
        if ( $useless === true ) {
            Tags::findOne(['id' => $id_tag])->delete();
        }
    }

    private function checkToUselessTag( $id_tag ) {
        $check = TagProduct::find()->where([ 'id_tag' => $id_tag ])->all();
        if ( $check ) {
            return false;
        }
        return true;
    }

}