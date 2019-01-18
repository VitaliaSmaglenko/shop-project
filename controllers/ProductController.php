<?php
/**
 * Controller ProductController
 */
use Model\Products;
use App\View;
class ProductController
{
    /**
     * Action for the product review page
     * @param $id
     * @return bool
     */

    public function actionView($id){
        $product = new Products();
        $dataPage['product'] = $product=$product->getById($id);
        $cart = new Model\Cart();
        $dataPage['cart'] = $cart = $cart->isProduct($id);
        $view = new View();
        $view->render('product.php',  $dataPage);
        return true;
    }

}