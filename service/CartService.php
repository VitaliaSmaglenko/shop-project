<?php
/**
 * Service CartService
 */

namespace Service;

use Model\Products;
use Model\Cart;

class CartService
{
    /**
     * @var
     */
    private $products;
    private $cartProducts;

    /**
     * CartService constructor.
     */
    public function __construct()
    {
        $this->products = new Products();
        $this->cartProducts = new Cart();
    }

    /**
     * Returns information about products in cart
     * @param array $cart
     * @return array
     */
    public function cart(array $cart):array
    {
        $productsId = array_keys($cart);
        $products = $this->products->getByIds($productsId);

        if (count($products) !== count($cart)) {
            if (empty($products)) {
                $this->cartProducts->clear();
            }
            for ($i = 0; $i < count($products); $i++) {
                foreach ($cart as $k => $v) {
                    if ($products[$i]->getId() !== $k) {
                        $this->cartProducts->deleteProduct($k);
                    }
                }
            }
        }
        $dataPage['products'] = $products;
        $price = $this->cartProducts->getPrice($products);
        $dataPage['price'] = $price;
        return $dataPage;
    }
}
