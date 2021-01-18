<?php
defined('ABSPATH') || exit;

@include_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
$module = Newsletter::instance();
$controls = new NewsletterControls();

if (!$controls->is_action()) {
    $controls->data = $module->get_options('smtp');
} else {


    if ($controls->is_action('save')) {

        if ($controls->data['enabled'] && empty($controls->data['host'])) {
            $controls->errors = 'The host must be set to enable the SMTP';
        }

        if (empty($controls->errors)) {
            $module->save_options($controls->data, 'smtp');
            $controls->messages .= __('Saved. Remember to test your changes right now!', 'newsletter');
        }
    }

    if ($controls->is_action('test')) {
        
        $mailer = new NewsletterDefaultSMTPMailer($controls->data);
        $message = NewsletterMailerAddon::get_test_message($controls->data['test_email']);
        
        $r = $mailer->send($message);

        if (is_wp_error($r)) {
            $controls->errors = $r->get_error_message();
            $controls->errors .= '<br><a href="https://www.thenewsletterplugin.com/documentation/?p=15170" target="_blank"><strong>' . __('Read more', 'newsletter') . '</strong></a>.';

        } else {
            $controls->messages = 'Success.';
        }
        
    }
}

if (empty($controls->data['enabled']) && !empty($controls->data['host'])) {
    $controls->warnings[] = 'SMTP configured but NOT enabled.';
}
?>

<div class="wrap" id="tnp-wrap">

    <?php include NEWSLETTER_DIR . '/tnp-header.php'; ?>

	<div id="tnp-heading">

        <h2><?php _e('SMTP Settings', 'newsletter') ?></h2>
    
    <p>
        <i class="fas fa-info-circle"></i> <a href="https://www.thenewsletterplugin.com/extensions" target="_blank">Discover how SMTP services can boost your newsletters!</a>
        <!--
    <p>SMTP (Simple Mail Transfer Protocol) refers to external delivery services you can use to send emails.</p>
    <p>SMTP services are usually more reliable, secure and spam-aware than the standard delivery method available to your blog.</p>
    <p>Even better, using the <a href="https://www.thenewsletterplugin.com/extensions">integration extensions</a>, you can benefit of more efficient service connections, bounce detection and other nice features.</p>
        -->
    </p>
    
    <p>
            <strong>These options can be overridden by extensions which integrates with external
                SMTPs (like MailJet, SendGrid, ...) if installed and activated.</strong>
        </p>
        <p>

            What you need to know to use an external SMTP can be found
            <a href="https://www.thenewsletterplugin.com/plugins/newsletter/newsletter-configuration#smtp" target="_blank">here</a>.
            <br>
            On GoDaddy you should follow this <a href="https://www.thenewsletterplugin.com/godaddy-using-smtp-external-server-shared-hosting" target="_blank">special setup</a>.
        </p>
        <p>
            Consider <a href="https://www.sendinblue.com/?tap_a=30591-fb13f0&tap_s=626735-cdbaad" target="_blank">Sedinblue</a> (aff) for a serious and reliable SMTP service.
        </p>
    
    </div>

	<div id="tnp-body">

    <form method="post" action="">
        <?php $controls->init(); ?>

        <table class="form-table">
            <tr>
                <th>Enable the SMTP?</th>
                <td><?php $controls->yesno('enabled'); ?></td>
            </tr>
            <tr>
                <th>SMTP host/port</th>
                <td>
                    host: <?php $controls->text('host', 30); ?>
                    port: <?php $controls->text('port', 6); ?>
                    <?php $controls->select('secure', array('' => 'No secure protocol', 'tls' => 'TLS protocol', 'ssl' => 'SSL protocol')); ?>
                    <p class="description">
                        Leave port empty for default value (25).<br>
                        To use GMail, do not set the SMTP here but use a <a href="https://wordpress.org/plugins/search/smtp+gmail/" target="_blank">SMTP plugin which supprts oAuth 2.0</a><br>
                        On GoDaddy TRY to use "relay-hosting.secureserver.net".
                    </p>
                </td>
            </tr>
            <tr>
                <th>Authentication</th>
                <td>
                    user: <?php $controls->text('user', 30); ?>
                    password: <?php $controls->password('pass', 30); ?>
                    <p class="description">
                        If authentication is not required, leave "user" field blank.
                    </p>
                </td>
            </tr>
            <tr>
                <th>Insecure SSL Connections</th>
                <td>
                    <?php $controls->yesno('ssl_insecure'); ?> <a href="https://www.thenewsletterplugin.com/?p=21989" target="_blank">Read more</a>.
                </td>
            </tr>
            <tr>
                <th>Test email address</th>
                <td>
                    <?php $controls->text_email('test_email', 30); ?>
                    <?php $controls->button('test', 'Send a test email to this address'); ?>
                    <p class="description">
                        If the test reports a "connection failed", review your settings and, if correct, contact
                        your provider to unlock the connection (if possible).
                    </p>
                </td>
            </tr>
        </table>

        <p>
            <?php $controls->button_save(); ?>
        </p>

    </form>
</div>

    <?php include NEWSLETTER_DIR . '/tnp-footer.php'; ?>
    
</div>
