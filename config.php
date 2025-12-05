<?php

return [
    'production' => false,
    'baseUrl' => '',
    'title' => 'MoMoYu 的博客',
    'description' => '记录开发与生活的简单博客。',
    'collections' => [
        'posts' => [
            'extends' => '_layouts.post',
            'path' => 'posts/{filename}',
            'sort' => '-date',
        ],
    ],
];
