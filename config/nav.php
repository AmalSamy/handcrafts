<?php

return [


    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard.dashboard',
        'title' => 'Dashboard',
        'active' => 'dashboard.dashboard',

    ],
    [
        'icon' => 'nav-icon fas fa-users',
        'route' => 'dashboard.users.index',
        'title' => 'users',
        'badge' => 'New',
        'active' => 'dashboard.users.*',
//        'ability'=> 'users.index'

    ],

    [
        'icon' => 'nav-icon fas fa-users',
        'route' => 'dashboard.admins.index',
        'title' => 'Admins',
        'badge' => 'New',
        'active' => 'dashboard.admins.*',
//        'ability'=> 'Admins.index'

    ],
    [
        'icon' => 'nav-icon fas fa-copy',
        'route' => 'dashboard.categories.index',
        'title' => 'categories',
        'badge' => 'New',
        'active' => 'dashboard.categories.*',
//        'ability'=> 'categories.index'


    ],
    [
        'icon' => 'nav-icon fas fa-th',
        'route' => 'dashboard.products.index',
        'title' => 'Products',
        'active' => 'dashboard.products.*',
//        'ability'=> 'products.index'


    ],
    [
        'icon' => 'nav-icon fas fa-th',
        'route' => 'dashboard.orders.index',
        'title' => 'Orders',
        'active' => 'dashboard.orders.*',
//         'ability'=> 'orders.index'


    ],

    [
        'icon' => 'nav-icon fas fa-th',
        'route' => 'dashboard.settings.index',
        'title' => 'settings',
        'active' => 'dashboard.settings.*',
        'ability' => 'settings.index'


    ],

    [
        'icon' => 'nav-icon fas fa-th',
        'route' => 'dashboard.common_questions.index',
        'title' => 'common_questions',
        'active' => 'dashboard.common_questions.*',
//        'ability'=> 'common_questions.index'

    ],
    [
        'icon' => 'nav-icon fas fa-th',
        'route' => 'dashboard.roles.index',
        'title' => 'roles',
        'active' => 'dashboard.roles.*',
//        'ability'=> 'roles.index'


    ],
];
