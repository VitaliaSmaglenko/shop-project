<?php

return array(
    //admin:
    'admin' => 'admin/index',
    //category:
    'category/page-([0-9]+)/([0-9])+' => 'catalog/category/$1/$2',
    'category/([0-9])+' => 'catalog/category/$1',
    'category/product/([0-9])+' => 'product/view/$1',
        //'category/[a-z]+/([0-9])+' => 'catalog/category/$1',
    //products:
    'product/([0-9])+' => 'product/view/$1',

    //'catalog/page-([0-9]+)' => 'catalog/',
    'catalog' => 'catalog/index',
    'category' => 'catalog/index',
    'category/by-price/([0-9])+' => 'catalog/priceCategory/$1',
    'by-price' => 'catalog/price',

    //cart:
    'add/([0-9]+)' => 'cart/add/$1',
    'cart' => 'cart/cart',
    'delete/([0-9])+'=>'cart/delete/$1',
    'plus/([0-9])+'=>'cart/plus/$1',
    'minus/([0-9])+'=>'cart/minus/$1',
    //order:
    'checkout' => 'order/checkout',
    //registration:
    'register'=>'user/register',
    //authorisation:
    'login' => 'user/login',
    'logout' => 'user/logout',
    //cabinet
    'cabinet'=> 'cabinet/index',
    'edit'=> 'cabinet/edit',
    //main page:
    '' => 'site/index',
);