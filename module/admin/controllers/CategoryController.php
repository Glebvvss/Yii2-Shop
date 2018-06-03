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
        $this->layout = 'admin';

        $categories = Categories::find()->asArray()->all();
        $categories_list_json = json_encode($categories);
        file_put_contents('json/admin/categories.json', $categories_list_json);
        return $this->render('categories');
    }

    public function actionDeleteCategory() {
        $category = Yii::$app->request->post('category');
        $this->layout = 'admin';

        $categoryCRUD = new CategoryCRUD();
        $categoryCRUD->deleteCategory($category);

        $this->redirect('/admin/category/categories');
    }

    public function actionAddCategory() {
        $category = Yii::$app->request->post('category');
        $id_parent = Yii::$app->request->post('parentId');
        $this->layout = 'admin';

        $categoryCRUD = new CategoryCRUD();
        $categoryCRUD->addCategory( $category, $id_parent );

        $this->redirect('/admin/category/categories');
    }

}