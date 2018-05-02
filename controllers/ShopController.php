<?php
/**
 * Created by PhpStorm.
 * User: gleb
 * Date: 26.03.2018
 * Time: 17:23
 */

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\builders\GetProductsBuilder;
use yii\data\Pagination;
use app\models\db\Products;
use app\models\db\SizeProduct;
use app\models\db\Categories;
use app\models\db\Reviews;
use app\models\SearchChildrenOfNodes;
use app\traits\TBuildTree;

class ShopController extends Controller {

    use TBuildTree;

    public function actionProducts() {
        //get vars
        $products_per_page = (int) Yii::$app->request->get('products_per_page');
        $id_category = (int) Yii::$app->request->get('id_category');
        $sort_direction = Yii::$app->request->get('sort_direction');
        $sort_type = Yii::$app->request->get('sort_type');
        $tag = Yii::$app->request->get('tag');
        $tamplate_page_html = 'products';
        //end of get vars

        //get products
        $getProducts = new GetProductsBuilder();
        $getProductsObj = $getProducts->sortDirection($sort_direction)
                                      ->idCategory($id_category)
                                      ->sortType($sort_type)
                                      ->tag($tag)
                                      ->build();

        $query = $getProductsObj->getProducts();
        //end of get products

        //create pagination
        if ( !$products_per_page ) $products_per_page = 9;
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => $products_per_page]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->createCommand()->queryAll();
        //end create pagination

        if ( Yii::$app->request->isAjax ) {
            $tamplate_page_html = 'products-ajax-update';
            $this->layout = false;
        }
        return $this->render( $tamplate_page_html, [
            'products_per_page' => $products_per_page,
            'sort_direction' => $sort_direction,
            'id_category' => $id_category,
            'sort_type' => $sort_type,
            'products' => $products,
            'pages' => $pages,
        ]);
    }

    public function actionProductSingle() {
        $id_product = Yii::$app->request->get('id_product');

        $sizes = SizeProduct::find()
            ->where(['id_product' => $id_product])
            ->joinWith('products')
            ->joinWith('sizes')
            ->asArray()
            ->all();

        $product = Products::find()
            ->where(['products.id' => $id_product])
            ->joinWith('countries')
            ->joinWith('brands')
            ->one();

        return $this->render('product-single', [
            'id_product' => $id_product,
            'product' => $product,
            'sizes' => $sizes
        ]);
    }

}
