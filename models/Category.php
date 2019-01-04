<?php
namespace Model;

class Category{

    public static function getCategoryList(){
        $categore = array(
            'cat1' =>  array ('name' =>'ZTE',
                'id' =>'1',
                'sort' =>'0'),
            'cat2' =>  array ('name' =>'Xiaomi',
                'id' =>'2',
                'sort' =>'0'),
            'cat3' =>  array ('name' =>'DOOGEE',
                'id' =>'3',
                'sort' =>'0'),
            'cat4' =>  array ('name' =>'Fly',
                'id' =>'4',
                'sort' =>'0'),
            'cat5' =>  array ('name' =>'HomTom',
                'id' =>'5',
                'sort' =>'0')


        );
        return $categore;
    }
}