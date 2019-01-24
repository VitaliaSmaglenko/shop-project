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
        $dataPage['cart'] = $cart;
        $this->view->render('product.php', $dataPage);
        return true;
    }
}
