<?php
/**
 * Service ProductService
 */
namespace Service;

use Model\CommentProduct;
use App\Request;
use Model\FavoritesProduct;
use App\Response;

class ProductService
{
    /**
     * @var
     */
    private $comment;
    private $request;
    private $favoritesProduct;

    /**
     * ProductService constructor.
     */

    public function __construct()
    {
        $this->comment = new CommentProduct();
        $this->request = new Request();
        $this->favoritesProduct = new FavoritesProduct();
    }

    /**
     * Add comment
     * @param int $userId
     * @param int $id
     */
    public function createComment(int $userId, int $id):void
    {
           $this->comment->setUserId($userId);
           $this->comment->setProductId($id);
           $this->comment->setData();
           $this->comment->setText($this->request->post('text'));
           $this->comment->create();
           Response::redirect('/product/'.$id);
    }

    /**
     * Add nested comment
     * @param int $userId
     * @param int $id
     */
    public function createNesComment(int $userId, int $id):void
    {
        $this->comment->setParentId($this->request->post('id'));
        $this->comment->setUserId($userId);
        $this->comment->setProductId($id);
        $this->comment->setData();
        $this->comment->setText($this->request->post('textReplay'));
        $this->comment->createDaughter();
        Response::redirect('/product/'.$id);
    }

    /**
     * Return list of nested comment
     * @param array $commentList
     * @return array
     */
    public function getNesComment(array $commentList):array
    {
        $nesCommentList = array();
        for ($i = 0; $i<count($commentList); $i++) {
            $nesCommentList[] = $this->comment->getDaughter($commentList[$i]->getId());
        }
        return $nesCommentList;
    }

    /**
     * Return exist product in favorites or not
     * @param int $userId
     * @param int $id
     * @return int
     */
    public function favoritesProduct(int $userId, int $id):int
    {
        $this->favoritesProduct->setIdProduct($id);
        $this->favoritesProduct->setIdUser($userId);
        return  $this->favoritesProduct->exist();
    }
}
