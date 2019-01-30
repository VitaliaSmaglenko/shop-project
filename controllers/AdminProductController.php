<?php
/**
 * Controller AdminProductController
 */
use Base\Controller;
use Model\Products;
use Model\Category;
use Model\ProductImages;
use Model\Authenticate;
use Model\User;
use App\Response;
use App\Request;


class AdminProductController extends Controller
{
    /**
     * AdminProductController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $isUser = new Authenticate();
        $userId = $isUser->checkLogged();
        if ($userId == false) {
            Response::redirect('/login');
        }
        $user = new User();
        $user = $user->getById($userId);
        if ($user->getRole() == "admin") {
            return true;
        }
        die("Access denied");
    }

    /**
     * @return bool
     */
    public function actionIndex():bool
    {
        $product = new Products();
        $productList = $product->getAdmin();
        $pageData['productList'] = $productList;

        $this->view->render('admin/products.php', $pageData);
        return true;
    }

    /**
     * @return bool
     */
    public function actionCreate():bool
    {
        $product = new Products();
        $category = new Category();
        $categories = $category->getAdmin();
        $dataPage['categories'] = $categories;
        $request = new Request();
        if (null !== $request->post("submitSave")) {
            $options['name'] = $request->post('name');
            $options['price'] = $request->post('price');
            $options['category_id'] = $request->post('category_id');
            $options['availability'] = $request->post('availability');
            $options['brand'] = $request->post('brand');
            $options['description'] = $request->post('description');
            $options['specifications'] = $request->post('specifications');
            $options['is_new'] = $request->post('is_new');
            $options['status'] = $request->post('status');

            $errors = false;

            foreach ($options as $option) {
                if (!isset($option) || strlen($option)== 0) {
                    $errors[] = "Fill in the field ".key($options);
                }
                next($options);
            }
            $dataPage['errors'] = $errors;

            if ($errors == false) {
                $product->setName($options['name']);
                $product->setPrice($options['price']);
                $product->setCategoryId($options['category_id']);
                $product->setAvailability($options['availability']);
                $product->setBrand($options['brand']);
                $product->setDescription($options['description']);
                $product->setSpecifications($options['specifications']);
                $product->setIsNew($options['is_new']);
                $product->setStatus($options['status']);
                $product->setUpdatedAt();
                $product->setCreatedAt();
                $lastId = $product->create();

                if ($lastId) {
                    if (is_uploaded_file($_FILES['image']["tmp_name"])) {
                        move_uploaded_file($_FILES['image']["tmp_name"],
                        $_SERVER['DOCUMENT_ROOT']."/components/img/".$lastId.".jpg");
                        $productImages = new ProductImages();
                        $productImages->setImage("img/".$lastId.".jpg");
                        $productImages->setProductId($lastId);
                        $productImages->create();
                    }
                }
                Response::redirect('/admin/product');
            }
        }
        unset($_POST);

        $this->view->render('admin/addProduct.php', $dataPage);
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function actionUpdate(int $id):bool
    {
        $product = new Products();
        $item = $product->getById($id);
        $dataPage['product'] = $item;
        $category = new Category();
        $categories = $category->getAdmin();
        $dataPage['categories'] = $categories;
        $request = new Request();
        if (null !== $request->post("submitEdit")) {
            $options['name'] = $request->post('name');
            $options['price'] = $request->post('price');
            $options['category_id'] = $request->post('category_id');
            $options['availability'] = $request->post('availability');
            $options['brand'] = $request->post('brand');
            $options['description'] = $request->post('description');
            $options['specifications'] = $request->post('specifications');
            $options['is_new'] = $request->post('is_new');
            $options['status'] = $request->post('status');
            $errors = false;

            foreach ($options as $option) {
                if (!isset($option) || strlen($option)== 0) {
                    $errors[] = "Fill in the field ".key($options);
                }
                next($options);
            }
            $dataPage['errors'] = $errors;

            if ($errors == false) {
                $product->setName($options['name']);
                $product->setPrice($options['price']);
                $product->setCategoryId($options['category_id']);
                $product->setAvailability($options['availability']);
                $product->setBrand($options['brand']);
                $product->setDescription($options['description']);
                $product->setSpecifications($options['specifications']);
                $product->setIsNew($options['is_new']);
                $product->setStatus($options['status']);
                $product->setUpdatedAt();
                $product->updateById($id);
                if (is_uploaded_file($_FILES['image']["tmp_name"])) {
                        move_uploaded_file($_FILES['image']["tmp_name"],
                            $_SERVER['DOCUMENT_ROOT']."/components/img/".$id.".jpg");
                        $productImages = new ProductImages();
                        $productImages->setImage("img/".$id.".jpg");
                        $productImages->updateById($id);
                }
                Response::redirect('/admin/product');
            }
        }
        unset($_POST);

        $this->view->render('admin/updateProduct.php', $dataPage);
        return true;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function actionDelete(int $id):bool
    {
        $pageData['id'] = $id;
        $request = new Request();


        if (null !== $request->post('submitDelete')) {
            $product = new Products();
            $product->deleteById($id);
            Response::redirect('/admin/product');
        }
        $this->view->render('admin/delete.php', $pageData);
        return true;
    }
}
