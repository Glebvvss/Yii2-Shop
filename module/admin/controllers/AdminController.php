<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 10.05.2018
 * Time: 2:49
 */

namespace app\module\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\ArrayHelper;
use app\models\db\Brands;
use app\models\db\Countries;
use app\admin\models\Category;
use app\models\SearchFilter;
use app\admin\models\AddProduct;

class AdminController extends Controller {

    public function actionIndex() {
        return $this->render('index');
    }

    public function actionProducts() {
        $this->layout = 'admin';
        $searchModel = new SearchFilter();
        $dataProvider = $searchModel->search( Yii::$app->request->get() );
        return $this->render('products', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionAddProduct() {
        $main_category_id = Yii::$app->request->post('main_category_id');
        $type_category_id = Yii::$app->request->post('type_category_id');
        $id_category = Yii::$app->request->post('category');
        $post = Yii::$app->request->post();
        $this->layout = 'admin';

        $add_product_model = new AddProduct();
        $add_product_model->id_category = $id_category;
        if ( $add_product_model->load($post) && $add_product_model->id_category && $add_product_model->validate() ) {
            $add_product_model->addProduct();
        }

        $brands_list_sql = Brands::find()->asArray()->all();
        $brands = ArrayHelper::map($brands_list_sql, 'id', 'brand');

        $country_list_sql = Countries::find()->asArray()->all();
        $countries = ArrayHelper::map($country_list_sql, 'id', 'country');

        $category = new Category();
        $categories = $category->getCategories( $main_category_id, $type_category_id );
        return $this->render('add-product', [
            'add_product_model' => $add_product_model,
            'main_category_id' => $main_category_id,
            'type_category_id' => $type_category_id,
            'categories' => $categories,
            'countries' => $countries,
            'brands' => $brands
        ]);
    }

    public function actionSelectCategoryInAddProductAjax() {
        $main_category_id = Yii::$app->request->post('main_category_id');
        $type_category_id = Yii::$app->request->post('type_category_id');
        $this->layout = false;

        $category = new Category();
        $categories = $category->getCategories( $main_category_id, $type_category_id );
        return $this->render('select-category-add-products', [
            'main_category_id' => $main_category_id,
            'type_category_id' => $type_category_id,
            'categories' => $categories
        ]);
    }

    public function actionCategories() {
        $this->layout = 'admin';
        return $this->render('index');
    }

}