<?php
return [
    'adminEmail' => 'admin@example.com',
    // rbac 将运用权限管理的模块的配置 module ID => ''
    'authModules' => [
        //module ID
        'auth-management' =>  [
            'module_path' => 'authManagement',// 相对backend的module的目录
            'module_request_route' => 'auth-management', //通过原始的路由访问时的路由module部分由module ID组成(唯一标示了不同模块的目录)
        ],
    ],
];
