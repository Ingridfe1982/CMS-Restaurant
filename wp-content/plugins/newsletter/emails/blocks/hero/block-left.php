<style>
    /* Styles which will be removed and injected in the replacing the matching "inline-class" attribute */
    .title {
        font-size: <?php echo $title_font_size ?>px;
        color: <?php echo $title_font_color ?>;
        padding-top: 0;
        font-family: <?php echo $title_font_family ?>;
        font-weight: <?php echo $title_font_weight ?>;
        margin: 0;
        text-align: center;
        line-height: normal;
    }
    .text {
        padding: 20px 0 0 0;
        font-size: <?php echo $font_size ?>px;
        line-height: 150%;
        color: <?php echo $font_color ?>;
        font-family: <?php echo $font_family ?>;
        font-weight: <?php echo $font_weight ?>;
        margin: 0;
        text-align: center;
    }
    .image {
        max-width: 100%!important;
        display: block;
    }
    .image-a {
        display: block;
    }
    .button {
        padding-top: 15px;
    }
</style>

<!-- layout: left -->

<table width="50%" align="left" class="hero-table" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="center" valign="top">
	        <?php echo TNP_Composer::image( $media, [ 'class' => 'image', 'link-class' => 'image-a' ] ); ?>
        </td>
    </tr>
</table>

<table width="49%" align="right" class="hero-table hero-table-right" border="0" cellspacing="0" cellpadding="0">
    <tr>
        <td align="center" inline-class="title">
            <span><?php echo $options['title'] ?></span>
        </td>
    </tr>
    <tr>
        <td align="center" inline-class="text">
            <span><?php echo $options['text'] ?></span>
        </td>
    </tr>

    <tr>
        <td align="center" inline-class="button">
            <?php echo tnpc_button($options) ?>
        </td>
    </tr>

</table>
