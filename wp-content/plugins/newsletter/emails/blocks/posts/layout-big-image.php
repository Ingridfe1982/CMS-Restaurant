<?php
$size = ['width' => 600, 'height' => 0];
?>
<style>
    .post-date {
        padding: 0 0 5px 0;
        font-size: 13px;
        font-family: <?php echo $font_family ?>;
        font-weight: normal;
        color: #aaaaaa;
    }

    .post-title {
        padding: 0 0 5px 0;
        font-size: <?php echo $title_font_size ?>px;
        font-family: <?php echo $title_font_family ?>;
        font-weight: <?php echo $title_font_weight ?>;
        color: <?php echo $options['title_font_color'] ?>;
        line-height: normal;
    }

    .post-excerpt {
        padding: 10px 0 15px 0;
        font-family: <?php echo $font_family ?>;
        color: <?php echo $options['font_color'] ?>;
        font-size: <?php echo $font_size ?>px;
        line-height: 1.5em;
    }
</style>


<?php foreach ($posts as $post) { ?>
    <?php
    $url = tnp_post_permalink($post);
    $media = null;
    if ($show_image) {
        $media = tnp_composer_block_posts_get_media($post, $size);

        if ($media) {
            $media->link = $url;
        }
    }
    $options['button_url'] = $url;
    ?>



    <?php if ($media) { ?>
        <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom: 20px">
            <tr>
                <td align="center">
                    <?php echo TNP_Composer::image($media) ?>
                </td>
            </tr>
        </table>
    <?php } ?>

    <table width="100%" cellpadding="0" cellspacing="0" border="0" class="responsive-table">
        <tr>
            <td>

                <!-- ARTICLE -->
                <table border="0" cellspacing="0" cellpadding="0" width="100%">
                    <?php if (!empty($options['show_date'])) { ?>
                        <tr>
                            <td align="<?php echo $align_left ?>" inline-class="post-date">
                                <?php echo tnp_post_date($post) ?>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td align="<?php echo $align_left ?>"
                            inline-class="post-title"
                            class="tnpc-row-edit tnpc-inline-editable"
                            data-type="title" data-id="<?php echo $post->ID ?>" dir="<?php echo $dir ?>">
                                <?php
                                echo TNP_Composer::is_post_field_edited_inline($options['inline_edits'], 'title', $post->ID) ?
                                        TNP_Composer::get_edited_inline_post_field($options['inline_edits'], 'title', $post->ID) :
                                        tnp_post_title($post)
                                ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="<?php echo $align_left ?>"
                            inline-class="post-excerpt"
                            class="padding-copy tnpc-row-edit tnpc-inline-editable"
                            data-type="text" data-id="<?php echo $post->ID ?>" dir="<?php echo $dir ?>">
                                <?php
                                echo TNP_Composer::is_post_field_edited_inline($options['inline_edits'], 'text', $post->ID) ?
                                        TNP_Composer::get_edited_inline_post_field($options['inline_edits'], 'text', $post->ID) :
                                        tnp_post_excerpt($post, $excerpt_length)
                                ?>
                        </td>
                    </tr>
                    <tr>
                        <td align="<?php echo $align_left ?>" align="center">
                            <?php echo TNP_Composer::button($options) ?>
                            <br><br>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>



<?php } ?>


