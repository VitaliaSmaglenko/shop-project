<?php

return array(
    //category:
    'category/page-([0-9]+)/([0-9])+' => 'catalog/category/$1/$2',
    'category/([0-9])+' => 'catalog/category/$1',
    'category/product/([0-9])+' => 'product/view/$1',
        //'category/[a-z]+/([0-9])+' => 'catalog/category/$1',
    //products:
    'product/([0-9])+' => 'product/view/$1',

    //'catalog/page-([0-9]+)' => 'catalog/',
    'catalog' => 'catalog/index',
    //cart:
    'cart' => 'cart/cart',
    //registration:
    'login'=>'login/index',
    //main page:
    '' => 'site/index',
);