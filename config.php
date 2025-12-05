<?php

return [
    'production' => false,
    'baseUrl' => '',
    'title' => '摸摸鱼研究局',
    'description' => '研究对象包括向左移 1px 的必要性、这段代码删掉之后会不会崩溃、以及用户到底是根据什么判断要不要点开你的推送',
    'collections' => [
        'posts' => [
            'extends' => '_layouts.post',
            'path' => 'posts/{filename}',
            'sort' => '-date',
        ],
    ],
];
