<?php

return array(

    'search/([A-z]+)/page-([0-9]+)' => 'catalog/search/$1/$2',
    'search//page-([0-9]+)' => 'catalog/search/',
    //feedback:
    'feedback' => 'feedback/sender',

    'delete/favorites/([0-9]+)' => 'cabinet/delete/$1',


    //admin:
    'admin/user/delete/([0-9]+)' => 'adminUser/delete/$1',
    'admin/user/edit-password/([0-9]+)' => 'adminUser/updatePassword/$1',
    'admin/user/edit/([0-9]+)' => 'adminUser/update/$1',
    'admin/user' => 'adminUser/index',

    'admin/orders/view/([0-9]+)' => 'adminOrders/show/$1',
    'admin/orders/delete/([0-9]+)' => 'adminOrders/delete/$1',
    'admin/orders/edit/([0-9]+)' => 'adminOrders/update/$1',
    'admin/orders' => 'adminOrders/index',

    'admin/category/add' => 'adminCategory/create',
    'admin/category/delete/([0-9]+)' => 'adminCategory/delete/$1',
    'admin/category/edit/([0-9]+)' => 'adminCategory/update/$1',
    'admin/category' => 'adminCategory/index',

    'admin/product/add' => 'adminProduct/create',
    'admin/product/delete/([0-9]+)' => 'adminProduct/delete/$1',
    'admin/product/edit/([0-9]+)' => 'adminProduct/update/$1',
    'admin/product' => 'adminProduct/index',
    'admin' => 'admin/index',
    //category:
    '([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2',
    'category/([0-9]+)' => 'catalog/category/$1',
    'category/product/([0-9])+' => 'product/view/$1',
        //'category/[a-z]+/([0-9])+' => 'catalog/category/$1',
    //products:
    'comment/delete/([0-9]+)/([0-9]+)' => 'product/commentDelete/$1/$2',
    'replay/delete/([0-9]+)/([0-9]+)' => 'product/replayDelete/$1/$2',
    'product/([0-9]+)' => 'product/view/$1',
    'favorites/([0-9]+)' => 'product/favorites/$1',
     //'catalog/page-([0-9]+)' => 'catalog/',
    'catalog/page-([0-9]+)' => 'catalog/index/$1',
    'category' => 'catalog/index',
    'category/by-price/([0-9])+' => 'catalog/priceCategory/$1',
    'by-price/page-([0-9])+' => 'catalog/price/$1',

    //cart:
    'add/([0-9]+)' => 'cart/add/$1',
    'cart' => 'cart/cart',
    'delete/([0-9]+)'=>'cart/delete/$1',
    'plus/([0-9]+)'=>'cart/plus/$1',
    'minus/([0-9]+)'=>'cart/minus/$1',
    //order:
    'checkout' => 'order/checkout',
    //registration:
    'register'=>'user/register',
    //authorisation:
    'login' => 'user/login',
    'logout' => 'user/logout',
    //cabinet
    'delete/favorites/([0-9]+)' => 'cabinet/delete/$1',
    'cabinet/favorites' => 'cabinet/favorites',
    'cabinet/orders' => 'cabinet/orders',
    'cabinet'=> 'cabinet/index',
    'edit'=> 'cabinet/edit',
    '([A-Za-z0-9]+)' => 'site/notFound',
    //main page:
    '' => 'site/index',
);
