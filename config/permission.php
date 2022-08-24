<?php

return [
    'system' => [
        'title' => '系统设置',
        'children' => [
            'managers' => [
                'title' => '人员管理',
                'items' => [
                    'check' => '查看',
                    'add' => '添加',
                    'delete' => '删除',
                    'update' => '修改'
                ]
            ],
            'role' => [
                'title' => '角色管理',
                'items' => [
                    'check' => '查看',
                    'add' => '添加',
                    'delete' => '删除',
                    'update' => '修改'
                ]
            ],
        ],
    ],
    'log' => [
        'title' => '日志管理',
        'children' => [
            'list' => [
                'title' => '日志列表',
                'items' => [
                    'check' => '查看',
                ]
            ]
        ]
    ]
];
