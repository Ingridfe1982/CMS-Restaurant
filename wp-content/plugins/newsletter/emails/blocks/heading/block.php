<?php
/*
 * Name: Heading
 * Section: content
 * Description: Section title
 */

$default_options = array(
    'text' => 'An Awesome Title',
    'align' => 'center',
    'block_background' => '#ffffff',
    'font_family' => $font_family,
    'font_size' => 30,
    'font_color' => '#444444',
    'font_weight' => 'normal',
    'block_padding_left' => 15,
    'block_padding_right' => 15,
    'block_padding_bottom' => 15,
    'block_padding_top' => 15
);
$options = array_merge($default_options, $options);

if (!empty($options['schema'])) {
    if ($options['schema'] === 'dark') {
        $options['block_background'] = '#000000';
        $options['font_color'] = '#ffffff';
    }
    
    if ($options['schema'] === 'bright') {
        $options['block_background'] = '#ffffff';
        $options['font_color'] = '#444444';
    }
    
    if ($options['schema'] === 'red') {
        $options['block_background'] = '#c00000';
        $options['font_color'] = '#ffffff';
    }
}
?>

<style>
    .heading-text-inline {
        padding: 10px; 
        text-align: <?php echo $options['align'] ?>; 
        font-size: <?php echo $options['font_size'] ?>px; 
        font-family: <?php echo $options['font_family'] ?>; 
        font-weight: <?php echo $options['font_weight'] ?>; 
        color: <?php echo $options['font_color'] ?>;
        line-height: normal!important;
        letter-spacing: normal;
    }
</style>

<div inline-class="heading-text-inline">
    <?php echo $options['text'] ?>
</div>
