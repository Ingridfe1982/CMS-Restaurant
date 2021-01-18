<?php

/* @var $fields NewsletterFields */

$fields->controls->data['schema'] = '';
?>
<?php $fields->select('schema', __('Schema', 'newsletter'), array('' => 'Custom', 'bright' => 'Bright', 'dark' => 'Dark', 'red' => 'Red'), ['after-rendering' => 'reload']) ?>

<?php $fields->text('text', __('Text', 'newsletter')) ?>
<?php $fields->font('font', false) ?>
<?php $fields->select('align', 'Alignment', array('center'=>'Center', 'left'=>'Left', 'right'=>'Right')) ?>


<?php $fields->block_commons() ?>
