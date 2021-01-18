<?php

/*
 * Name: Last posts
 * Section: content
 * Description: Last posts list with different layouts
 */

/* @var $options array */
/* @var $wpdb wpdb */

$defaults = array(
    'title' => 'Last news',
    'color' => '#999999',
    'font_family' => 'Helvetica, Arial, sans-serif',
    'font_size' => '16',
    'font_color' => '#333333',
    'title_font_family' => 'Helvetica, Arial, sans-serif',
    'title_font_size' => '25',
    'title_font_color' => '#333333',
    'title_font_weight' => 'normal',
    'max' => 4,
    'button_label' => __('Read more...', 'newsletter'),
    'categories' => '',
    'tags' => '',
    'block_background' => '#ffffff',
    'layout' => 'one',
    'language' => '',
    'button_background' => '#256F9C',
    'button_font_color' => '#ffffff',
    'button_font_family' => 'Helvetica, Arial, sans-serif',
    'button_font_size' => 16,
    'block_padding_left' => 15,
    'block_padding_right' => 15,
    'block_padding_top' => 15,
    'block_padding_bottom' => 15,
    'button_font_weight' => 'normal',
    'excerpt_length' => 30,
    'post_offset' => 0,
    'automated_include' => 'new',
    'inline_edits' => [],
    'automated_no_contents' => 'No new posts by now!',
    'automated' => '1'
);

// Backward compatibility
if (isset($options['automated_required'])) {
    $defaults['automated'] = '1';
}

$options = array_merge($defaults, $options);

$font_family = $options['font_family'];
$font_size = $options['font_size'];
$excerpt_length = $options['excerpt_length'];

$title_font_family = $options['title_font_family'];
$title_font_size = $options['title_font_size'];
$title_font_weight = $options['title_font_weight'];

$show_image = !empty($options['show_image']);

$filters = array();

$options['max'] = (int) $options['max'];
if ($options['layout'] == 'two') {
    $options['max'] = (int) floor($options['max'] / 2) * 2;
}

$filters['posts_per_page'] = $options['max'];
$filters['offset'] = max((int) $options['post_offset'], 0);

if (!empty($options['categories'])) {
    $filters['category__in'] = $options['categories'];
}

if (!empty($options['tags'])) {
    $filters['tag'] = $options['tags'];
}

if ($context['type'] != 'automated') {
    $posts = Newsletter::instance()->get_posts($filters, $options['language']);
} else {

    if (!empty($options['automated_disabled'])) {
        $posts = Newsletter::instance()->get_posts($filters, $options['language']);
    } else {
        // Can be empty when composing...
        if (!empty($context['last_run'])) {
            $filters['date_query'] = array(
                'after' => gmdate('c', $context['last_run'])
            );
        }

        $posts = Newsletter::instance()->get_posts($filters, $options['language']);
        if (empty($posts)) {
            if ($options['automated'] == '1') {
                $out['stop'] = true;
                return;
            } else if ($options['automated'] == '2') {
                $out['skip'] = true;
                return;
            } else {
                echo '<div inline-class="nocontents">', $options['automated_no_contents'], '</div>';
                return;
            }
        } else {
            if ($options['automated_include'] == 'max') {
                unset($filters['date_query']);
                $posts = Newsletter::instance()->get_posts($filters, $options['language']);
            }
        }
    }
}

if ($posts) {
    $out['subject'] = $posts[0]->post_title;
}

$current_language = Newsletter::instance()->get_current_language();
Newsletter::instance()->switch_language($options['language']);

$alternative = plugins_url('newsletter') . '/emails/blocks/posts/images/blank.png';
$alternative_2 = plugins_url('newsletter') . '/emails/blocks/posts/images/blank-240x160.png';

remove_all_filters('excerpt_more');

if ($options['layout'] == 'one') {
    include __DIR__ . '/layout-one.php';
} else if ($options['layout'] == 'two') {
    include __DIR__ . '/layout-two.php';
} else {
    include __DIR__ . '/layout-big-image.php';
}

Newsletter::instance()->switch_language($options['language']);

