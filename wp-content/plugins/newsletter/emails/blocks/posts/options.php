<?php
/* @var $options array contains all the options the current block we're ediging contains */
/* @var $controls NewsletterControls */
/* @var $fields NewsletterFields */

$extensions_url = '?page=newsletter_main_extension';
if (class_exists('NewsletterExtensions')) {
    $extensions_url = '?page=newsletter_extensions_index';
}
?>
<p>
    Custom post types can be added using our <a href="<?php echo $extensions_url ?>" target="_blank">Advanced Composer Blocks Addon</a>.
</p>

<?php if ($context['type'] == 'automated') { ?>

    <?php $fields->select('automated_disabled', '', ['' => 'Check for new posts since last newsletter', '1' => 'Do not check for new posts']) ?>

<div class="tnp-field-row">
    <div class="tnp-field-col-2">
    <?php
    $fields->select('automated_include', __('If there are new posts', 'newsletter'),
            [
                'new' => __('Include only new posts', 'newsletter'),
                'max' => __('Include specified max posts', 'newsletter')
            ],
            ['description' => ''])
    ?>
    </div>
    <div class="tnp-field-col-2">
    <?php
    $fields->select('automated', __('If there are not new posts', 'newsletter'),
            [
                '' => 'Show the message below',
                '1' => 'Do not send the newsletter',
                '2' => 'Remove this block'
            ],
            ['description' => ''])
    ?>
    <?php $fields->text('automated_no_contents', null, ['placeholder'=>'No new posts message']) ?>
    </div>
</div>



<?php } ?>


<?php $fields->select('layout', __('Layout', 'newsletter'), array('one' => __('One column', 'newsletter'), 
    'two' => __('Two columns', 'newsletter'),
    'big-image' => __('One column, big image', 'newsletter'))) ?>

<?php $fields->font('title_font', __('Title font', 'newsletter')) ?>

<?php $fields->number('excerpt_length', __('Excerpt words', 'newsletter'), array('min' => 0)); ?>

<?php $fields->font('font', __('Excerpt font', 'newsletter')) ?>

<div class="tnp-field-row">
    <label class="tnp-row-label"><?php _e('Dates and images', 'newsletter') ?></label>
    <div class="tnp-field-col-2">
        <?php $fields->checkbox('show_image', __('Show image', 'newsletter')) ?>
    </div>
    <div class="tnp-field-col-2">
        <?php $fields->checkbox('show_date', __('Show date', 'newsletter')) ?>
    </div>
    <div style="clear: both"></div>
</div>

<div class="tnp-field-row">
    <div class="tnp-field-col-2">
        <?php $fields->select_number('max', __('Max posts', 'newsletter'), 1, 40); ?>
    </div>
    <div class="tnp-field-col-2">
        <?php $fields->select_number('post_offset', __('Posts offset', 'newsletter'), 0, 20); ?>
    </div>
</div>

<?php $fields->language(); ?>

<?php $fields->button('button', 'Button', array('url' => false)) ?>

<?php $fields->section(__('Filters', 'newsletter')) ?>
<?php $fields->categories(); ?>
<?php $fields->text('tags', __('Tags', 'newsletter'), ['description' => __('Comma separated')]); ?>

<?php $fields->block_commons() ?>

