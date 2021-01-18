<?php
/*
 * Name: Single image
 * Section: content
 * Description: A single image with link
 */

/* @var $options array */
/* @var $wpdb wpdb */

$defaults = array(
    'image' => '',
    'url' => '',
    'width' => 0,
    'block_background' => '#ffffff',
    'block_padding_left' => 0,
    'block_padding_right' => 0,
    'block_padding_bottom' => 15,
    'block_padding_top' => 15
);

$options = array_merge($defaults, $options);

$alt = '';
if (empty($options['image']['id'])) {
    $media = new TNP_Media();
    // A placeholder can be set by a preset and it is kept indefinitely
    if (!empty($options['placeholder'])) {
        $media->url = $options['placeholder'];
        $media->width = 600;
        $media->height = 250;
    } else {
        $media->url = 'https://source.unsplash.com/1200x500/daily';
        $media->width = 600;
        $media->height = 250;
    }
} else {
    $media = tnp_resize_2x($options['image']['id'], array(600, 0));
    // Should never happen but... it happens
    if (!$media) {
        echo 'The selected media file cannot be processed';
        return;
    }
    $media->alt = $options['image_alt'];
}

if (!empty($options['width'])) {
    $media->set_width($options['width']);
}
$media->link = $options['url'];
$image_class_name = 'image';
?>
<style>
    .<?php echo $image_class_name ?> {
        max-width: 100% !important;
        height: auto !important;
        display: block;
        width: <?php echo $media->width ?>px;
        line-height: 0;
        margin: 0 auto;
    }
</style>

<?php echo TNP_Composer::image( $media, [ 'class' => $image_class_name ] ); ?>
