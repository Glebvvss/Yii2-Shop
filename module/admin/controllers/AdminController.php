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
use app\models\db\Products;
use app\models\db\TagProduct;
use app\admin\models\Category;
use app\models\SearchFilter;
use app\admin\models\AddProduct;
use app\admin\models\EditProduct;
use app\admin\models\TagEdit;

class AdminController extends Controller {

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
        $id_category = Yii::$app->request->post('category');
        $this->layout = 'admin';

        $add_product_model = new AddProduct();
        $add_product_model->id_category = $id_category;
        if ( $add_product_model->load( yii::$app->request->post() ) && $add_product_model->validate() ) {
            $id_product = $add_product_model->addProduct();
            $this->redirect( Yii::$app->urlManager->createUrl(['/admin/admin/edit-product', 'id_product' => $id_product]) );
        }

        $category = new Category();
        $categories = $category->getCategories();
        return $this->render('add-product', [
            'add_product_model' => $add_product_model,
            'categories' => $categories
        ]);
    }

    public function actionEditProduct() {
        $id_product = Yii::$app->request->get('id_product');
        $this->layout = 'admin';

        $product_info = Products::find()->where(['products.id' => $id_product])
                                        ->joinWIth('brands')
                                        ->joinWIth('countries')
                                        ->one();

        $tag_list = TagProduct::find()->joinWith('tags')
                                      ->asArray()
                                      ->where(['id_product' => $id_product])
                                      ->all();

        $edit_product_model = new EditProduct();
        if ( $edit_product_model->load( yii::$app->request->post() ) &&  $edit_product_model->validate() ) {
            $edit_product_model->updateProduct( $id_product );
        }

        $category = new Category();
        $categories = $category->getCategories( $main_category_id, $type_category_id );
        return $this->render('edit-product', [
            'edit_product_model' => $edit_product_model,
            '$main_category_id' => $main_category_id,
            'type_category_id' => $type_category_id,
            'product_info' => $product_info,
            'categories' => $categories,
            'id_product' => $id_product,
            'tag_list' => $tag_list
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

    public function actionAddTagAjax() {
        $tag = Yii::$app->request->post('tag');
        $id_product = Yii::$app->request->post('id_product');
        $this->layout = false;

        $tagEdit = new TagEdit();
        $tagEdit->addTag( $tag, $id_product );

        $tag_list = TagProduct::find()->joinWith('tags')
                                      ->asArray()
                                      ->where(['id_product' => $id_product])
                                      ->all();

        return $this->render('tag-edit', [
            'id_product' => $id_product,
            'tag_list' => $tag_list
        ]);
    }

    public function actionDeleteTagAjax() {
        $id_tag = Yii::$app->request->post('id_tag');
        $id_product = Yii::$app->request->post('id_product');
        $this->layout = false;

        $tagEdit = new TagEdit();
        $tagEdit->deleteTag( $id_tag, $id_product );

        $tag_list = TagProduct::find()->joinWith('tags')
                                      ->asArray()
                                      ->where(['id_product' => $id_product])
                                      ->all();

        return $this->render('tag-edit', [
            'id_product' => $id_product,
            'tag_list' => $tag_list
        ]);
    }

    public function actionCategories() {
        $this->layout = 'admin';
        return $this->render('index');
    }

}