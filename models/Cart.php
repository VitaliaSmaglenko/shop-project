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
     * Returns the product id and its quantity from the session
     * @return bool|void
     */
    public function getProducts()
    {
        if($this->isCart()) {
              return $this->session->get('products');
        } else {
            return false;
        }
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

    /**
     *  Calculates the total price of products
     * @param $products
     * @return int
     */
    public function getPrice($products)
    {
        $cartProducts = $this->getProducts();
        $price = 0;
        if($cartProducts){
            for ($i=0; $i<count($products); $i++){
                 $price += $products[$i]->getPrice() * $cartProducts[$products[$i]->getId()];
            }
         }
        return $price;
    }

    public function clear()
    {

        if($this->isCart()){
            unset($_SESSION['products']);
        }
    }

    public function deleteProduct($id)
    {
        $cartProduct = $this->getProducts();
        unset($cartProduct[$id]);
        $this->session->set('products', $cartProduct);
        return;
    }
}