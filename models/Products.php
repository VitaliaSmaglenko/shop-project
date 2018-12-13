<?php


class Products
{
    public static function getProductsList(){
        $listProducts = include('listProduct.php');
        return $listProducts;
    }

    public static function getProductsItems($id){
            $listProducts = include('listProduct.php');
           // echo $listProducts['prod'.$id]['id'];
            if($id){
                if(array_key_exists('prod'.$id, $listProducts)){
                  //  echo $listProducts['prod'.$id]['id'];
                    return  $listProducts['prod'.$id]['id'];

                }

                }

            }


    public static function getProductsByCategory($id){
        if($id){

        }
    }

}