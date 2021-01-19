<?php
/*
 * Name: Header
 * Section: header
 * Description: Default header with company info
 */

$default_options = array(
    'font_family' => $font_family,
    'font_size' => 14,
    'font_color' => '#444444',
    'font_weight' => 'normal',
    'block_background' => '#ffffff',
    'block_padding_top' => 15,
    'block_padding_bottom' => 15,
    'block_padding_left' => 15,
    'block_padding_right' => 15,
    'layout' => ''
);
$options = array_merge($default_options, $options);

if (empty($info['header_logo']['id'])) {
    $media = false;
} else {
    $media = tnp_resize($info['header_logo']['id'], array(200, 80));
    if ($media) {
        $media->alt = $info['header_title'];
        $media->link = home_url();
    }
}

$empty = !$media && empty($info['header_sub']) && empty($info['header_title']);

if ($empty) {
    echo '<p>Please, set your company info.</p>';
} elseif ($options['layout'] === 'logo') {
    include __DIR__ . '/layout-logo.php';
    return;
}
?>

<style>
    .header-text {
        padding: 10px; 
        font-size: <?php echo $options['font_size'] ?>px; 
        font-family: <?php echo $options['font_family'] ?>; 
        font-weight: <?php echo $options['font_weight'] ?>; 
        color: <?php echo $options['font_color'] ?>;
        text-decoration: none;
        line-height: normal;
    }
    .header-title {
        font-size: <?php echo $options['font_size'] * 1.2 ?>px; 
        font-family: <?php echo $options['font_family'] ?>; 
        font-weight: <?php echo $options['font_weight'] ?>; 
        color: <?php echo $options['font_color'] ?>;
        text-decoration: none;
        line-height: normal;
    }
    .header-logo {
        font-family: <?php echo $options['font_family'] ?>; 
        line-height: normal;
        font-weight: <?php echo $options['font_weight'] ?>;
        color: <?php echo $options['font_color'] ?>;
    }
    .header-logo-img {
        display: inline-block; 
        max-width: 100%!important;
    }
</style>

<table border="0" cellpadding="0" cellspacing="0" width="100%" class="header-table">
    <tr>
        <td align="left" width="50%" inline-class="header-logo" class="header-logo-global">
            <?php if ($media) { ?>
                <a href="<?php echo home_url() ?>" target="_blank">
                    <img alt="<?php echo esc_attr($media->alt) ?>" src="<?php echo $media->url ?>" width="<?php echo $media->width ?>" height="<?php echo $media->height ?>" inline-class="header-logo-img" border="0">
                </a>
            <?php } else { ?>
                <a href="<?php echo home_url() ?>" target="_blank" inline-class="header-title">
                    <?php echo esc_attr($info['header_title']) ?>
                </a>
            <?php } ?>
        </td>
        <td width="50%" align="right" class="mobile-hide" inline-class="header-text">
            <?php echo esc_html($info['header_sub']) ?>
        </td>
    </tr>
</table>
