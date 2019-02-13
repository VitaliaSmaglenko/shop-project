<?php
/**
 * Service OrderService
 */
namespace Service;

use Model\CheckUser;
use Model\Buyers;
use Model\Orders;
use Model\ProductOrder;
use Model\Products;
use Model\User;
use App\Response;
use Model\Authenticate;
use App\Request;
use Model\Cart;

class OrderService
{
    /**
     * @var
     */
    private $errors;
    private $buyer;
    private $order;
    private $productOrder;
    private $product;
    private $user;
    private $isUser;
    private $request;
    private $cart;

    /**
     * OrderService constructor.
     */
    public function __construct()
    {
        $this->errors = new CheckUser();
        $this->buyer = new Buyers();
        $this->order = new Orders();
        $this->productOrder = new ProductOrder();
        $this->product = new Products();
        $this->user = new User();
        $this->isUser = new Authenticate();
        $this->request = new Request();
        $this->cart = new Cart();
    }

    /**
     * Method checks the validity of the data
     * @param array $options
     * @return array
     */
    public function errors(array $options):array
    {
        $errors = $this->errors->checkCheckout($options['firstName'], $options['lastName'], $options['phone']);
        return $errors;
    }

    /**
     * Return array with user data
     * @return array
     */
    public function setOptions():array
    {
        $options['firstName'] = $this->request->post('firstName');
        $options['lastName'] = $this->request->post('lastName');
        $options['phone'] = $this->request->post('phone');
        $options['comment'] = $this->request->post('comment');
        return $options;
    }

    /**
     * Adds buyer
     * @param array $options
     * @return bool
     */
    public function createBuyers(array $options):bool
    {
        $this->buyer->setLastName($options['lastName']);
        $this->buyer->setFirstName($options['firstName']);
        $this->buyer->setPhone($options['phone']);
        $this->buyer->setComment($options['comment']);
        $this->buyer->setData();
        $this->buyer->setUserId($options['userId']);
        $result = $this->buyer->createBuyers();
        return $result;
    }

    /**
     * Adds order
     * @param int $quantity
     * @param int $price
     * @return bool
     */
    public function createOrder(int $quantity, int $price):bool
    {
        $this->order->setIdBuyers($this->buyer->getBuyersId());
        $this->order->setTotalCount($quantity);
        $this->order->setTotalPrice($price);
        $this->order->createOrder();
        return true;
    }

    /**
     * Adds productOrder
     * @param array $cartProduct
     * @return bool
     */
    public function createProductOrder(array $cartProduct):bool
    {
        foreach ($cartProduct as $cartPr) {
            $this->productOrder->setIdOrders($this->order->getOrdersId());
            $item = $this->product->getById(key($cartProduct));
            next($cartProduct);
            $this->productOrder->setIdProduct($item->getId());
            $this->productOrder->setPrice($item->getPrice());
            $this->productOrder->setQuantity($cartPr);
            $this->productOrder->createProductOrder();
        }
        return true;
    }

    /**
     * Return information about price and quantity
     * @param array $cartProduct
     * @return array
     */
    public function totalInfo(array $cartProduct):array
    {
        $productsIds = array_keys($cartProduct);
        $items = $this->product->getByIds($productsIds);
        $info['price'] = $this->cart->getPrice($items);
        $info['quantity'] = $this->cart->countProducts();
        return $info;
    }

    /**
     * Return information about user
     * @return array
     */
    public function userInfo():array
    {
        $firstName = false;
        $lastName = false;
        $phone = false;
        $dataPage['phone'] = $phone;
        $dataPage['lastName'] = $lastName;
        $dataPage['firstName'] = $firstName;

        if ($this->isUser->isAuth()) {
            $userId = $this->isUser->checkLogged();
            if ($userId == false) {
                Response::redirect('/login');
            }
            $user =  $this->user->getById($userId);
            $firstName = $user->getFirstName();
            $dataPage['firstName'] = $firstName;
            $lastName = $user->getLastName();
            $dataPage['lastName'] = $lastName;
            $phone = $user->getPhone();
            $dataPage['phone'] = $phone;
        }
        return $dataPage;
    }

    /**
     * Check if user is authorized
     * @return mixed
     */
    public function isUser()
    {
        if (!$this->isUser->isAuth()) {
            $userId = false;
        } else {
            $userId = $this->isUser->checkLogged();
            if ($userId == false) {
                Response::redirect('/login');
            }
        }
        return $userId;
    }
}
