(function() {
	tinymce.PluginManager.add('sp_tfree_mce_button', function( editor, url ) {
		editor.addButton('sp_tfree_mce_button', {
			text: false,
            icon: false,
            image: url + '/icon-32.png',
            tooltip: 'Testimonial',
            onclick: function () {
                editor.windowManager.open({
                    title: 'Insert Shortcode',
					width: 400,
					height: 100,
					body: [
						{
							type: 'listbox',
							name: 'listboxName',
                            label: 'Select Shortcode',
							'values': editor.settings.spTFREEShortcodeList
						}
					],
					onsubmit: function( e ) {
						editor.insertContent( '[sp_testimonial id="' + e.data.listboxName + '"]');
					}
				});
			}
		});
	});
})();