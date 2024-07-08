<?php

namespace Flynt\Components\BlockMap;

use Flynt\FieldVariables;

add_filter('acf/fields/google_map/api', function ($args) {
    $args['key'] = $_ENV['VITE_MAPS_API_KEY'];
    return $args;
});

add_filter('Flynt/addComponentData?name=BlockMap', function ($data) {
    $data['jsonData'] = [
        'options' => array_merge($data),
    ];
    return $data;
});

function getACFLayout()
{
    // Disables the element if no API key is set
    if ($_ENV['VITE_MAPS_API_KEY'] == false) {
        return [];
    }

    return [
        'name' => 'blockMap',
        'label' => __('Block: Map', 'flynt'),
        'sub_fields' => [
            [
                'label' => __('Content', 'flynt'),
                'name' => 'contentTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'label' => __('Map', 'flynt'),
                'name' => 'map',
                'type' => 'google_map'
            ],
            [
                'label' => __('Options', 'flynt'),
                'name' => 'optionsTab',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0
            ],
            [
                'label' => '',
                'name' => 'options',
                'type' => 'group',
                'layout' => 'row',
                'sub_fields' => [
                    FieldVariables\getTheme()
                ]
            ]
        ]
    ];
}
