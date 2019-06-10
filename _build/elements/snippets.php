<?php

return [
    'LeafMapX' => [
        'file' => 'leafmapx',
        'description' => 'LeafMapX snippet to list items',
        'properties' => [
            'tpl' => [
                'type' => 'textfield',
                'value' => 'tpl.LeafMapX.item',
            ],
            'sortby' => [
                'type' => 'textfield',
                'value' => 'name',
            ],
            'sortdir' => [
                'type' => 'list',
                'options' => [
                    ['text' => 'ASC', 'value' => 'ASC'],
                    ['text' => 'DESC', 'value' => 'DESC'],
                ],
                'value' => 'ASC',
            ],
            'limit' => [
                'type' => 'numberfield',
                'value' => 10,
            ],
            'toPlaceholder' => [
                'type' => 'combo-boolean',
                'value' => false,
            ],
        ],
    ],
];