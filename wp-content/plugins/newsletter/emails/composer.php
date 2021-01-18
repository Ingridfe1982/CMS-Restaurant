<?php
defined('ABSPATH') || exit;

require_once NEWSLETTER_INCLUDES_DIR . '/controls.php';

$controls = new NewsletterControls();
$module = NewsletterEmails::instance();

wp_enqueue_style('tnpc-newsletter-style', home_url('/') . '?na=emails-composer-css');

include NEWSLETTER_INCLUDES_DIR . '/codemirror.php';

if ($controls->is_action()) {

    if (empty($_GET['id'])) {

        // Create a new email
        $email = new stdClass();
        $email->status = 'new';
        $email->track = Newsletter::instance()->options['track'];
        $email->token = $module->get_token();
        $email->message_text = "This email requires a modern e-mail reader but you can view the email online here:\n{email_url}.\nThank you, " . wp_specialchars_decode(get_option('blogname'), ENT_QUOTES) . 
            "\nTo change your subscription follow: {profile_url}.";
        $email->editor = NewsletterEmails::EDITOR_COMPOSER;
        $email->type = 'message';
        $email->send_on = time();
        $email->query = "select * from " . NEWSLETTER_USERS_TABLE . " where status='C'";
        
        TNP_Composer::update_email($email, $controls);

        $email = Newsletter::instance()->save_email($email);
    } else {

        $email = Newsletter::instance()->get_email($_GET['id']);
        TNP_Composer::update_email($email, $controls);
        $email = Newsletter::instance()->save_email($email);
        
    }

    $controls->add_message_saved();


    if ($controls->is_action('test')) {
        $module->send_test_email($module->get_email($email->id), $controls);
    }

    if ($controls->is_action('preview')) {
        $redirect = $module->get_admin_page_url('edit');
    } else {
        $redirect = $module->get_admin_page_url('composer');
    }

    $controls->js_redirect($redirect . '&id=' . $email->id);

    return;
} else {

    if (!empty($_GET['id'])) {
        $email = Newsletter::instance()->get_email((int) $_GET['id']);
        
    }
}

if (isset($email)) {
    TNP_Composer::prepare_controls($controls, $email);
}
?>

<div id="tnp-notification">
    <?php
        $controls->show();
        $controls->messages = '';
        $controls->errors = '';
    ?>
</div>

<div class="wrap tnp-emails-composer" id="tnp-wrap">

    <?php $controls->composer_load_v2(true); ?>

    <div id="tnp-heading" class="tnp-composer-heading">
        <div class="tnpc-logo">
            <p>The Newsletter Plugin <strong>Composer</strong></p>
        </div>
        <div class="tnpc-controls">
            <form method="post" action="" id="tnpc-form">
                <?php $controls->init(); ?>

                <?php $controls->composer_fields_v2(); ?>

                <?php $controls->button_confirm('reset', __('Back to last save', 'newsletter'), 'Are you sure?'); ?>
                <?php $controls->button('save', __('Save', 'newsletter'), 'tnpc_save(this.form); this.form.submit();'); ?>
                <?php $controls->button('preview', __('Next', 'newsletter') . ' &raquo;', 'tnpc_save(this.form); this.form.submit();'); ?>
            </form>
        </div>
    </div>
</div>
