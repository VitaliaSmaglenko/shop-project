<?php
/**
 * Class Cart model for working with basket
 */

namespace Model;
use App\Session;

class Cart
{
    /**
     * @var Session
     */
    private $session;

    /**
     * Cart constructor.
     */
    public function __construct()
    {
        $this->session = new Session();
        $this->session->start();
    }

    /**
     * Adds products to cart
     * @param $id
     * @return bool
     */
    public function addProduct($id)
    {
        $products = array();
        if($this->isCart()) {
            $products = $_SESSION['products'];
        }
        if(array_key_exists($id, $products)){
            $products[$id] ++;
            } else {
            $products[$id] = 1;
        }
        $this->session->set('products', $products);
        return true;
    }

    /**
     * Counts items is session
     * @return int
     */
    public function countProducts()
    {
        if($this->isCart()) {
            $count = 0;
            foreach ($_SESSION['products'] as $id=>$amount){
                 $count = $count + $amount;
            }
            return $count;
        } else {
            return 0;
        }

    }

    /**
     * Checks for the existence of a session with products
     * @return bool
     */
    public function isCart()
    {
       if(isset($_SESSION['products'])){
            return true;
        } else return false;
    }

    /**
     * Checks item in session by id
     * @param $id
     * @return bool
     */
    public function isProduct($id)
    {
        if(isset($_SESSION['products'][$id])){
            return true;
        } else return false;
    }
}