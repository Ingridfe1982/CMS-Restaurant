<?php
/*
 * Name: Company Info
 * Section: footer
 * Description: Company Info for Can-Spam act requirements
 */

$default_options = array(
    'block_background' => '#ffffff',
    'font_family' => $font_family,
    'font_size' => 13,
    'font_color' => '#999999',
    'font_weight' => 'normal',
    'block_padding_top' => 15,
    'block_padding_bottom' => 15,
    'block_padding_left' => 15,
    'block_padding_right' => 15,
    'title'=>$info['footer_title'],
    'address'=>$info['footer_contact'],
    'copyright'=>$info['footer_legal'],
    
);
$options = array_merge($default_options, $options);
?>

<style>
    .canspam-text {
        padding: 10px; 
        text-align: center; 
        font-size: <?php echo $options['font_size'] ?>px; 
        font-family: <?php echo $options['font_family'] ?>; 
        font-weight: <?php echo $options['font_weight'] ?>; 
        color: <?php echo $options['font_color'] ?>;
    }
</style>

<div inline-class="canspam-text">
    <strong><?php echo esc_html($options['title']) ?></strong>
    <br>
    <?php echo esc_html($options['address']) ?>
    <br>
    <em><?php echo esc_html($options['copyright']) ?></em>
</div>
