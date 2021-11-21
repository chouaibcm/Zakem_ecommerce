<?php

return [
    'role_structure' => [
        'super_admin' => [            
            'products' => 'c,r,u,d',
            'dashboards' => 'r',
            'users' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'orders' => 'c,r,u,d',
            'clients' => 'c,r,u,d',
            'coupons' => 'c,r,u,d',
        ],
        'admin' => [],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete'
    ]
];
