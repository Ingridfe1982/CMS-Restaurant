<?php

/* @var $options array contains all the options the current block we're ediging contains */
/* @var $controls NewsletterControls */
/* @var $fields NewsletterFields */
?>

<?php $controls->hidden('placeholder') ?>
<?php $fields->media('image', null, array('alt'=>true)) ?>

<?php $fields->url('url', 'URL') ?>
<?php $fields->size('width', 'Width') ?>
<?php $fields->block_commons() ?>

