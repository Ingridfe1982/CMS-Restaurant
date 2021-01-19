// add delete buttons
jQuery.fn.add_delete = function () {
    this.append('<div class="tnpc-row-delete" title="Delete"><img src="' + TNP_PLUGIN_URL + '/emails/tnp-composer/_assets/delete.png" width="32"></div>');
    this.find('.tnpc-row-delete').perform_delete();
};

// delete row
jQuery.fn.perform_delete = function () {
    this.click(function () {
        // hide block edit form
        jQuery("#tnpc-block-options").hide();
        // remove block
        jQuery(this).parent().remove();
        tnpc_mobile_preview();
    });
}

// add edit button
jQuery.fn.add_block_edit = function () {
    this.append('<div class="tnpc-row-edit-block" title="Edit"><img src="' + TNP_PLUGIN_URL + '/emails/tnp-composer/_assets/edit.png" width="32"></div>');
    this.find('.tnpc-row-edit-block').perform_block_edit();
}

// add clone button
jQuery.fn.add_block_clone = function () {
    this.append('<div class="tnpc-row-clone" title="Clone"><img src="' + TNP_PLUGIN_URL + '/emails/tnp-composer/_assets/copy.png" width="32"></div>');
    this.find('.tnpc-row-clone').perform_clone();
}

let start_options = null;
let container = null;

jQuery.fn.perform_block_edit = function () {

    jQuery(".tnpc-row-edit-block").click(function (e) {
        e.preventDefault()
    });

    this.click(function (e) {

        e.preventDefault();

        target = jQuery(this).parent().find('.edit-block');

        jQuery("#tnpc-edit-block .bgcolor").val(target.css("background-color"));
        jQuery("#tnpc-edit-block .font").val(target.css("font-family"));

        // The row container which is a global variable and used later after the options save
        container = jQuery(this).closest("table");

        if (container.hasClass('tnpc-row-block')) {

            jQuery("#tnpc-block-options").fadeIn(500);
            var options = container.find(".tnpc-block-content").attr("data-json");
            // Compatibility
            if (!options) {
                options = target.attr("data-options");
            }

            jQuery("#tnpc-block-options-form").load(ajaxurl, {
                action: "tnpc_options",
                id: container.data("id"),
                context_type: tnp_context_type,
                options: options
            }, function () {
                start_options = jQuery("#tnpc-block-options-form").serialize();
                tnp_controls_init();
            });

        } else {
            alert("This is deprecated block version and cannot be edited. Please replace it with a new one.");
        }

    });

};

jQuery.fn.perform_clone = function () {

    jQuery(".tnpc-row-clone").click(function (e) {
        e.preventDefault()
    });

    this.click(function (e) {

        e.preventDefault();

        // hide block edit form
        jQuery("#tnpc-block-options").hide();

        // find the row
        let row = jQuery(this).closest('.tnpc-row');

        // clone the block
        let new_row = row.clone();
        new_row.find(".tnpc-row-delete").remove();
        new_row.find(".tnpc-row-edit-block").remove();
        new_row.find(".tnpc-row-clone").remove();

        new_row.add_delete();
        new_row.add_block_edit();
        new_row.add_block_clone();
        // if (new_row.hasClass('tnpc-row-block')) {
        //     new_row.find(".tnpc-row-edit-block i").click();
        // }
        new_row.insertAfter(row);
        tnpc_mobile_preview();
    });
};


jQuery(function () {

    // collapse wp menu
    jQuery('body').addClass('folded');

    // open blocks tab
    document.getElementById("defaultOpen").click();

    // preload content from a body named input
    var preloadedContent = jQuery('input[name="message"]').val();
    if (!preloadedContent) {
        preloadedContent = jQuery('input[name="options[message]"]').val();
    }

    if (!preloadedContent) {
        tnpc_show_presets();
    } else {
        jQuery('#newsletter-builder-area-center-frame-content').html(preloadedContent);
        start_composer();
    }

    // subject management
    jQuery('#options-title').val(jQuery('#tnpc-form input[name="options[subject]"]').val());

    // ======================== //
    // ==  BACKGROUND COLOR  == //
    // ======================== //
    _setBuilderAreaBackgroundColor(document.getElementById('options-options_composer_background').value);

    jQuery('#options-options_composer_background').on('change', function (e) {
        _setBuilderAreaBackgroundColor(e.target.value);
    });

    function _setBuilderAreaBackgroundColor(color) {
        jQuery('#newsletter-builder-area-center-frame-content').css('background-color', color);
    }
    // ======================== //
    // ==  BACKGROUND COLOR  == //
    // ======================== //

});

function start_composer() {

    //Drag & Drop
    jQuery("#newsletter-builder-area-center-frame-content").sortable({
        revert: false,
        placeholder: "placeholder",
        forcePlaceholderSize: true,
        opacity: 0.6,
        tolerance: "pointer",
        helper: function (e) {
            var helper = jQuery(document.getElementById("sortable-helper")).clone();
            return helper;
        },
        update: function (event, ui) {
            if (ui.item.attr("id") == "draggable-helper") {
                loading_row = jQuery('<div style="text-align: center; padding: 20px; background-color: #d4d5d6; color: #52BE7F;"><i class="fa fa-cog fa-2x fa-spin" /></div>');
                ui.item.before(loading_row);
                ui.item.remove();
                var data = {
                    'action': 'tnpc_render',
                    'b': ui.item.data("id"),
                    'full': 1,
                    '_wpnonce': tnp_nonce
                };
                jQuery.post(ajaxurl, data, function (response) {

                    new_row = jQuery(response);
//                    ui.item.before(new_row);
//                    ui.item.remove();
                    loading_row.before(new_row);
                    loading_row.remove();
                    new_row.add_delete();
                    new_row.add_block_edit();
                    new_row.add_block_clone();
                    // new_row.find(".tnpc-row-edit").hover_edit();
                    if (new_row.hasClass('tnpc-row-block')) {
                        new_row.find(".tnpc-row-edit-block").click();
                    }
                    tnpc_mobile_preview();
                }).fail(function () {
                    alert("Block rendering failed.");
                    loading_row.remove();
                });
            } else {
                tnpc_mobile_preview();
            }
        }
    });

    jQuery(".newsletter-sidebar-buttons-content-tab").draggable({
        connectToSortable: "#newsletter-builder-area-center-frame-content",

        // Build the helper for dragging
        helper: function (e) {
            var helper = jQuery(document.getElementById("draggable-helper")).clone();
            // Do not uset .data() with jQuery
            helper.attr("data-id", e.currentTarget.dataset.id);
            helper.html(e.currentTarget.dataset.name);
            return helper;
        },
        revert: false,
        start: function () {
            if (jQuery('.tnpc-row').length) {
            } else {
                jQuery('#newsletter-builder-area-center-frame-content').append('<div class="tnpc-drop-here">Drag&Drop blocks here!</div>');
            }
        },
        stop: function (event, ui) {
            jQuery('.tnpc-drop-here').remove();
        }
    });

    // Closes the block options layer (without saving)
    jQuery("#tnpc-block-options-cancel").click(function () {
        jQuery(this).parent().parent().fadeOut(500);
        jQuery.post(ajaxurl, start_options, function (response) {
            target.html(response);
            jQuery("#tnpc-block-options-form").html("");
        });
    });

    // Fires the save event for block options
    jQuery("#tnpc-block-options-save").click(function (e) {
        e.preventDefault();
        // fix for Codemirror
        if (typeof templateEditor !== 'undefined') {
            templateEditor.save();
        }

        if (window.tinymce)
            window.tinymce.triggerSave();

        jQuery("#tnpc-block-options").fadeOut(500);

        var data = jQuery("#tnpc-block-options-form").serialize();

        jQuery.post(ajaxurl, data, function (response) {
            target.html(response);
            tnpc_mobile_preview();
            //target.attr("data-options", options);
            //target.find(".tnpc-row-edit").hover_edit();
            jQuery("#tnpc-block-options-form").html("");
        });
    });

    // live preview from block options *** EXPERIMENTAL ***
    jQuery('#tnpc-block-options-form').change(function (event) {
        var data = jQuery("#tnpc-block-options-form").serialize();
        jQuery.post(ajaxurl, data, function (response) {
            target.html(response);
            if (event.target.dataset.afterRendering === 'reload') {
                container.find(".tnpc-row-edit-block").click();
            }
        }).fail(function () {
            alert("Block rendering failed");
        });


    });

    jQuery(".tnpc-row").add_delete();
    jQuery(".tnpc-row").add_block_edit();
    jQuery(".tnpc-row").add_block_clone();


    tnpc_mobile_preview();

}

function tnpc_mobile_preview() {

    var d = document.getElementById("tnpc-mobile-preview").contentWindow.document;
    d.open();

    d.write("<!DOCTYPE html>\n<html>\n<head>\n");
    d.write("<link rel='stylesheet' href='" + TNP_HOME_URL + "?na=emails-composer-css&ver=" + Math.random() + "' type='text/css'>");
    d.write("<style>.tnpc-row-delete, .tnpc-row-edit-block, .tnpc-row-clone { display: none; }</style>");
    d.write("<style>body::-webkit-scrollbar {width: 0px;background: transparent;}</style>");
    d.write("<style>body{scrollbar-width: none; -ms-overflow-style: none;}</style>");
    d.write("</head>\n<body style='margin: 0; padding: 0;'><div style='width: 320px!important'>");
    d.write(jQuery("#newsletter-builder-area-center-frame-content").html());
    d.write("</div>\n</body>\n</html>");
    d.close();
}

function tnpc_save(form) {

    jQuery("#newsletter-preloaded-export").html(jQuery("#newsletter-builder-area-center-frame-content").html());

    jQuery("#newsletter-preloaded-export .tnpc-row-delete").remove();
    jQuery("#newsletter-preloaded-export .tnpc-row-edit-block").remove();
    jQuery("#newsletter-preloaded-export .tnpc-row-clone").remove();
    jQuery("#newsletter-preloaded-export .tnpc-row").removeClass("ui-draggable");
    jQuery('#newsletter-preloaded-export #sortable-helper').remove();

    form.elements["options[message]"].value = jQuery("#newsletter-preloaded-export").html();
    if (document.getElementById("options-title")) {
        form.elements["options[subject]"].value = jQuery('#options-title').val();
    } else {
        form.elements["options[subject]"].value = "";
    }

    var global_form = document.getElementById("tnpc-global-styles-form");
    //Copy "Global styles" form inputs into main form
    tnpc_copy_form(global_form, form);

    jQuery("#newsletter-preloaded-export").html(' ');
}

function tnpc_copy_form(source, dest) {
    for (var i = 0; i < source.elements.length; i++) {
        var clonedEl = source.elements[i].cloneNode();
        clonedEl.style.display = 'none';
        dest.appendChild(clonedEl);
    }
}

function tnpc_test() {
    let form = document.getElementById("tnpc-form");
    tnpc_save(form);
    form.act.value = "test";
    form.submit();
}

function openTab(evt, tabName) {
    evt.preventDefault();
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}


function tnpc_show_presets() {

    jQuery('.tnpc-controls input').attr('disabled', true);
    jQuery('#newsletter-builder-area-center-frame-content').load(ajaxurl, {
        action: "tnpc_presets",
    });

}

function tnpc_load_preset(id) {

    jQuery('#newsletter-builder-area-center-frame-content').load(ajaxurl, {
        action: "tnpc_presets",
        id: id
    }, function () {
        start_composer();
        jQuery('.tnpc-controls input').attr('disabled', false);
    });

}

function tnpc_scratch() {

    jQuery('#newsletter-builder-area-center-frame-content').html(" ");
    start_composer();

}

function tnpc_reload_options(e) {
    e.preventDefault();
    let options = jQuery("#tnpc-block-options-form").serializeArray();
    for (let i = 0; i < options.length; i++) {
        if (options[i].name === 'action') {
            options[i].value = 'tnpc_options';
        }
    }

    jQuery("#tnpc-block-options-form").load(ajaxurl, options);
}

jQuery(document).ready(function () {

    var TNPInlineEditor = (function () {

            var className = 'tnpc-inline-editable';
            var newInputName = 'new_name';
            var activeInlineElements = [];

            function init() {
                // find all inline editable elements
                jQuery('#newsletter-builder-area-center-frame-content').on('click', '.' + className, function (e) {
                    removeAllActiveElements();

                    var originalEl = jQuery(this).hide();
                    var newEl = jQuery(getEditableComponent(this.innerText.trim(), this.dataset.id, this.dataset.type)).insertAfter(this);

                    activeInlineElements.push({'originalEl': originalEl, 'newEl': newEl});

                    //Add submit event listener for newly created block
                    jQuery('.tnpc-inline-editable-form-' + this.dataset.type + this.dataset.id).on('submit', function (e) {
                        submit(e, newEl, jQuery(originalEl));
                    });

                    //Add close event listener for newly created block
                    jQuery('.tnpc-inline-editable-form-actions .tnpc-dismiss-' + this.dataset.type + this.dataset.id).on('click', function (e) {
                        removeAllActiveElements();
                    });

                });

                // Close all created elements if clicked outside
                jQuery('#newsletter-builder-area-center-frame-content').on('click', function (e) {
                    if (activeInlineElements.length > 0
                        && !jQuery(e.target).hasClass(className)
                        && jQuery(e.target).closest('.tnpc-inline-editable-container').length === 0) {
                        removeAllActiveElements();
                    }
                });

            }

            function removeAllActiveElements() {
                activeInlineElements.forEach(function (obj) {
                    obj.originalEl.show();

                    obj.newEl.off();
                    obj.newEl.remove();
                });

                activeInlineElements = []
            }

            function getEditableComponent(value, id, type) {

                var element = '';

                switch (type) {
                    case 'text': {
                        element = "<textarea name='" + newInputName + "' class='" + className + "-textarea' rows='5'>" + value + "</textarea>";
                        break;
                    }
                    case 'title': {
                        element = "<textarea name='" + newInputName + "' class='" + className + "-textarea' rows='2'>" + value + "</textarea>";
                        break;
                    }
                }

                var component = "<td>";
                component += "<form class='tnpc-inline-editable-form tnpc-inline-editable-form-" + type + id + "'>";
                component += "<input type='hidden' name='id' value='" + id + "'>";
                component += "<input type='hidden' name='type' value='" + type + "'>";
                component += "<input type='hidden' name='old_value' value='" + value + "'>";
                component += "<div class='tnpc-inline-editable-container'>";
                component += element;
                component += "<div class='tnpc-inline-editable-form-actions'>";
                component += "<button type='submit'><span class='dashicons dashicons-yes-alt' title='save'></span></button>";
                component += "<span class='dashicons dashicons-dismiss tnpc-dismiss-" + type + id + "' title='close'></span>";
                component += "</div>";
                component += "</div>";
                component += "</form>";
                component += "</td>";
                return component;
            }

            function submit(e, elementToDeleteAfterSubmit, elementToShow) {
                e.preventDefault();

                var id = elementToDeleteAfterSubmit.find('form input[name=id]').val();
                var type = elementToDeleteAfterSubmit.find('form input[name=type]').val();
                var newValue = elementToDeleteAfterSubmit.find('form [name="' + newInputName + '"]').val();

                ajax_render_block(elementToShow, type, id, newValue);

                elementToDeleteAfterSubmit.remove();
                elementToShow.show();

            }

            function ajax_render_block(inlineElement, type, postId, newContent) {

                var target = inlineElement.closest('.edit-block');
                var container = target.closest('table');
                var blockContent = target.children('.tnpc-block-content');

                if (container.hasClass('tnpc-row-block')) {
                    var data = {
                        'action': 'tnpc_render',
                        'b': container.data('id'),
                        'full': 1,
                        '_wpnonce': tnp_nonce,
                        'options': {
                            'inline_edits': [{
                                'type': type,
                                'post_id': postId,
                                'content': newContent
                            }]
                        },
                        'encoded_options': blockContent.data('json')
                    };

                    jQuery.post(ajaxurl, data, function (response) {
                        new_row = jQuery(response);

                        target.before(new_row);
                        target.remove();

                        new_row.add_delete();
                        new_row.add_block_edit();
                        new_row.add_block_clone();

                        if (new_row.hasClass('tnpc-row-block')) {
                            new_row.find(".tnpc-row-edit-block").click();
                        }
                        tnpc_mobile_preview();

                    }).fail(function () {
                        alert("Block rendering failed.");
                    });

                }

            }

            return {init: init};
        }

    )();

    TNPInlineEditor.init();

});
