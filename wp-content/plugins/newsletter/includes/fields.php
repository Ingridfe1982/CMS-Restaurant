<?php

class NewsletterFields {

    /* @var NewsletterControls */
    var $controls;

    public function __construct(NewsletterControls $controls) {
        $this->controls = $controls;
    }

    public function _open($subclass = '') {
        echo '<div class="tnp-field ', $subclass, '">';
    }

    public function _close() {
        echo '</div>';
    }

    public function _label($text, $for = '') {
        if (empty($text)) {
            return;
        }
        // Do not escape, HTML allowed
        echo '<label class="tnp-label">', $text, '</label>';
    }

    public function _description($attrs) {
        if (empty($attrs['description'])) {
            return;
        }
        // Do not escape, HTML allowed
        echo '<div class="tnp-description">', $attrs['description'], '</div>';
    }

    public function _id($name) {
        return 'options-' . esc_attr($name);
    }

    public function _name($name) {
        return 'options[' . esc_attr($name) . ']';
    }

    /**
     * Adds some empty basic atributes to avoid the isset() checking.
     * 
     * @param array $attrs
     * @return array
     */
    public function _merge_base_attrs($attrs) {
        return array_merge(['description' => '', 'label' => '', 'help_url' => ''], $attrs);
    }

    /** Adds some basic attributes and the provided default ones.
     * 
     * @param array $attrs
     * @param array $defaults
     * @return array
     */
    public function _merge_attrs($attrs, $defaults = []) {
        return array_merge(['description' => '', 'label' => '', 'help_url' => ''], $defaults, $attrs);
    }

    /**
     * A form section title.
     * 
     * @param string $title
     */
    public function section($title = '') {
        // Do not escape, HTML allowed
        echo '<h3 class="tnp-section">', $title, '</h3>';
    }

    public function separator() {
        echo '<div class="tnp-field tnp-separator"></div>';
    }

    public function checkbox($name, $label = '', $attrs = []) {
        $attrs = $this->_merge_base_attrs($attrs);
        $this->_open('tnp-checkbox');
        $this->controls->checkbox($name, $label);
        $this->_description($attrs);
        $this->_close();
    }

    /** General Input field with default type = text 
     * 
     * Attributes:
     * - label_after (default: none): small text ti be displayed after the text field
     * - min (default: none): minimum number of characters
     * - max (default: none): maximum number of characters
     * - size (default: none): size in pixels
     */
    public function input($name, $label = '', $attrs = []) {
        $attrs = $this->_merge_attrs($attrs, ['placeholder' => '', 'size' => 0, 'label_after' => '', 'type' => 'text']);
        $this->_open();
        $this->_label($label);
        $value = $this->controls->get_value($name);

        echo '<input id="', $this->_id($name), '" placeholder="', esc_attr($attrs['placeholder']), '" name="', $this->_name($name), '" type="', esc_attr($attrs['type']), '"';

        if (!empty($attrs['size'])) {
            echo ' style="width: ', $attrs['size'], 'px"';
        }

        if (isset($attrs['min'])) {
            echo ' min="' . (int) $attrs['min'] . '"';
        }

        if (isset($attrs['max'])) {
            echo ' max="' . (int) $attrs['max'] . '"';
        }

        echo ' value="', esc_attr($value), '">';

        if (!empty($attrs['label_after'])) {
            echo $attrs['label_after'];
        }

        $this->_description($attrs);
        $this->_close();
    }

    public function text($name, $label = '', $attrs = []) {
        $attrs['type'] = 'text';
        $this->input($name, $label, $attrs);
    }

    public function number($name, $label = '', $attrs = []) {
        $attrs = array_merge(['type' => 'number'], $attrs);
        $this->input($name, $label, $attrs);
    }

    /**
     * A set of text fields, named $name_1, $name_2, ...
     * 
     * Attributes:
     * - label_after: a label to show after the field column
     * 
     * @param type $name
     * @param type $label
     * @param type $count
     * @param type $attrs
     */
    public function multitext($name, $label = '', $count = 10, $attrs = []) {
        $attrs = $this->_merge_attrs($attrs, ['description' => '', 'placeholder' => '', 'size' => 0, 'label_after' => '']);
        $this->_open();
        $this->_label($label);

        for ($i = 1; $i <= $count; $i++) {
            $value = $this->controls->get_value($name . '_' . $i);
            echo '<input id="', $this->_id($name . '_' . $i), '" placeholder="', esc_attr($attrs['placeholder']), '" name="options[', $name, '_', $i, ']" type="text"';
            if (!empty($attrs['size'])) {
                echo ' style="width: ', $attrs['size'], 'px"';
            }
            echo ' value="', esc_attr($value), '">';
        }
        if (!empty($attrs['label_after'])) {
            echo $attrs['label_after'];
        }
        $this->_description($attrs);
        $this->_close();
    }

    public function textarea($name, $label = '', $attrs = []) {
        $attrs = $this->_merge_attrs($attrs);
        $this->_open();
        $this->_label($label);
        $this->controls->textarea_fixed($name, '100%', '150');
        $this->_description($attrs);
        $this->_close();
    }

    public function wp_editor($name, $label = '', $attrs = []) {
        global $wp_version;

        $attrs = $this->_merge_attrs($attrs);
        $this->_open();
        $this->_label($label);
        $value = $this->controls->get_value($name);
        $name = esc_attr($name);

        // Uhm...
        if (is_array($value)) {
            $value = implode("\n", $value);
        }
        if (version_compare($wp_version, '4.8', '<')) {
            echo '<p><strong>Rich editor available only with WP 4.8+</strong></p>';
        }
        echo '<textarea class="tnpf-wp-editor" id="options-', $name, '" name="options[', $name, ']" style="width: 100%;height:250px">';
        echo esc_html($value);
        echo '</textarea>';

        if (version_compare($wp_version, '4.8', '>=')) {
            echo '<script>wp.editor.remove("options-', $name, '");';
            echo 'wp.editor.initialize("options-', $name, '", { tinymce: {content_style: "body {background-color: #f4f4f4;}", toolbar1: "undo redo | formatselect fontselect fontsizeselect | bold italic forecolor backcolor | link unlink | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | wp_add_media | charmap | rtl ltr", fontsize_formats: "11px 12px 14px 16px 18px 24px 36px 48px", plugins: "link textcolor colorpicker lists wordpress charmap directionality", default_link_target: "_blank", relative_urls : false, convert_urls: false}});</script>';
        }
        $this->_description($attrs);
        $this->_close();
    }

    /**
     * Attributes:
     * - realod: when true is forces a submit of the form (used to change the form fields or values for example when changing layout or color scheme)
     * 
     * @param type $name
     * @param type $label
     * @param type $options
     * @param type $attrs
     */
    public function select($name, $label = '', $options = [], $attrs = []) {
        $attrs = $this->_merge_attrs($attrs, ['reload' => false, 'after-rendering' => '']);
        $this->_open();
        $this->_label($label);
        $value = $this->controls->get_value($name);

        echo '<select id="', $this->_id($name), '" name="', $this->_name($name), '"';
        if ($attrs['reload']) {
            echo ' onchange="tnpc_reload_options(event)"';
        }
        if (!empty($attrs['after-rendering'])) {
            echo ' data-after-rendering="', $attrs['after-rendering'], '"';
        }
        echo '>';
//        if (!empty($first)) {
//            echo '<option value="">', esc_html($first), '</option>';
//        }

        foreach ($options as $key => $text) {
            echo '<option value="', esc_attr($key), '"';
            if ($value == $key) {
                echo ' selected';
            }
            echo '>', esc_html($text), '</option>';
        }
        echo '</select>';

        $this->_description($attrs);
        $this->_close();
    }

    public function yesno($name, $label = '', $attrs = []) {
        $attrs = $this->_merge_attrs($attrs);
        $this->_open();
        $this->_label($label);
        $this->controls->yesno($name);
        $this->_description($attrs);
        $this->_close();
    }

    public function select_number($name, $label = '', $min, $max, $attrs = []) {
        $attrs = $this->_merge_attrs($attrs);
        $this->_open();
        $this->_label($label);
        $this->controls->select_number($name, $min, $max);
        $this->_description($attrs);
        $this->_close();
    }

    /** 
     * General field to collect an element dimension in pixels
     *  
     * Attributes:
     * - size: field width in pixels
     */
    public function size($name, $label = '', $attrs = []) {
        $attrs = $this->_merge_attrs($attrs, ['description' => '', 'placeholder' => '', 'size' => 0, 'label_after' => 'px']);
        $this->_open('tnp-size');
        $this->_label($label);
        $value = $this->controls->get_value($name);
        echo '<input id="', $this->_id($name), '" placeholder="', esc_attr($attrs['placeholder']), '" name="', $this->_name($name), '" type="text"';
        if (!empty($attrs['size'])) {
            echo ' style="width: ', $attrs['size'], 'px"';
        }
        echo ' value="', esc_attr($value), '">', $attrs['label_after'];
        $this->_description($attrs);
        $this->_close();
    }

    /** 
     * Collects a color in HEX format with a picker. 
     */
    public function color($name, $label, $attrs = []) {
        $this->_open('tnp-color');
        $this->_label($label);
        $this->controls->color($name);
        $this->_description($attrs);
        $this->_close();
    }

    /** 
     * Configuration for a simple button with label and color
     *  
     * Attributes:
     * - weight: if true (default) shows the font weight selector
     * - url_paceholder: the placeholder for the URL field
     * - url: if true (default) shows the URL field (sometime the URL is produced elsewhere, for example on post list)
     */
    public function button($name, $label = '', $attrs = []) {
        $attrs = $this->_merge_attrs($attrs, ['placeholder' => 'Label...', 'url_placeholder' => 'https://...', 'url' => true, 'weight' => true]);
        $this->_open('tnp-button');
        $this->_label($label);
        $value = $this->controls->get_value($name . '_label');
        $name_esc = esc_attr($name);
        echo '<div class="tnp-field-row">';
        echo '<div class="tnp-field-col-2">';
        echo '<input id="', $this->_id($name . '_label'), '" placeholder="', esc_attr($attrs['placeholder']), '" name="options[', $name_esc, '_label]" type="text"';
        echo ' style="width: 100%"';
        echo ' value="', esc_attr($value), '">';
        echo '</div>';

        if ($attrs['url']) {
            $value = $this->controls->get_value($name . '_url');
            echo '<div class="tnp-field-col-2">';
            echo '<input id="', $this->_id($name . '_url'), '" placeholder="', esc_attr($attrs['url_placeholder']), '" name="options[',
            $name_esc, '_url]" type="url" style="width: 100%" value="', esc_attr($value), '">';
            echo '</div>';
        }
        echo '<div style="clear: both"></div>';
        echo '</div>';
        $this->controls->css_font($name . '_font', ['weight' => $attrs['weight']]);
        $this->controls->color($name . '_background');
        $this->_close();
    }

    /**
     * URL input field
     * 
     * @param string $name
     * @param string $label
     * @param array $attrs
     */
    public function url($name, $label = '', $attrs = []) {
        $attrs = $this->_merge_attrs($attrs, ['placeholder' => 'https://...']);
        $this->_open('tnp-url');
        $this->_label($label);
        $this->controls->text_url($name);
        $this->_description($attrs);
        $this->_close();
    }

    /**
     * Provides a list of custom post types.
     * 
     * @param string $name
     * @param string $label
     * @param array $attrs
     */
    public function post_type($name = 'post_type', $label = '', $attrs = []) {

        $post_types = get_post_types(['public' => true], 'objects', 'and');

        $attrs = array_merge(['description' => ''], $attrs);
        $this->_open('tnp-post-type');
        $this->_label($label);

        $options = ['post' => 'Standard post'];
        foreach ($post_types as $post_type) {
            if ($post_type->name == 'post' || $post_type->name == 'page' || $post_type->name == 'attachment') {
                continue;
            }
            $options[$post_type->name] = $post_type->labels->name;
        }
        $value = $this->controls->get_value($name);

        echo '<select id="', $this->_id($name), '" name="options[' . esc_attr($name) . ']" onchange="tnpc_reload_options(event); return false;">';
//        if (!empty($first)) {
//            echo '<option value="">' . esc_html($first) . '</option>';
//        }
        $label = esc_html($label);
        foreach ($options as $key => $label) {
            echo '<option value="' . esc_attr($key) . '"';
            if ($value == $key)
                echo ' selected';
            echo '>', $label, '</option>';
        }
        echo '</select>';

        $this->_description($attrs);
        $this->_close();
    }

    function posts($name, $label, $count = 20, $args = []) {
        $args = array_merge(array('filters' => array(
                'posts_per_page' => 5,
                'offset' => 0,
                'category' => '',
                'category_name' => '',
                'orderby' => 'date',
                'order' => 'DESC',
                'include' => '',
                'exclude' => '',
                'meta_key' => '',
                'meta_value' => '',
                'post_type' => 'post',
                'post_mime_type' => '',
                'post_parent' => '',
                'author' => '',
                'author_name' => '',
                'post_status' => 'publish',
                'suppress_filters' => true),
            'last_post_option' => false
                ), $args);
        $args['filters']['posts_per_page'] = $count;

        $posts = get_posts($args['filters']);
        $options = array();
        if ($args['last_post_option']) {
            $options['last'] = 'Most recent post';
        }
        foreach ($posts as $post) {
            $options['' . $post->ID] = $post->post_title;
        }

        $this->select($name, $label, $options);
    }

    function lists($name, $label, $attrs = []) {
        $attrs = $this->_merge_attrs($attrs);
        $this->_open();
        $this->_label($label);
        $lists = $this->controls->get_list_options($empty_label);
        $this->controls->select($name, $lists);
        $this->_description($attrs);
        $this->_close();
    }

    /**
     * Media selector using the WP media library (for images and files.
     * The field to use it the {$name}_id which contains the media id.
     * 
     * Attributes:
     * - alt: if true shows the alternate text field for the "alt" attribute
     *
     * @param string $name
     * @param string $label
     * @param array $attrs
     */
    public function media($name, $label = '', $attrs = []) {
        $attrs = $this->_merge_attrs($attrs, ['alt' => false]);
        $this->_open('tnp-media');
        $this->_label($label);
        $this->controls->media($name);
        if ($attrs['alt']) {
            $this->controls->text($name . '_alt', 20, 'Alternative text');
        }
        $this->_description($attrs);
        $this->_close();
    }

    public function categories($name = 'categories', $label = '', $attrs = []) {
        if (empty($label)) {
            $label = __('Categories', 'newsletter');
        }
        $attrs = $this->_merge_attrs($attrs);
        $this->_open('tnp-categories');
        $this->_label($label);
        $this->controls->categories_group($name);
        $this->_description($attrs);
        $this->_close();
    }

    /**
     * The field name is preset to tax_$taxonomy. A different name can be specified
     * with the attribute 'name'.
     * @param type $taxonomy
     * @param type $label
     * @param type $attrs
     */
    public function terms($taxonomy, $label = '', $attrs = []) {
        if (isset($attrs['name'])) {
            $name = $attrs['name'];
        } else {
            $name = 'tax_' . $taxonomy;
        }
        if (empty($label)) {
            $label = __('Terms', 'newsletter');
        }
        $attrs = $this->_merge_attrs($attrs);
        $this->_open('tnp-categories');
        $this->_label($label);
        $terms = get_terms($taxonomy);

        if (empty($terms)) {
            echo 'No terms in use';
        } else {

            echo '<div class="newsletter-checkboxes-group">';
            foreach ($terms as $term) {
                /* @var $term WP_Term */
                echo '<div class="newsletter-checkboxes-item">';
                $this->controls->checkbox_group($name, $term->term_id, esc_html($term->name));
                echo '</div>';
            }
            echo '<div style="clear: both"></div>';
            echo '</div>';
        }

        $this->_description($attrs);
        $this->_close();
    }

    /**
     * Shows a language selector only if the blog is multilanguage.
     * 
     * @param string $name
     * @param string $label
     * @param array $attrs
     */
    public function language($name = 'language', $label = '', $attrs = []) {
        if (!Newsletter::instance()->is_multilanguage()) {
            return;
        }
        if (empty($label)) {
            $label = __('Language', 'newsletter');
        }
        $attrs = $this->_merge_attrs($attrs);
        $this->_open('tnp-language');
        $this->_label($label);
        $this->controls->language($name);
        $this->_description($attrs);
        $this->_close();
    }

    /**
     * Collects font details for a text: family, color, size and weight to be used
     * directly on CSS rules. Size is a pure number.
     * 
     * Attributes:
     *
     * @param type $name
     * @param type $label
     * @param type $attrs
     */
    public function font($name = 'font', $label = 'Font', $attrs = []) {
        $attrs = $this->_merge_base_attrs($attrs);
        $attrs = array_merge(array('hide_family' => false, 'hide_color' => false, 'hide_size' => false), $attrs);

        $this->_open('tnp-font');
        $this->_label($label);
        $this->controls->css_font($name);
        $this->_description($attrs);
        $this->_close();
    }

    /**
     * Collects fout number values representing the padding of a box. The values can
     * be found as {$name}_top, {$name}_bottom, {$name}_left, {$name}_right.
     *
     * @param type $name
     * @param type $label
     * @param type $attrs
     */
    public function padding($name = 'block_padding', $label = 'Padding', $attrs = []) {
        $attrs = $this->_merge_base_attrs($attrs);
        $attrs = array_merge(['padding_top' => 0, 'padding_left' => 0, 'padding_right' => 0, 'padding_bottom' => 0], $attrs);
        $field_only = !empty($attrs['field_only']);

        if (!$field_only) {
            $this->_open('tnp-padding');
            $this->_label($label);
        }
        echo '<div class="tnp-padding-fields">';
        echo '&larr;';
        $this->controls->text($name . '_left', 5);
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&uarr;';
        $this->controls->text($name . '_top', 5);
        echo '&nbsp;&nbsp;&nbsp;';

        $this->controls->text($name . '_bottom', 5);
        echo '&darr;';
        echo '&nbsp;&nbsp;&nbsp;';
        $this->controls->text($name . '_right', 5);
        echo '&rarr;';
        echo '</div>';
        if (!$field_only) {
            $this->_description($attrs);
            $this->_close();
        }
    }

    /**
     * Background color selector for a block.
     */
    public function block_background() {
        $this->color('block_background', __('Block Background', 'newsletter'));
    }

    /**
     * Padding selector for a block.
     */
    public function block_padding() {
        $this->padding('block_padding', __('Padding', 'newsletter'));
    }

    public function block_commons() {
        $this->separator();

        $this->_open('tnp-block-commons');
        $this->_label('Padding and background');
        $this->controls->color('block_background');

        echo '&nbsp;&rarr;&nbsp;';
        $this->controls->checkbox('block_background_gradient');
        $this->controls->color('block_background_2');

        echo '&nbsp;&nbsp;&nbsp;';
        $this->padding('block_padding', '', ['field_only' => true]);
        echo '<div class="tnp-description">Gradients are displayed only by few clients</div>';
        $this->_close();
    }

}
