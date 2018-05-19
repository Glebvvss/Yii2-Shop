<?php

namespace app\module\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\db\Products;
use app\models\db\TagProduct;
use app\models\db\SizeProduct;
use app\admin\models\CategoryCRUD;
use app\models\SearchFilter;
use app\admin\models\AddProduct;
use app\admin\models\EditProduct;
use app\admin\models\TagEdit;
use app\admin\models\SizeEdit;
use app\models\db\Categories;

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

        $categories = Categories::find()->asArray()->all();
        $categories_list_json = json_encode($categories);
        file_put_contents('json/admin/add-product.json', $categories_list_json);
        return $this->render('add-product', [
            'add_product_model' => $add_product_model
        ]);
    }

    public function actionEditProduct() {
        $id_category = Yii::$app->request->post('category');
        $id_product = Yii::$app->request->get('id_product');
        $this->layout = 'admin';

        $product_info = Products::find()->where(['products.id' => $id_product])
                                        ->joinWIth('brands')
                                        ->joinWIth('countries')
                                        ->one();

        $size_list = SizeProduct::find()->joinWith('sizes')
                                        ->where(['id_product' => $id_product])
                                        ->asArray()
                                        ->all();

        $tag_list = TagProduct::find()->joinWith('tags')
                                      ->asArray()
                                      ->where(['id_product' => $id_product])
                                      ->all();

        $edit_product_model = new EditProduct();
        if ( $edit_product_model->load( yii::$app->request->post() ) &&  $edit_product_model->validate() ) {
            $edit_product_model->updateProduct($id_product, $id_category);
        }

        $categoryCRUD = new CategoryCRUD();
        if ( $id_category ) {
            $json['selectedCategories'] = $categoryCRUD->getParentsOfCategoryById( $id_category );
        } else {
            $json['selectedCategories'] = $categoryCRUD->getParentsOfCategoryById( $product_info->id_category );
        }
        $json['allCategories'] = Categories::find()->asArray()->all();
        file_put_contents('json/admin/edit-product.json', json_encode($json) );
        return $this->render('edit-product', [
            'edit_product_model' => $edit_product_model,
            'product_info' => $product_info,
            'id_product' => $id_product,
            'size_list' => $size_list,
            'tag_list' => $tag_list
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

    public function actionAddSizeAjax() {
        $size = Yii::$app->request->post('size');
        $id_product = Yii::$app->request->post('id_product');
        $this->layout = false;

        $sizeEdit = new SizeEdit();
        $sizeEdit->addSize( $size, $id_product );

        $size_list = SizeProduct::find()->joinWith('sizes')
                                        ->asArray()
                                        ->where(['id_product' => $id_product])
                                        ->all();


        return $this->render('size-edit', [
            'id_product' => $id_product,
            'size_list' => $size_list
        ]);
    }

    public function actionDeleteSizeAjax() {
        $id_size = Yii::$app->request->post('id_size');
        $id_product = Yii::$app->request->post('id_product');
        $this->layout = false;

        $sizeEdit = new SizeEdit();
        $sizeEdit->deleteSize( $id_size, $id_product );

        $size_list = SizeProduct::find()->joinWith('sizes')
                                        ->asArray()
                                        ->where(['id_product' => $id_product])
                                        ->all();

        return $this->render('size-edit', [
            'id_product' => $id_product,
            'size_list' => $size_list
        ]);
    }

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

    public function actionOrders() {
        $this->layout = 'admin';
        return $this->render('orders', [

        ]);
    }

}