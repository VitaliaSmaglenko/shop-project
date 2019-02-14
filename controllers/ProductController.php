<?php
/**
 * Controller ProductController
 */
use Base\Controller;
use Model\Products;
use Model\Authenticate;
use Model\FavoritesProduct;
use App\Response;
use Model\CommentProduct;
use App\Request;
use Service\ProductService;

class ProductController extends Controller
{
    /**
     * Action for the product review page
     * @param int $id
     * @return bool
     */

    public function actionView(int $id):bool
    {
        $productService = new ProductService();
        $comment = new CommentProduct();
        $request = new Request();
        $user = new Authenticate();
        $product = new Products();
        $product = $product->getById($id);
        $dataPage['product'] = $product;
        $cartObj = new Model\Cart();
        $dataPage['cart'] = $cartObj->isProduct($id);
        $userId = $user->checkLogged();
        $dataPage['userId'] = $userId;
        $favorites = 0;

        $dataPage['countComment'] = $comment->count($id);
        $dataPage['comment'] = $comment->get($id);
        $dataPage['nesComment'] = $productService->getNesComment($dataPage['comment']);

        if ($userId != false) {
            $favorites = $productService->favoritesProduct($userId, $id);

            if (null !== $request->post('submitAdd')) {
                $productService->createComment($userId, $id);
            }
            $show[] = false;
            if (null !==  $request->post('subReplay_'.$request->post('id'))) {
                $show[$request->post('id')] = true;
            }
            $dataPage['show'] = $show;

            if (null !==  $request->post('submitAddReplay_'.$request->post('id'))) {
                $productService->createNesComment($userId, $id);
            }
        }
        $dataPage['favorites'] = $favorites;
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
        Response::redirect($path);
        return true;
    }

    /**
     * Action for delete comment
     * @param int $id
     * @param int $idProd
     * @return bool
     */
    public function actionCommentDelete(int $id, int $idProd):bool
    {
        $comment = new CommentProduct();
        $comment->delete($id);
        $path = ('/product/'.$idProd);
        Response::redirect($path);
        return true;
    }

    public function actionReplayDelete(int $id, int $idProd):bool
    {
        $comment = new CommentProduct();
        $comment->deleteDaughter($id);
        $path = ('/product/'.$idProd);
        Response::redirect($path);
        return true;
    }
}
