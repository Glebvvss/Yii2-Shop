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
use app\models\ProductInfo;
use app\models\builders\ReviewOperationsBuilder;
use app\models\db\Categories;
use app\models\db\Products;

class ShopController extends Controller {
    
    public function actionProducts() {
        $id_category = (int) Yii::$app->request->get('id_category');
        $products_per_page = (int) Yii::$app->request->get('products_per_page');
        $sort_direction = Yii::$app->request->get('sort_direction');
        $sort_type = Yii::$app->request->get('sort_type');
        $tag = Yii::$app->request->get('tag');
        $tamplate_page_html = 'products';

        $category = Categories::findOne($id_category);
        $getProducts = new GetProductsBuilder();
        $getProductsObj = $getProducts->sortDirection($sort_direction)
                                      ->idCategory($id_category)
                                      ->sortType($sort_type)
                                      ->tag($tag)
                                      ->build();

        $query = $getProductsObj->getProducts();

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
            'category' => $category,
            'products' => $products,
            'pages' => $pages,
            'tag' => $tag
        ]);
    }

    public function actionProductSingle() {
        $id_product = Yii::$app->request->get('id_product');
        $template_page_html = 'product-single';

        $builder = new ReviewOperationsBuilder();
        $reviewOperations = $builder->idProduct($id_product)
                                    ->build();

        $reviews = $reviewOperations->selectReviewsByProduct();
        $product = ProductInfo::getInfo($id_product);
        return $this->render( $template_page_html, [
            'id_product' => $id_product,
            'reviews' => $reviews,
            'product' => $product,
        ]);
    }
}
