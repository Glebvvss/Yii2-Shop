<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 12.05.2018
 * Time: 15:08
 */

namespace app\admin\models;

use yii\base\Model;
use app\models\db\Products;
use app\models\db\Countries;
use app\models\db\Brands;

class EditProduct extends Model {

    public $id_category;
    public $name_product;
    public $price;
    public $img;
    public $about;
    public $color;
    public $brand;
    public $country;
    public $about_large;
    public $specifications;

    private $name_img;

    public function rules() {
        return [
            [[ 'price', 'name_product' ], 'required'],
            [['price', 'id_category'], 'integer'],
            ['img', 'file'],
            [['country', 'brand', 'color', 'specifications', 'about_large', 'about'], 'string']
        ];
    }

    public function updateProduct( $id_product ) {
        $id_country = $this->getIdCountry();
        $id_brand = $this->getIdBrand();

        $img_name = $this->uploadFile( $id_product );

        $product = Products::find()->where(['id' => $id_product])->one();
        $product->specifications = $this->specifications;
        $product->name_product = $this->name_product;
        $product->about_large = $this->about_large;
        $product->id_category = $this->id_category;
        $product->id_country = $id_country;
        $product->id_brand = $id_brand;
        $product->price = $this->price;
        $product->color = $this->color;
        $product->about = $this->about;
        $product->save();
    }

    private function uploadFile( $id_product ) {
        if ( $_FILES['EditProduct']['tmp_name']['img'] == null ) return;

        $extension = explode('/', $_FILES['EditProduct']['type']['img']);
        $new_name_file = 'product' . $id_product . '.' . $extension[1];
        $tmp_name = $_FILES['EditProduct']['tmp_name']['img'];
        $name = 'images/product/' . $new_name_file;
        copy($tmp_name, $name);
    }


    private function getIdCountry() {
        if ( !$this->country ) return;

        $country_row = Countries::findOne(['country' => $this->country]);
        if ( !$country_row ) {
            $countries = new Countries();
            $countries->country = $this->country;
            $countries->save();

            $country_row = Countries::findOne(['country' => $this->country]);
        }
        return $country_row->id;
    }

    private function getIdBrand() {
        if ( !$this->brand ) return;

        $brand_row = Brands::findOne(['brand' => $this->brand]);
        if ( !$brand_row ) {
            $brands = new Brands();
            $brands->brand = $this->brand;
            $brands->save();

            $brand_row = Brands::findOne(['brand' => $this->brand]);
        }
        return $brand_row->id;
    }

}