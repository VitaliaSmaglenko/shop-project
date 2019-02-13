<?php
/**
 * Service ProductService
 */
namespace Service;

use Model\CommentProduct;
use App\Request;
use Model\Authenticate;
use Model\FavoritesProduct;
use App\Response;

class ProductService
{
    private $comment;
    private $request;
    private $user;
    private $favoritesProduct;

    public function __construct()
    {
        $this->comment = new CommentProduct();
        $this->request = new Request();
        $this->user = new Authenticate();
        $this->favoritesProduct = new FavoritesProduct();
    }

    public function comment($id)
    {

        $userId = $this->user->checkLogged();
        $dataPage['userId'] = $userId;
        $favorites = 0;
        $dataPage['favorites'] = $favorites;

        $commentList = $this->comment->get($id);

        $count = $this->comment->count($id);
        $dataPage['countComment'] = $count;
        $dataPage['comment'] = $commentList;
        $nesCommentList = array();
        for ($i = 0; $i<count($commentList); $i++) {
            $nesCommentList[] = $this->comment->getDaughter($commentList[$i]->getId());
        }

        $dataPage['nesComment'] = $nesCommentList;
        if ($userId != false) {
            $this->favoritesProduct->setIdProduct($id);
            $this->favoritesProduct->setIdUser($userId);
            $favorites = $this->favoritesProduct->exist();

            if (null !== $this->request->post('submitAdd')) {
                $this->comment->setUserId($userId);
                $this->comment->setProductId($id);
                $this->comment->setData();
                $this->comment->setText($this->request->post('text'));
                $this->comment->create();
                Response::redirect('/product/'.$id);
            }
            $show[] = false;
            if (null !==  $this->request->post('subReplay_'.$this->request->post('id'))) {
                $show[$this->request->post('id')] = true;
            }
            $dataPage['show'] = $show;

            if (null !==  $this->request->post('submitAddReplay_'.$this->request->post('id'))) {
                $this->comment->setParentId($this->request->post('id'));
                $this->comment->setUserId($userId);
                $this->comment->setProductId($id);
                $this->comment->setData();
                $this->comment->setText($this->request->post('textReplay'));
                $this->comment->createDaughter();
                Response::redirect('/product/'.$id);
            }
        }
        $dataPage['favorites'] = $favorites;
        return $dataPage;
    }
}
