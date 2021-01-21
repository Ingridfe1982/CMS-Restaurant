<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

/**
 * Functions
 */
class SP_Testimonial_Free_Functions {

	/**
	 * Initialize the class
	 */
	public function __construct() {
		add_filter( 'post_updated_messages', array( $this, 'sp_tfree_change_default_post_update_message' ) );
		add_filter( 'admin_footer_text', array( $this, 'admin_footer' ), 1, 2 );
		add_action( 'admin_menu', array( $this, 'admin_menu' ), 100 );
		// Post thumbnails.
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'tf-client-image-size', 120, 120, true );
	}

	/**
	 * Post update messages for Shortcode Generator
	 */
	function sp_tfree_change_default_post_update_message( $message ) {
		$screen = get_current_screen();
		if ( 'sp_tfree_shortcodes' == $screen->post_type ) {
			$message['post'][1]  = $title = esc_html__( 'Shortcode updated.', 'testimonial-free' );
			$message['post'][4]  = $title = esc_html__( 'Shortcode updated.', 'testimonial-free' );
			$message['post'][6]  = $title = esc_html__( 'Shortcode published.', 'testimonial-free' );
			$message['post'][8]  = $title = esc_html__( 'Shortcode submitted.', 'testimonial-free' );
			$message['post'][10] = $title = esc_html__( 'Shortcode draft updated.', 'testimonial-free' );
		} elseif ( 'spt_testimonial' == $screen->post_type ) {
			$message['post'][1]  = $title = esc_html__( 'Testimonial updated.', 'testimonial-free' );
			$message['post'][4]  = $title = esc_html__( 'Testimonial updated.', 'testimonial-free' );
			$message['post'][6]  = $title = esc_html__( 'Testimonial published.', 'testimonial-free' );
			$message['post'][8]  = $title = esc_html__( 'Testimonial submitted.', 'testimonial-free' );
			$message['post'][10] = $title = esc_html__( 'Testimonial draft updated.', 'testimonial-free' );
		}

		return $message;
	}

	/**
	 * Review Text
	 *
	 * @param $text
	 *
	 * @return string
	 */
	public function admin_footer( $text ) {
		$screen = get_current_screen();
		if ( 'spt_testimonial' == get_post_type() || $screen->id == 'spt_testimonial_page_tfree_help' || $screen->post_type == 'sp_tfree_shortcodes' ) {
			$url  = 'https://wordpress.org/support/plugin/testimonial-free/reviews/?filter=5#new-post';
			$text = sprintf(
				__( 'If you like <strong>Testimonial</strong> please leave us a <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. Your Review is very important to us as it helps us to grow more. ', 'testimonial-free' ),
				$url
			);
		}

		return $text;
	}

	/**
	 * Admin Menu
	 */
	function admin_menu() {
		add_submenu_page(
			'edit.php?post_type=spt_testimonial', __( 'Testimonial Pro', 'testimonial-free' ), __( 'Premium', 'testimonial-free' ), 'manage_options', 'testimonial_premium', array(
				$this,
				'premium_page_callback',
			)
		);
		add_submenu_page(
			'edit.php?post_type=spt_testimonial', __( 'Testimonial Help', 'testimonial-free' ), __( 'Help', 'testimonial-free' ), 'manage_options', 'tfree_help', array(
				$this,
				'help_page_callback',
			)
		);
	}

	/**
	 * Premium Page Callback
	 */
	public function premium_page_callback() {
		?>
		<div class="wrap about-wrap sp-tfree-help sp-tfree-upgrade">
			<h1><?php _e( 'Upgrade to <span>Testimonial Pro</span>', 'testimonial-free' ); ?></h1>
			<p class="about-text">
			<?php
			esc_html_e(
				'Get more Advanced Functionality & Flexibility with the Premium version.', 'testimonial-free'
			);
			?>
			</p>
			<div class="wp-badge"></div>
			<ul>
				<li class="tfree-upgrade-btn"><a href="https://shapedplugin.com/plugin/testimonial-pro/" target="_blank">Buy Testimonial Pro <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTc5MiIgaGVpZ2h0PSIxNzkyIiB2aWV3Qm94PSIwIDAgMTc5MiAxNzkyIiBmaWxsPSIjZmZmIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxwYXRoIGQ9Ik0xMTUyIDg5NnEwIDI2LTE5IDQ1bC00NDggNDQ4cS0xOSAxOS00NSAxOXQtNDUtMTktMTktNDV2LTg5NnEwLTI2IDE5LTQ1dDQ1LTE5IDQ1IDE5bDQ0OCA0NDhxMTkgMTkgMTkgNDV6Ii8+PC9zdmc+" alt="" style="max-width: 15px;"/></a></li>
				<li class="tfree-upgrade-btn"><a href="https://shapedplugin.com/demo/testimonial-pro" target="_blank">Live Demo & All Features <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz4KPHN2ZyB3aWR0aD0iMTUiIGhlaWdodD0iMTUiIHZpZXdCb3g9IjAgMCAxNzkyIDE3OTIiIGZpbGw9IiMwMDczYWEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTk3OSA5NjBxMCAxMy0xMCAyM2wtNDY2IDQ2NnEtMTAgMTAtMjMgMTB0LTIzLTEwbC01MC01MHEtMTAtMTAtMTAtMjN0MTAtMjNsMzkzLTM5My0zOTMtMzkzcS0xMC0xMC0xMC0yM3QxMC0yM2w1MC01MHExMC0xMCAyMy0xMHQyMyAxMGw0NjYgNDY2cTEwIDEwIDEwIDIzem0zODQgMHEwIDEzLTEwIDIzbC00NjYgNDY2cS0xMCAxMC0yMyAxMHQtMjMtMTBsLTUwLTUwcS0xMC0xMC0xMC0yM3QxMC0yM2wzOTMtMzkzLTM5My0zOTNxLTEwLTEwLTEwLTIzdDEwLTIzbDUwLTUwcTEwLTEwIDIzLTEwdDIzIDEwbDQ2NiA0NjZxMTAgMTAgMTAgMjN6Ii8+PC9zdmc+" alt="" style="max-width: 15px;"/></a></li>
			</ul>

			<hr>

			<div class="sp-tfree-pro-features">
				<h2 class="sp-tfree-text-center">Premium Features You'll Love</h2>
				<p class="sp-tfree-text-center sp-tfree-pro-subtitle">We've added 150+ extra features in our Premium Version of this plugin. Let’s see some amazing features.</p>

				<div class="feature-section three-col">
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Advanced Shortcode Generator</h3>
							<p>Understanding long-shortcodes attributes are very painful. Testimonial Pro comes with built-in Shortcode Generator to control easily the look and function of the Testimonials showcase. Customize your experience with Shortcode Generator.</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Easy To Use–No Coding Required</h3>
							<p>Testimonial Pro is very easy to use for anyone who is familiar with WordPress. After installing Testimonials Pro, it will add a powerful, easy to use Testimonial menu on your WordPress dashboard. You’ll be able to manage it and showcase your testimonials easily!</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Slider, Grid, Masonry, List, & Filter Layouts</h3>
							<p>You can select from 5 beautiful testimonial layouts: Slider, Grid, Masonry, List, & Filter. Creating a customized layout is super easy. You can change the number of layout columns, reviewer info to show, font, & color etc.</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>10+ Professional Themes</h3>
							<p>Get designer quality results without writing a single line of code through 10+ professionally pre-designed themes for front-end display. Each theme has a different structure and huge customization options to cover all the demands.</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>840+ Google Fonts</h3>
							<p>Testimonial Pro includes over 840+ Google fonts. You can add your desired font from 840+ Google Fonts. Customize the font family, size, transform, letter spacing, color, and line-height for every element.</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>100+ Visual Customisation Options</h3>
							<p>It could be easier to generate the shortcode to display the testimonials. Just go to the Shortcode Generator, choose the settings you want and generated shortcode is ready to use where you want like posts, pages, and widgets.</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>14 Display Options</h3>
							<p>Pick individual fields for each Testimonial's information. You can toggle between Testimonial Image, Video, title, Content, Name, Rating star, identity, Company, Location, Mobile, E-mail, Date, Website, And Social profile links.</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Highly Customizable</h3>
							<p>Testimonial Pro is extremely customizable with plenty of amazing options. From layouts to fonts to unlimited color options,  themes are carefully made with easy customization in mind, effortlessly!</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Drag & Drop Re-Ordering!</h3>
							<p>One of the most amazing features of Testimonial Pro is the ability to drag & drop re-order testimonials. You can re-order your testimonials simply by drag & drop, or choose to display the testimonials randomly.</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Showcase by Specific Category</h3>
							<p>Do you want to show a specific testimonial category to your potential customers? You can show testimonials from categories. Save your time by allowing automatical showcasing of available testimonials from the category.</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Display Specific Testimonials</h3>
							<p>You can display the specific testimonials from available testimonials in the list. Highlight your specific testimonials in strategic positions, it will allow you to convert visitors into your valuable customers.</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Front-end Submission Form</h3>
							<p>You can create Front-end Submission Form for customers to collect new testimonials for your business. When you receive a new testimonial, simply review and approve it to automatically add it to your customer testimonials page!</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Front-end Form Fields Control</h3>
							<p>You can choose which fields and the messages to display! You can sort your own order and control show/hide, required, label and placeholder attribute for all fields in Testimonial Submission Form.  It’s that simple.</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Thumbnail Slider</h3>
							<p>One of the most stunning features of Testimonial Pro is the ability to create Thumbnail Slider. If you enable thumbnail slider, you can display testimonials using the Thumbnail Slider. It's modern and looks pretty.</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Video Testimonial & Lightbox</h3>
							<p>Video Testimonials are more effective to increase sales of a business. You can create video testimonial with Lightbox instead of simple image testimonial with Testimonial Pro. You can use video from YouTube, Vimeo or any video link.</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Read More & Characters Limit</h3>
							<p>You can choose testimonial content display type, show full testimonial body or content with characters limit. You can set custom ellipsis after content, customize the Read More button text, color, and hover color.</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Read More Action Type (Expand/PopUp)</h3>
							<p>You can choose Read More button action type to show testimonial in a expand or popup page. In Expand, the testimonial content will collapse and expand long blocks of text. In PopUp, All Testimonial content will show like lightbox.</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Advanced Link Options</h3>
							<p>Testimonial Pro has several options for your links. You can link the identity or position of the testimonial through website URL that will lead to a page or company website URL, perfect for case studies!</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Rich Snippets Compatible</h3>
							<p>The plugin is Rich Snippets compatible. When used properly this information might display in the search engine result pages!
								Testimonial Pro uses schema.org compliant JSON-LD markup to appear correctly in search results.</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Slider Control Options</h3>
							<p>You can set how many testimonials to scroll at a time in the carousel or show, navigation & pagination show/hide, autoplay, speed, animation, loop, pause on hover, draggable, swipe, ticker mode, and many other settings.</p>
						</div>
					</div>					
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Navigation Styles & Positions</h3>
							<p>You can select your desired arrow style to fit your needs from many styles. This plugin has 13 Navigation, 16 Pagination, 6 Arrow Styles and 8+ different navigational arrow positions. You can set your desired style, position and color your own way.</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Custom Image Re-sizing</h3>
							<p>You can control the image size to your specific size. You can change the default size of your testimonial images on the settings. The newly uploaded image will be resized or cropped to the specified dimensions.</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>WPBakery (formerly Visual Composer) & Widget Ready</h3>
							<p>The premium plugin includes a Widget to display the layouts. Just create a layout in the Shortcode Generator page, save it to use in the widget! A Testimonials module available to add to your page via the V.C interface.</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Translation Ready (WPML)</h3>
							<p>Testimonial Pro is fully Translation ready with WPML, Polylang, qTranslate-x, GTranslate, Google Language Translator, WPGlobus – Multilingual Everything! You can easily translate into your language.</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Duplicate or Clone</h3>
							<p>A built-in duplicate or clone option for sliders or showcase is included with Testimonial Pro. You can duplicate or clone testimonial slider or showcase and copy them to new drafts for further editing. It's nice!</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Built-in Automatic Updates</h3>
							<p>You'll get Automatic Updates when you activate the license key in your site. Once you buy the Testimonial Pro, you will get regular update notification to the dashboard. You can see the change logs before update.</p>
						</div>
					</div>
					<div class="col">
						<div class="sp-tfree-feature">
							<h3><span class="dashicons dashicons-yes"></span>Fast & Friendly Support (24x7)</h3>
							<p>We love our valued customers! We always strive to provide 5-star, timely, and comprehensive support whenever you need a helping hand. We've a full time dedicated support team who are always ready to make you happy!</p>
						</div>
					</div>
				</div>

			</div>
			<hr>					
			<h2 class="sp-tfree-text-center sp-tfree-promo-video-title">Watch How <b>Testimonial Pro</b> Works</h2>
				<div class="headline-feature feature-video">

				<iframe width="1050" height="590" src="https://www.youtube.com/embed/OA7LgaZHwIY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
				</div>
				<hr>
				<div class="sp-tfree-join-community sp-tfree-text-center">
					<h2>Join the <b>40000+</b> Happy Users Worldwide!</h2>
					<a class="tfree-upgrade-btn" target="_blank" href="https://shapedplugin.com/plugin/testimonial-pro/">Get a license instantly</a>
					<p>Every purchase comes with <b>14-days</b> money back guarantee and access to our incredibly Top-notch Support with lightening-fast response time and 100% satisfaction rate.</p>
				</div>
				<br>
				<br>

				<hr>
				<div class="sp-tfree-upgrade-sticky-footer sp-tfree-text-center">
					<p><a href="https://shapedplugin.com/demo/testimonial-pro/" target="_blank" class="button
					button-primary">Live Demo</a> <a href="https://shapedplugin.com/plugin/testimonial-pro/" target="_blank" class="button button-primary">Upgrade Now</a></p>
				</div>
			</div>
		<?php
	}

	/**
	 * Help Page Callback
	 */
	public function help_page_callback() {
		?>
		<div class="wrap about-wrap sp-tfree-help">
			<h1><?php _e( 'Welcome to Testimonial!', 'testimonial-free' ); ?></h1>
			<p class="about-text">
			<?php
			_e(
				'Thank you for installing Testimonial! You\'re now running the most popular Testimonial plugin.
This video playlist will help you get started with the plugin.', 'testimonial-free'
			);
			?>
									</p>
			<div class="wp-badge"></div>

			<hr>

			<div class="headline-feature feature-video">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/htnj97_K3ys?list=PLoUb-7uG-5jPTDu5wiWwKhJNuWFWSyA5T" frameborder="0" allowfullscreen></iframe>
			</div>

			<hr>

			<div class="feature-section help-section three-col">
				<div class="col">
					<div class="sp-tfree-feature sp-tfree-text-center">
						<i class="sp-tfree-font-icon fa fa-life-ring"></i>
						<h3>Need any Assistance?</h3>
						<p>Our Expert Support Team is always ready to help you out promptly.</p>
						<a href="https://shapedplugin.com/support-forum/" target="_blank" class="button
						button-primary">Contact Support</a>
					</div>
				</div>
				<div class="col">
					<div class="sp-tfree-feature sp-tfree-text-center">
						<i class="sp-tfree-font-icon fa fa-file-text"></i>
						<h3>Looking for Documentation?</h3>
						<p>We have detailed documentation on every aspects of Testimonial.</p>
						<a href="https://shapedplugin.com/docs/docs/testimonial/overview/" target="_blank" class="button button-primary">Documentation</a>
					</div>
				</div>
				<div class="col">
					<div class="sp-tfree-feature sp-tfree-text-center">
						<i class="sp-tfree-font-icon fa fa-thumbs-up"></i>
						<h3>Like This Plugin?</h3>
						<p>If you like Testimonial, please leave us a 5 star rating.</p>
						<a href="https://wordpress.org/support/plugin/testimonial-free/reviews/#new-post" target="_blank" class="button
						button-primary">Rate the Plugin</a>
					</div>
				</div>
			</div>

		</div>
		<?php
	}


}

new SP_Testimonial_Free_Functions();

/**
 *
 * Multi Language Support
 *
 * @since 2.0
 */

// Polylang plugin support for multi language support.
if ( class_exists( 'Polylang' ) ) {

	add_filter( 'pll_get_post_types', 'sp_free_testimonial_polylang', 10, 2 );

	function sp_free_testimonial_polylang( $post_types, $is_settings ) {
		if ( $is_settings ) {
			// hides 'spt_testimonial,sp_tfree_shortcodes' from the list of custom post types in Polylang settings.
			unset( $post_types['spt_testimonial'] );
			unset( $post_types['sp_tfree_shortcodes'] );
		} else {
			// enables language and translation management for 'tspt_testimonial,sp_free_shortcodes'.
			$post_types['spt_testimonial']     = 'spt_testimonial';
			$post_types['sp_tfree_shortcodes'] = 'sp_tfree_shortcodes';
		}
		return $post_types;
	}
}
