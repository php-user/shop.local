<?php

return array(
    /* Блок показа категорий и товаров */
    'product/([0-9]+)' => 'product/view/$1', // actionView in ProductController
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2', // actionCategory in CatalogController
    'category/([0-9]+)' => 'catalog/category/$1', // actionCategory in CatalogController
    'catalog/page-([0-9]+)' => 'catalog/index/$1', // actionIndex in CatalogController
    'catalog' => 'catalog/index', // actionIndex in CatalogController
    /* Блок регистрации и авторизации */
    'user/register' => 'user/register', // actionRegister in UserController
    'user/login' => 'user/login', // actionLogin in UserController
    'user/logout' => 'user/logout', // actionLogout in UserController
    /* Кабинет пользователя */
    'cabinet/edit' => 'cabinet/edit', // actionEdit in CabinetController
    'cabinet' => 'cabinet/index', // actionIndex in CabinetController
    /* Блок покупок */
    'cart/add/([0-9]+)' => 'cart/add/$1', // actionAdd in CartController
    'cart/addProduct/([0-9]+)' => 'cart/addProduct/$1', // actionAddProduct in CartController
    'cart/delete/([0-9]+)' => 'cart/delete/$1', // actionDelete in CartController
    'cart/order' => 'cart/order', // actionOrder in CartController
    'cart' => 'cart/index', // actionIndex in CartController
    /* Администраторская часть */
    'admin' => 'admin/index', // actionIndex in AdminController
    /* Главная страница */
    'contacts' => 'site/contact', // actionContact in SiteController
    '' => 'site/index', // actionIndex in SiteController
);