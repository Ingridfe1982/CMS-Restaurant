<style>
    /* Styles which will be removed and injected in the replacing the matching "inline-class" attribute */
    .title {
        font-size: <?php echo $title_font_size ?>px;
        color: <?php echo $title_font_color ?>;
        padding-top: 0;
        font-family: <?php echo $title_font_family ?>;
        font-weight: <?php echo $title_font_weight ?>;
        line-height: normal;
        margin: 0;
        text-align: center;
    }
    .text {
        padding: 20px 0 0 0;
        font-size: <?php echo $font_size ?>px;
        line-height: 150%;
        color: <?php echo $font_color ?>;
        font-family: <?php echo $font_family ?>;
        font-weight: <?php echo $font_weight ?>;
        text-align: center;
        margin: 0;
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

<!-- layout: right -->

<div dir="rtl">

    <table width="50%" align="right" class="hero-table" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center" valign="top" dir="ltr">
	            <?php echo TNP_Composer::image( $media, [ 'class' => 'image', 'link-class' => 'image-a' ] ); ?>
            </td>
        </tr>
    </table>

    <table width="49%" align="left" class="hero-table hero-table-right" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center" inline-class="title" dir="ltr">
                <?php echo $options['title'] ?>
            </td>
        </tr>
        <tr>
            <td align="center" inline-class="text" dir="ltr">
                <?php echo $options['text'] ?>
            </td>
        </tr>
        <tr>
            <td align="center" inline-class="button" dir="ltr">
                <?php echo tnpc_button($options) ?>
            </td>
        </tr>
    </table>

</div>
