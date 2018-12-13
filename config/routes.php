<?php

return array(
    'category/([0-9])+' => 'catalog/category/$1',
    'product/([0-9])+' => 'product/view/$1',
    'catalog' => 'catalog/index',
    'cart' => 'cart/cart',
    'login'=>'login/index',
    '' => 'site/index',
);