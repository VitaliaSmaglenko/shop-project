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
        $favoritesProduct = new FavoritesProduct();
        $product = new Products();
        $product = $product->getById($id);
        $dataPage['product'] = $product;
        $cartObj = new Model\Cart();
        $cart = $cartObj->isProduct($id);
        $dataPage['cart'] = $cart;
        $userId = $user->checkLogged();
        $dataPage['userId'] = $userId;
        $favorites = 0;
        $dataPage['favorites'] = $favorites;

        $commentList = $comment->get($id);

        $count = $comment->count($id);
        $dataPage['countComment'] = $count;
        $dataPage['comment'] = $commentList;
        $nesCommentList = array();
        for ($i = 0; $i<count($commentList); $i++) {
            $nesCommentList[] = $comment->getDaughter($commentList[$i]->getId());
        }

        $dataPage['nesComment'] = $nesCommentList;
        if ($userId != false) {
            $favoritesProduct->setIdProduct($id);
            $favoritesProduct->setIdUser($userId);
            $favorites = $favoritesProduct->exist();

            if (null !== $request->post('submitAdd')) {
                $comment->setUserId($userId);
                $comment->setProductId($id);
                $comment->setData();
                $comment->setText($request->post('text'));
                $comment->create();
                Response::redirect('/product/'.$id);
            }
            $show[] = false;
            if (null !==  $request->post('subReplay_'.$request->post('id'))) {
                $show[$request->post('id')] = true;
            }
            $dataPage['show'] = $show;

            if (null !==  $request->post('submitAddReplay_'.$request->post('id'))) {
                $comment->setParentId($request->post('id'));
                $comment->setUserId($userId);
                $comment->setProductId($id);
                $comment->setData();
                $comment->setText($request->post('textReplay'));
                $comment->createDaughter();
                Response::redirect('/product/'.$id);
            }
        }
        $dataPage['favorites'] = $favorites;
       // $dataPage['data'] = $productService->comment($id);

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
}
