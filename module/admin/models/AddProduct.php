<?php

namespace app\admin\models;

use yii\base\Model;
use app\models\db\Products;
use app\models\db\Countries;
use app\models\db\Brands;

class AddProduct extends Model {

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

    public function rules() {
        return [
            [[ 'price', 'name_product' ], 'required'],
            [['price', 'id_category'], 'integer'],
            ['img', 'file'],
            [['country', 'brand', 'color', 'specifications', 'about_large', 'about'], 'string']
        ];
    }

    public function addProduct() {
        $product = new Products();

        $id_country = $this->getIdCountryByCountry();
        $id_brand = $this->getIdBrandByBrand();

        if ( $this->issetFile() ) {
            $name_img = $this->uploadFile();
            $product->img = $name_img;
        }

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

        return Products::find()->max('id');
    }

    private function uploadFile() {
        $id_product = $this->idNewProduct();
        $extension = explode('/', $_FILES['AddProduct']['type']['img']);
        $new_name_file = 'product' . $id_product . '.' . $extension[1];
        $tmp_name = $_FILES['AddProduct']['tmp_name']['img'];
        $name = 'images/product/' . $new_name_file;
        copy($tmp_name, $name);

        return $new_name_file;
    }

    private function issetFile() {
        if ( $_FILES['AddProduct']['tmp_name']['img'] == null ) {
            return false;
        }
        return true;
    }

    private function idNewProduct() {
        $max_id = Products::find()->max('id');
        return $max_id + 1;
    }

    private function getIdCountryByCountry() {
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

    private function getIdBrandByBrand() {
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