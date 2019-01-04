<?php

namespace Model;

class Products
{
    public static function getProductsList(){
        $listProducts = include('listProduct.php');
        return $listProducts;
    }

    public static function getProductsItems($id){
            $listProducts = include('listProduct.php');

            if($id){
                if(array_key_exists('prod'.$id, $listProducts)){

                    return  $listProducts['prod'.$id]['id'];

                }

                }

            }


    public static function getProductsByCategory($id){
        if($id){

        }
    }

    protected function  get()
    {
        $sql = 'INSERT TO blabala';
        $db = new PDODB();
        $db->execute($sql);

        return $obj;
    }

}