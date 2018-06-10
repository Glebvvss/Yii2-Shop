<?php
/**
 * Created by PhpStorm.
 * User: Gleb
 * Date: 29.05.2018
 * Time: 1:08
 */

namespace app\module\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\db\Products;
use app\models\db\TagProduct;
use app\models\db\SizeProduct;
use app\admin\models\CategoryCRUD;
use app\admin\models\TableProduct;
use app\admin\models\AddProduct;
use app\admin\models\EditProduct;
use app\admin\models\TagEdit;
use app\admin\models\SizeEdit;
use app\models\db\Categories;
use app\models\db\Brands;
use app\models\db\OrderProduct;

class ProductController extends Controller {

    public function actionProducts() {
        $this->layout = 'admin';
        $tableProduct = new TableProduct();
        $dataProvider = $tableProduct->dataFilter( Yii::$app->request->get() );
        $brands = Brands::find()->asArray()->all();
        $categories = Categories::find()->asArray()->indexBy('id')->all();
        return $this->render('products', [
            'dataProvider' => $dataProvider,
            'tableProduct' => $tableProduct,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }

    public function actionAddProduct() {
        $id_category = Yii::$app->request->post('category');
        $this->layout = 'admin';

        $add_product_model = new AddProduct();
        $add_product_model->id_category = $id_category;
        if ( $add_product_model->load( yii::$app->request->post() ) && $add_product_model->validate() ) {
            $id_product = $add_product_model->addProduct();
            $this->redirect( Yii::$app->urlManager->createUrl(['/admin/product/edit-product', 'id_product' => $id_product]) );
        }

        $categories = Categories::find()->asArray()->all();
        $categories_list_json = json_encode($categories);
        file_put_contents('json/admin/add-product.json', $categories_list_json);
        return $this->render('add-product', [
            'add_product_model' => $add_product_model
        ]);
    }

    public function actionDeleteProduct() {
        $id_product = (int) Yii::$app->request->get('id_product');

        if ( !$id_product || $id_product == 0 ) {
            $this->redirect('/admin');
        }

        TagProduct::deleteAll(['id_product' => $id_product]);
        SizeProduct::deleteAll(['id_product' => $id_product]);
        //OrderProduct::deleteAll(['id_product' => $id_product]);
        Products::findOne($id_product)->delete();

        $this->redirect('/admin');
    }

    public function actionEditProduct() {
        $id_category = Yii::$app->request->post('category');
        $id_product = Yii::$app->request->get('id_product');
        $this->layout = 'admin';

        if ( !$id_product ) {
            $this->redirect('/admin');
        }

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

}