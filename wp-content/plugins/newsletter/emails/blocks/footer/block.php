<?php
/*
 * Name: Footer
 * Section: footer
 * Description: View online ad profile links
 */

$default_options = array(
    'view' => 'View online',
    'profile' => 'Modify your subscription',
    'block_background' => '#ffffff',
    'font_family' => $font_family,
    'font_size' => 13,
    'font_color' => '#444444',
    'font_weight' => 'normal',
    'block_padding_left' => 15,
    'block_padding_right' => 15,
    'block_padding_bottom' => 15,
    'block_padding_top' => 15
);
$options = array_merge($default_options, $options);
?>
<style>
    .footer-text {
        font-size: <?php echo $options['font_size'] ?>px; 
        font-family: <?php echo $options['font_family'] ?>; 
        font-weight: <?php echo $options['font_weight'] ?>; 
        color: <?php echo $options['font_color'] ?>;
        text-decoration: none;
    }
</style>

<a inline-class="footer-text" href="{profile_url}" target="_blank"><?php echo esc_html($options['profile']) ?></a>

<span inline-class="footer-text">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span>

<a inline-class="footer-text" href="{email_url}" target="_blank"><?php echo esc_html($options['view']) ?></a>

