<?php

return [
    [
        'module' => 'Dashboard',
        'permissions' => [
            'view-dashboard'
        ],
    ],
    [
        'module' => 'Users',
        'permissions' => [
            'add-user',
            'edit-user',
            'delete-user',
        ],
    ],
    [
        'module' => 'Customers',
        'permissions' => [
            'view-customers',
            'block-customers',
            'notify-customers'
        ],
    ],
    [
        'module' => 'Orders',
        'permissions' => [
            'view-orders',
            'update-orders',
            'delete-orders',
        ],
    ],
    [
        'module' => 'Roles',
        'permissions' => [
            'add-roles',
            'edit-roles',
            'delete-roles',
        ],
    ],
];
