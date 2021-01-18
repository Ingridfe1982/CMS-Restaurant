<?php
/* @var $fields NewsletterFields */

$fields->controls->data['schema'] = '';
?>

<?php $fields->select('schema', __('Schema', 'newsletter'), array('' => 'Custom', 'bright' => 'Bright', 'dark' => 'Dark'), ['after-rendering' => 'reload']) ?>

<div class="tnp-field-row">
    <div class="tnp-field-col-2">
        <?php $fields->text('text', 'Button label') ?>
    </div>
    <div class="tnp-field-col-2">
        <?php $fields->url('url', 'Button URL') ?>
    </div>
</div>
<?php $fields->font('font', '') ?>
<?php $fields->color('background', 'Button background') ?>
<?php $fields->size('width', __('Width', 'newsletter')) ?>

<?php $fields->block_commons() ?>
