<?php
/**
 * Controller ProductController
 */
use Base\Controller;
use Model\Products;
use Model\Authenticate;
use Model\FavoritesProduct;

class ProductController extends Controller
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

        $user = new Authenticate();
        $userId = $user->checkLogged();
        $dataPage['userId'] = $userId;
        $favorites = 0;
        $dataPage['favorites'] =$favorites;
        if ($userId != false) {
            $favoritesProduct = new FavoritesProduct();
            $favoritesProduct->setIdProduct($id);
            $favoritesProduct->setIdUser($userId);
            $favorites = $favoritesProduct->exist();
        }
        $dataPage['favorites'] =$favorites;
        $this->view->render('product.php', $dataPage);
        return true;
    }

    /**
     * Action for add to favorites
     * @param int $id
     * @return bool
     */
    public function actionFavorites(int $id):bool
    {
        $user = new Authenticate();
        $userId = $user->checkLogged();
        $favoritesProduct = new FavoritesProduct();
        $favoritesProduct->setIdProduct($id);
        $favoritesProduct->setIdUser($userId);
        $favoritesProduct->create();
        $path = ('/product/'.$id);
        header('Location:'.$path);
        return true;
    }
}
