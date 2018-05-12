<?php

namespace app\admin\models;

use yii\base\Model;
use app\models\db\Products;
use app\models\db\Tags;
use app\models\db\TagProduct;

class AddProduct extends Model {

    public $id_category;
    public $name_product;
    public $price;
    public $img;
    public $about;
    public $color;
    public $id_brand;
    public $id_country;
    public $about_large;
    public $specifications;

    public $tags;

    private $name_img;

    public function rules() {
        return [
            [['name_product', 'price', 'id_category'], 'required'],
            ['id_category', 'integer'],
            ['price', 'integer'],
            ['about', 'string']
        ];
    }

    public function addProduct() {
        $product = new Products();

        $product->specifications = $this->specifications;
        $product->name_product = $this->name_product;
        $product->about_large = $this->about_large;
        $product->id_category = $this->id_category;
        $product->id_country = $this->id_country;
        $product->id_brand = $this->id_brand;
        $product->img = $this->name_img;
        $product->price = $this->price;
        $product->color = $this->color;
        $product->about = $this->about;
        $product->save();
    }
}