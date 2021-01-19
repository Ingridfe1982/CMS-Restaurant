<?php

/*
 * Name: Hero
 * Section: content
 * Description: Image, title, text and call to action all in one
 */

/* @var $options array */
/* @var $wpdb wpdb */

$defaults = array(
    'title' => 'An Awesome Title',
    'text' => 'This is just a simple text you should change',
    'font_family' => 'Helvetica, Arial, sans-serif',
    'font_size' => 18,
    'font_weight' => 'normal',
    'font_color' => '#000000',
    'title_font_family' => 'Helvetica, Arial, sans-serif',
    'title_font_size' => '32',
    'title_font_weight' => 'bold',
    'title_font_color' => '#000000',
    'block_background' => '#ffffff',
    'layout' => 'full',
    'button_url' => '',
    'button_font_family' => 'Helvetica, Arial, sans-serif',
    'button_label' => 'Click Here',
    'button_font_color' => '#ffffff',
    'button_font_weight' => 'bold',
    'button_font_size' => 20,
    'button_background' => '#256F9C',
    'block_padding_top' => 30,
    'block_padding_bottom' => 30,
    'block_padding_left' => 15,
    'block_padding_right' => 15
);

$options = array_merge($defaults, $options);

if (!empty($options['schema'])) {
    if ($options['schema'] === 'dark') {
        $options['block_background'] = '#000000';
        $options['title_font_color'] = '#ffffff';
        $options['font_color'] = '#ffffff';
        $options['button_font_color'] = '#ffffff';
        $options['button_background'] = '#96969C';
    }

    if ($options['schema'] === 'bright') {
        $options['block_background'] = '#ffffff';
        $options['title_font_color'] = '#000000';
        $options['font_color'] = '#000000';
        $options['button_font_color'] = '#ffffff';
        $options['button_background'] = '#256F9C';
    }
}

$layout = $options['layout'];

if ($layout == 'full') {
    $options = array_merge(array('block_padding_left' => 0, 'block_padding_right' => 0), $options);
} else {
    $options = array_merge(array('block_padding_left' => 15, 'block_padding_right' => 15), $options);
}

$font_family = $options['font_family'];
$font_size = $options['font_size'];
$font_weight = $options['font_weight'];
$font_color = $options['font_color'];

$title_font_family = $options['title_font_family'];
$title_font_size = $options['title_font_size'];
$title_font_weight = $options['title_font_weight'];
$title_font_color = $options['title_font_color'];

$layout = $options['layout'];

if (!empty($options['image']['id'])) {
    if ($layout == 'full') {
        $media = tnp_resize_2x($options['image']['id'], array(600, 0));
        if ($media) {
            $media->set_width(600 - $options['block_padding_left'] - $options['block_padding_right']);
        }
    } else {

        $media = tnp_resize_2x($options['image']['id'], array(300, 0));
        if ($media) {
            $media->set_width(300 - $options['block_padding_left']);
        }
    }
    if ($media) {
        $media->alt = $options['title'];
        $media->link = $options['button_url'];
    }
} else {
    $media = false;
}

switch ($layout) {
    case 'left':
        include __DIR__ . '/block-left.php';
        return;
    case 'right':
        include __DIR__ . '/block-right.php';
        return;
    case 'full':
        include __DIR__ . '/block-full.php';
        return;
}
