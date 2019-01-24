<?php
/**
 * Controller SiteController
 */
use Base\Controller;
use Model\Category;
use Model\Products;

class SiteController extends Controller
{

    /**
     * Action for main page
     * @return bool
     */
    public function actionIndex():bool
    {
        $categories = new Category();
        $categories = $categories->get();
        $dataPage['categories'] = $categories;
        $productList = new Products();
        $productList = $productList->get();
        $dataPage['productList'] =  $productList;

        //var_dump($productList);

        $cart = new Model\Cart();
        $visible[] = array();
        for ($i =0; $i < count($productList); $i++) {
            if (!isset($_SESSION['availability'.$productList[$i]->getId()])) {
                $cart->setAvailability($productList[$i]->getAvailability(), $productList[$i]->getId());
            }
            if ($_SESSION['availability'.$productList[$i]->getId()] == 0) {
                $visible[$i] = false;
            } else {
                $visible[$i] = true;
            }

        }
        $dataPage['visible'] = $visible;
        $this->view->render('index.php', $dataPage);
        return true;
    }

    /**
     * @return bool
     */
    public function actionNotFound():bool
    {
        $this->view->render('404.php');
        return true;
    }
}
