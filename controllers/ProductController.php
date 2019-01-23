<?php
/**
 * Controller ProductController
 */
use Base\Controller;
use Model\Products;

class ProductController extends Base\Controller
{
    /**
     * Action for the product review page
     * @param int $id
     * @return bool
     */

    public function actionView(int $id):bool
    {
        $product = new Products();
        $product = $product->getById($id);
        $dataPage['product'] = $product;

        $cartObj = new Model\Cart();
        $cart = $cartObj->isProduct($id);

        if(!isset($_SESSION['availability'.$id])) {
            $cartObj->setAvailability($product->getAvailability(), $id);
            $count = $product->getAvailability();
            var_dump($count);
            $dataPage['count'] = $count;

        }
        else
        {
            $count = $_SESSION['availability'.$id];
            $dataPage['countProduct'] = $count;

        }

        $dataPage['cart'] = $cart;
        //$dataPage['count'] = $count;

        $this->view->render('product.php',  $dataPage);
        return true;
    }

}