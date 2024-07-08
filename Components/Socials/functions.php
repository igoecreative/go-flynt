<?php

namespace Flynt\Components\Socials;

use Flynt\Utils\Options;

add_action('init', function () {
});

add_filter('Flynt/addComponentData?name=Socials', function ($data) {
    return $data;
});

Options::addGlobal('Socials', [
  [
    'name' => 'socials',
    'label' => __('Socials', 'flynt'),
    'type' => 'repeater',
    'button_label' => __('Add Social', 'flynt'),
    'sub_fields' => [
      [
        'label' => __('Icon', 'flynt'),
        'name' => 'icon',
        'type' => 'text',
        'instructions' => __('Icons provided by Lucide! Just type in the name of the icon you want to use.', 'flynt')
      ],
      [
        'label' => __('Link', 'flynt'),
        'name' => 'link',
        'type' => 'url'
      ]
    ]
  ]
]);
