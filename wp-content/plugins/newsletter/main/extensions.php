<?php
/* @var $this Newsletter */
defined('ABSPATH') || exit;

include_once NEWSLETTER_INCLUDES_DIR . '/controls.php';
$controls = new NewsletterControls();
$extensions = $this->getTnpExtensions();

$controls->data = get_option('newsletter_main');

if (isset($_POST['email']) && check_admin_referer('subscribe')) {
    $body = array();
    $body['ne'] = $_POST['email'];
    $body['nr'] = 'extensions';
    $body['nl'] = array('3', '4', '1');
    $body['optin'] = 'single';

    wp_remote_post('http://www.thenewsletterplugin.com/?na=ajaxsub', array('body' => $body));

    update_option('newsletter_subscribed', time(), false);

    $id = (int) $_POST['id'];
    wp_redirect(wp_nonce_url(admin_url('admin.php'), 'save') . '&page=newsletter_main_extensions&act=install&id=' . $id);
    die();
}

if ($controls->is_action('activate')) {
    $result = activate_plugin('newsletter-extensions/extensions.php');
    if (is_wp_error($result)) {
        $controls->errors .= __('Error while activating:', 'newsletter') . " " . $result->get_error_message();
    } else {
        wp_clean_plugins_cache(false);
        delete_transient("tnp_extensions_json");
        $controls->js_redirect('admin.php?page=newsletter_extensions_index');
        wp_die();
    }
}

?>

<div class="wrap" id="tnp-wrap">

    <?php include NEWSLETTER_DIR . '/tnp-header.php'; ?>


    <div id="tnp-body">
        <?php if (is_wp_error(validate_plugin('newsletter-extensions/extensions.php'))) { ?>
            <div id="tnp-promo">

                <h1>Supercharge Newsletter with our Professional Addons</h1>
                <div class="tnp-promo-how-to">
                    <h3>How to install:</h3>
                    <p>To add our addons, free or professional, you need to install our Addons Manager. But don't worry, it's super easy! Just click on "Download" button to download the zip file of
                        the Addon Manager from our website, then click on "Install" to upload the same zip file to your WordPress installation.</p>
                </div>
                <div class="tnp-promo-buttons">
                    <a class="tnp-promo-button" href="https://www.thenewsletterplugin.com/get-addons-manager"><i class="fas fa-cloud-download-alt"></i> Download Addons Manager</a>
                    <a class="tnp-promo-button" href="<?php echo admin_url('plugin-install.php?tab=upload') ?>"><i class="fas fa-cloud-upload-alt"></i> Install</a>
                </div>

            </div>
        <?php } elseif (is_plugin_inactive('newsletter-extensions/extensions.php')) { ?>
            <div id="tnp-promo">
                <div class="tnp-promo-how-to">
                    <p>Addons Manager seems installed but not active.</p>
                    <p>Activate it to install and update our free and professional addons.</p>
                </div>
                <div class="tnp-promo-buttons">
                    <a class="tnp-promo-button" href="<?php echo wp_nonce_url(admin_url('admin.php') . '?page=newsletter_main_extensions&act=activate', 'save'); ?>"><i class="fas fa-power-off"></i> Activate</a>
                </div>
            </div>
        <?php } ?>

        <?php if (is_array($extensions)) { ?>

            <!-- Extensions -->
            <h3 class="tnp-section-title">Additional professional features</h3>
            <?php foreach ($extensions AS $e) { ?>

                <?php if ($e->type == "extension" || $e->type == "premium") { ?>
                    <div class="<?php echo $e->free ? 'tnp-extension-free-box' : 'tnp-extension-premium-box' ?> <?php echo $e->slug ?>">

                        <?php if ($e->free) { ?>
                            <img class="tnp-extensions-free-badge" src="<?php echo plugins_url('newsletter') ?>/images/extension-free.png">
                        <?php } ?>
                        <div class="tnp-extensions-image"><img src="<?php echo $e->image ?>" alt="" /></div>
                        <h3><?php echo $e->title ?></h3>
                        <p><?php echo $e->description ?></p>
                    </div>
                <?php } ?>
            <?php } ?>

            <!-- Integrations -->
            <h3 class="tnp-section-title">Integrations with 3rd party plugins</h3>
            <?php foreach ($extensions AS $e) { ?>

                <?php if ($e->type == "integration") { ?>

                    <div class="<?php echo $e->free ? 'tnp-extension-free-box' : 'tnp-integration-box' ?> <?php echo $e->slug ?>">

                        <?php if ($e->free) { ?>
                            <img class="tnp-extensions-free-badge" src="<?php echo plugins_url('newsletter') ?>/images/extension-free.png">
                        <?php } ?>
                        <div class="tnp-extensions-image"><img src="<?php echo $e->image ?>"></div>
                        <h3><?php echo $e->title ?></h3>
                        <p><?php echo $e->description ?></p>
                    </div>
                <?php } ?>

            <?php } ?>

            <!-- Delivery -->
            <h3 class="tnp-section-title">Integrations with reliable mail delivery services</h3>
            <?php foreach ($extensions AS $e) { ?>

                <?php if ($e->type == "delivery") { ?>
                    <div class="<?php echo $e->free ? 'tnp-extension-free-box' : 'tnp-integration-box' ?> <?php echo $e->slug ?>">

                        <?php if ($e->free) { ?>
                            <img class="tnp-extensions-free-badge" src="<?php echo plugins_url('newsletter') ?>/images/extension-free.png">
                        <?php } ?>
                        <div class="tnp-extensions-image"><img src="<?php echo $e->image ?>" alt="" /></div>
                        <h3><?php echo $e->title ?></h3>
                        <p><?php echo $e->description ?></p>
                    </div>
                <?php } ?>

            <?php } ?>


        <?php } else { ?>

            <p style="color: white;">No addons available, try later.</p>

        <?php } ?>


        <p class="clear"></p>

    </div>

    <?php include NEWSLETTER_DIR . '/tnp-footer.php'; ?>

</div>

<script>
    function newsletter_subscribe(id) {
        document.getElementById("tnp-extension-id").value = id;
        jQuery("#tnp-subscribe-overlay").fadeIn(500);
    }
</script>

<div id="tnp-subscribe-overlay">
    <div id="tnp-subscribe-modal">
        <div>
            <img src="https://cdn.thenewsletterplugin.com/newsletters-img/tnp-logo-colore-text-white@2x.png">
        </div>
        <div id="tnp-subscribe-title">
            Subscribe our newsletter to get this extension<br>
            and be informed about updates and best practices.</div>
        <form method="post" action="?page=newsletter_main_extensions&noheader=true">
            <?php wp_nonce_field('subscribe'); ?>
            <input type="hidden" value="id" name="id" id="tnp-extension-id">
            <div id="tnp-subscribe-email-wrapper"><input type="email" id="tnp-subscribe-email" name="email" value="<?php echo esc_attr(get_option('admin_email')) ?>"></div>
            <div id="tnp-subscribe-submit-wrapper"><input type="submit" id="tnp-subscribe-submit" value="<?php esc_attr_e('Subscribe', 'newsletter') ?>"></div>
        </form>
        <div class="tnp-subscribe-no-thanks">
            <a href="javascript:void(jQuery('#tnp-subscribe-overlay').hide())">No thanks, I don't want to install the free extension</a>
        </div>
    </div>
</div>
