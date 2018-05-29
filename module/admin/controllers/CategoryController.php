<?php
/**
 * Created by PhpStorm.
 * User: Gleb
 * Date: 29.05.2018
 * Time: 1:09
 */

namespace app\module\admin\controllers;

use Yii;
use yii\web\Controller;
use app\admin\models\CategoryCRUD;
use app\models\db\Categories;

class CategoryController extends Controller {

    public function actionCategories() {
        $delete_products_by_category = Yii::$app->request->post('products-delete-by-category');
        $delete_category = Yii::$app->request->post('deleteCategory');
        $new_category = Yii::$app->request->post('addCategory');
        $id_parent = Yii::$app->request->post('parentId');
        $this->layout = 'admin';

        $categoryCRUD = new CategoryCRUD();
        if ( $new_category ) {
            $categoryCRUD->addCategory( $new_category, $id_parent );
        }
        if ( $delete_category ) {
            $categoryCRUD->deleteCategory($delete_category, $delete_products_by_category);
        }

        $categories = Categories::find()->asArray()->all();
        $categories_list_json = json_encode($categories);
        file_put_contents('json/admin/categories.json', $categories_list_json);
        return $this->render('categories');
    }

















}