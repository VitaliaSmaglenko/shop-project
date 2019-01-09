<?php

return array(
    //category:
    'category/([0-9])+' => 'catalog/category/$1',
    'category/product/([0-9])+' => 'product/view/$1',
        //'category/[a-z]+/([0-9])+' => 'catalog/category/$1',
    //products:
    'product/([0-9])+' => 'product/view/$1',

    'catalog' => 'catalog/index',
    //cart:
    'cart' => 'cart/cart',
    //registration:
    'login'=>'login/index',
    //main page:
    '' => 'site/index',
);