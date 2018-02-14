<?php
/**
 * Handles both the activation and update functionality.
 *
 * @package Dynamik
 */

add_filter( 'update_theme_complete_actions', 'dynamik_update_action_links', 10, 2);
/**
 * Build update action link HTML.
 *
 * @since 1.0
 * @return Dynamik update finalize link.
 */
function dynamik_update_action_links( $actions, $theme )
{
	if( $theme != 'dynamik-gen' )
		return $actions;
		
	return '<a href="' . admin_url( 'admin.php?page=dynamik-settings' ) . '">'. __( 'Click here to complete your Dynamik Update', 'dynamik' ) .'</a>';	
}

add_action( 'admin_notices', 'dynamik_updated_notice' );
/**
 * Build "Dynamik Update Success" notice HTML.
 *
 * @since 1.0
 */
function dynamik_updated_notice()
{
	if( !isset( $_GET['page'] ) || $_GET['page'] != 'dynamik-settings' )
		return;
	
	if( isset( $_GET['updated'] ) && $_GET['updated'] == 'dynamik-gen' )
	{
		echo '<div id="update-nag">' . sprintf( __( 'Congratulations! Your update to <strong>Dynamik %s</strong> is complete.', 'dynamik' ), get_option( 'dynamik_gen_version_number' ) ) . '</div>';
	}
}

add_action( 'admin_init', 'dynamik_update' );
/**
 * Perform Dynamik updates based on current version number.
 *
 * @since 1.0
 */
function dynamik_update()
{
	if( !get_option( 'dynamik_gen_version_number' ) )
	{
		dynamik_activate();
	}
	else
	{
		// Don't do anything if we're on the latest version.
		if( version_compare( get_option( 'dynamik_gen_version_number' ), CHILD_THEME_VERSION, '>=' ) )
			return;

		// Update to Dynamik 1.0.1
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.0.1', '<' ) )
		{		
			$dynamik_settings = get_option( 'dynamik_gen_theme_settings' );
			$new_dynamik_settings = array(
				'custom_image_size_one_mode' => '',
				'custom_image_size_one_width' => '',
				'custom_image_size_one_height' => '',
				'custom_image_size_two_mode' => '',
				'custom_image_size_two_width' => '',
				'custom_image_size_two_height' => '',
				'custom_image_size_three_mode' => '',
				'custom_image_size_three_width' => '',
				'custom_image_size_three_height' => '',
				'custom_image_size_four_mode' => '',
				'custom_image_size_four_width' => '',
				'custom_image_size_four_height' => '',
				'custom_image_size_five_mode' => '',
				'custom_image_size_five_width' => '',
				'custom_image_size_five_height' => ''
			);
			$dynamik_settings = wp_parse_args( $new_dynamik_settings, $dynamik_settings );
			update_option( 'dynamik_gen_theme_settings', $dynamik_settings );
			
			update_option( 'dynamik_gen_version_number', '1.0.1' );
		}

		// Update to Dynamik 1.0.2
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.0.2', '<' ) )
		{
			$custom_functions = get_option( 'dynamik_gen_custom_functions' );
			$new_custom_functions = array(
				'custom_functions_effect_admin' => 0
			);
			$custom_functions = wp_parse_args( $new_custom_functions, $custom_functions );
			update_option( 'dynamik_gen_custom_functions', $custom_functions );

			update_option( 'dynamik_gen_version_number', '1.0.2' );
		}

		// Update to Dynamik 1.0.3
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.0.3', '<' ) )
		{
			$dynamik_design_settings = get_option( 'dynamik_gen_design_options' );
			$new_dynamik_settings = array(
				'comment_author_link_color' => '0D72C7',
				'comment_author_link_hover_color' => '0D72C7',
				'comment_author_link_underline' => 'On Hover',
				'comment_author_link_u' => 1
			);
			$dynamik_design_settings = wp_parse_args( $new_dynamik_settings, $dynamik_design_settings );
			update_option( 'dynamik_gen_design_options', $dynamik_design_settings );

			update_option( 'dynamik_gen_version_number', '1.0.3' );
		}

		// Update to Dynamik 1.0.4
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.0.4', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '1.0.4' );
		}

		// Update to Dynamik 1.1
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.1', '<' ) )
		{
			$dynamik_settings = get_option( 'dynamik_gen_theme_settings' );
			$new_dynamik_settings = array(
				'fancy_dropdowns_active' => 1,
				'html_five_active' => 0
			);
			$dynamik_settings = wp_parse_args( $new_dynamik_settings, $dynamik_settings );
			update_option( 'dynamik_gen_theme_settings', $dynamik_settings );

			$dynamik_design_settings = get_option( 'dynamik_gen_design_options' );
			$new_dynamik_design_settings = array(
				'comment_form_allowed_tags_font_size' => '14',
				'comment_form_allowed_tags_font_color' => '888888',
				'comment_form_allowed_tags_font_css' => '',
				'comment_form_allowed_tags_bg_type' => 'color',
				'comment_form_allowed_tags_bg_no_color' => 0,
				'comment_form_allowed_tags_bg_color' => 'F5F5F5',
				'comment_form_allowed_tags_bg_image' => '',
				'comment_form_allowed_tags_border_thickness' => '1',
				'comment_form_allowed_tags_border_style' => 'solid',
				'comment_form_allowed_tags_border_color' => 'DDDDDD',
				'comment_form_allowed_tags_margin_top' => '10',
				'comment_form_allowed_tags_margin_bottom' => '20',
				'comment_form_allowed_tags_padding_top' => '20',
				'comment_form_allowed_tags_padding_right' => '20',
				'comment_form_allowed_tags_padding_bottom' => '20',
				'comment_form_allowed_tags_padding_left' => '20',
				'comment_form_allowed_tags_font_u' => 'u'
			);
			$new_font_type_settings = array(
				'comment_form_allowed_tags' => 'Arial, sans-serif'
			);
			$dynamik_design_settings['font_type'] = wp_parse_args( $new_font_type_settings, $dynamik_design_settings['font_type'] );
			$dynamik_design_settings = wp_parse_args( $new_dynamik_design_settings, $dynamik_design_settings );
			update_option( 'dynamik_gen_design_options', $dynamik_design_settings );

			update_option( 'dynamik_gen_version_number', '1.1' );
		}

		// Update to Dynamik 1.2
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.2', '<' ) )
		{
			$dynamik_settings = get_option( 'dynamik_gen_theme_settings' );
			$new_dynamik_settings = array(
				'include_inpost_cpt_all' => 0
			);
			$dynamik_settings = wp_parse_args( $new_dynamik_settings, $dynamik_settings );
			update_option( 'dynamik_gen_theme_settings', $dynamik_settings );

			$dynamik_responsive_settings = get_option( 'dynamik_gen_responsive_options' );
			$new_dynamik_responsive_settings = array(
				'vertical_toggle_button_styles' => '.mobile-primary-toggle,
.mobile-secondary-toggle {
	width: 70px;
	margin: 0 auto;
	padding: 6px 10px;
	font-size: 13px; font-size: 1.3rem;
	font-weight: normal;
	color: #7c7c7c;
	text-align: center;
	background-color: #e6e6e6;
	background-repeat: repeat-x;
	background-image: -moz-linear-gradient(top, #f4f4f4, #e6e6e6);
	background-image: -ms-linear-gradient(top, #f4f4f4, #e6e6e6);
	background-image: -webkit-linear-gradient(top, #f4f4f4, #e6e6e6);
	background-image: -o-linear-gradient(top, #f4f4f4, #e6e6e6);
	background-image: linear-gradient(top, #f4f4f4, #e6e6e6);
	border: 1px solid #d2d2d2;
	border-radius: 3px;
	box-shadow: 0 1px 2px rgba(64, 64, 64, 0.1);
	cursor: pointer;
	display: none;
}
.mobile-primary-toggle:hover,
.mobile-secondary-toggle:hover {
	color: #5e5e5e;
	background-color: #ebebeb;
	background-repeat: repeat-x;
	background-image: -moz-linear-gradient(top, #f9f9f9, #ebebeb);
	background-image: -ms-linear-gradient(top, #f9f9f9, #ebebeb);
	background-image: -webkit-linear-gradient(top, #f9f9f9, #ebebeb);
	background-image: -o-linear-gradient(top, #f9f9f9, #ebebeb);
	background-image: linear-gradient(top, #f9f9f9, #ebebeb);
}
.mobile-primary-toggle:active,
.mobile-secondary-toggle:active {
	color: #757575;
	background-color: #e1e1e1;
	background-repeat: repeat-x;
	background-image: -moz-linear-gradient(top, #ebebeb, #e1e1e1);
	background-image: -ms-linear-gradient(top, #ebebeb, #e1e1e1);
	background-image: -webkit-linear-gradient(top, #ebebeb, #e1e1e1);
	background-image: -o-linear-gradient(top, #ebebeb, #e1e1e1);
	background-image: linear-gradient(top, #ebebeb, #e1e1e1);
	box-shadow: inset 0 0 8px 2px #c6c6c6, 0 1px 0 0 #f4f4f4;
	border: none;
}'
			);
			$dynamik_responsive_settings = wp_parse_args( $new_dynamik_responsive_settings, $dynamik_responsive_settings );
			update_option( 'dynamik_gen_responsive_options', $dynamik_responsive_settings );

			$do_shortcode_find = array( '[', ']' );
			$do_shortcode_replace = array( '&lt;?php echo do_shortcode( \'[', ']\' ); ?&gt;' );
			$updated_dynamik_hook_boxes = array();
			$dynamik_hook_boxes = get_option( 'dynamik_gen_custom_hook_boxes' );
			foreach( $dynamik_hook_boxes as $key => $value )
			{
				$value['hook_textarea'] = str_replace( $do_shortcode_find, $do_shortcode_replace, $value['hook_textarea'] );
				$updated_dynamik_hook_boxes[$key] = $value;
			}
			update_option( 'dynamik_gen_custom_hook_boxes', $updated_dynamik_hook_boxes );

			update_option( 'dynamik_gen_version_number', '1.2' );
		}

		// Update to Dynamik 1.2.1
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.2.1', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '1.2.1' );
		}

		// Update to Dynamik 1.2.2
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.2.2', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '1.2.2' );
		}

		// Update to Dynamik 1.3
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.3', '<' ) )
		{
			$dynamik_design_settings = get_option( 'dynamik_gen_design_options' );
			$new_dynamik_design_settings = array(
				'body_font_size' => $dynamik_design_settings['universal_px_em'] == 'em' ? ( $dynamik_design_settings['body_font_size'] / 10 ) : $dynamik_design_settings['body_font_size'],
				'title_font_size' => dynamik_one_three_update_font_size( 'title_font_size' ),
				'tagline_font_size' => dynamik_one_three_update_font_size( 'tagline_font_size' ),
				'nav1_font_size' => dynamik_one_three_update_font_size( 'nav1_font_size' ),
				'nav1_extras_font_size' => dynamik_one_three_update_font_size( 'nav1_extras_font_size' ),
				'nav2_font_size' => dynamik_one_three_update_font_size( 'nav2_font_size' ),
				'nav3_font_size' => dynamik_one_three_update_font_size( 'nav3_font_size' ),
				'content_heading_h1_font_size' => dynamik_one_three_update_font_size( 'content_heading_h1_font_size' ),
				'content_heading_h2_font_size' => dynamik_one_three_update_font_size( 'content_heading_h2_font_size' ),
				'content_heading_h3_font_size' => dynamik_one_three_update_font_size( 'content_heading_h3_font_size' ),
				'content_heading_h4_font_size' => dynamik_one_three_update_font_size( 'content_heading_h4_font_size' ),
				'content_heading_h5_font_size' => dynamik_one_three_update_font_size( 'content_heading_h5_font_size' ),
				'content_heading_h6_font_size' => dynamik_one_three_update_font_size( 'content_heading_h6_font_size' ),
				'content_byline_font_size' => dynamik_one_three_update_font_size( 'content_byline_font_size' ),
				'content_p_font_size' => dynamik_one_three_update_font_size( 'content_p_font_size' ),
				'blockquote_font_size' => dynamik_one_three_update_font_size( 'blockquote_font_size' ),
				'caption_font_size' => dynamik_one_three_update_font_size( 'caption_font_size' ),
				'post_meta_font_size' => dynamik_one_three_update_font_size( 'post_meta_font_size' ),
				'comment_heading_font_size' => dynamik_one_three_update_font_size( 'comment_heading_font_size' ),
				'comment_author_font_size' => dynamik_one_three_update_font_size( 'comment_author_font_size' ),
				'comment_meta_font_size' => dynamik_one_three_update_font_size( 'comment_meta_font_size' ),
				'comment_body_font_size' => dynamik_one_three_update_font_size( 'comment_body_font_size' ),
				'comment_form_font_size' => dynamik_one_three_update_font_size( 'comment_form_font_size' ),
				'comment_submit_font_size' => dynamik_one_three_update_font_size( 'comment_submit_font_size' ),
				'comment_form_allowed_tags_font_size' => dynamik_one_three_update_font_size( 'comment_form_allowed_tags_font_size' ),
				'sb_heading_font_size' => dynamik_one_three_update_font_size( 'sb_heading_font_size' ),
				'sb_content_font_size' => dynamik_one_three_update_font_size( 'sb_content_font_size' ),
				'footer_font_size' => dynamik_one_three_update_font_size( 'footer_font_size' ),
				'ez_widget_home_title_font_size' => dynamik_one_three_update_font_size( 'ez_widget_home_title_font_size' ),
				'ez_widget_home_content_font_size' => dynamik_one_three_update_font_size( 'ez_widget_home_content_font_size' ),
				'ez_widget_feature_title_font_size' => dynamik_one_three_update_font_size( 'ez_widget_feature_title_font_size' ),
				'ez_widget_feature_content_font_size' => dynamik_one_three_update_font_size( 'ez_widget_feature_content_font_size' ),
				'ez_widget_footer_title_font_size' => dynamik_one_three_update_font_size( 'ez_widget_footer_title_font_size' ),
				'ez_widget_footer_content_font_size' => dynamik_one_three_update_font_size( 'ez_widget_footer_content_font_size' ),
				'featured_widget_heading_font_size' => dynamik_one_three_update_font_size( 'featured_widget_heading_font_size' ),
				'featured_widget_byline_font_size' => dynamik_one_three_update_font_size( 'featured_widget_byline_font_size' ),
				'featured_widget_p_font_size' => dynamik_one_three_update_font_size( 'featured_widget_p_font_size' ),
				'dynamik_widget_title_font_size' => dynamik_one_three_update_font_size( 'dynamik_widget_title_font_size' ),
				'dynamik_widget_content_font_size' => dynamik_one_three_update_font_size( 'dynamik_widget_content_font_size' ),
				'search_form_font_size' => dynamik_one_three_update_font_size( 'search_form_font_size' ),
				'search_button_font_size' => dynamik_one_three_update_font_size( 'search_button_font_size' ),
				'breadcrumbs_font_size' => dynamik_one_three_update_font_size( 'breadcrumbs_font_size' ),
				'taxonomy_box_heading_font_size' => dynamik_one_three_update_font_size( 'taxonomy_box_heading_font_size' ),
				'taxonomy_box_content_font_size' => dynamik_one_three_update_font_size( 'taxonomy_box_content_font_size' ),
				'author_box_title_font_size' => dynamik_one_three_update_font_size( 'author_box_title_font_size' ),
				'author_box_font_size' => dynamik_one_three_update_font_size( 'author_box_font_size' ),
				'post_nav_font_size' => dynamik_one_three_update_font_size( 'post_nav_font_size' ),
				'universal_link_transition_active' => 0,
				'universal_link_transition_style' => 'all 0.2s ease-in-out',
				'general_shadow_active' => 0,
				'general_shadow_style' => '0 1px 1px #EEEEEE',
				'general_shadow_elements' => '.taxonomy-description, .content blockquote, .author-description, .author-box, .comment-list li, .ping-list li, a.comment-reply-link, #author, #comment, #email, #url, #respond p.form-allowed-tags, #commentform #submit, .sidebar.widget-area .widget, .breadcrumb, .search-form input[type="submit"], #subbutton, .search-form input[type="search"], #subbox, .pagination li a',
				'general_radius_active' => 0,
				'general_radius_style' => '3px',
				'general_radius_elements' => '.content .taxonomy-description h1, .content .author-description h1, .taxonomy-description, .content blockquote, .author-description, .author-box, .comment-list li, .ping-list li, a.comment-reply-link, #author, #comment, #email, #url, #respond p.form-allowed-tags, #commentform #submit, .sidebar-primary h4, .sidebar-secondary h4, #ez-home-sidebar h4, .sidebar.widget-area .widget, .breadcrumb, .search-form input[type="submit"], #subbutton, .search-form input[type="search"], #subbox, .pagination li a',
				'header_widget_text_align' => 'left',
				'comment_reply_text_font_size' => dynamik_one_three_update_font_size( 'comment_body_font_size' ),
				'comment_reply_text_link_color' => $dynamik_design_settings['comment_link_color'],
				'comment_reply_text_link_hover_color' => $dynamik_design_settings['comment_link_hover_color'],
				'comment_reply_text_link_underline' => $dynamik_design_settings['comment_link_underline'],
				'comment_reply_text_font_css' => $dynamik_design_settings['comment_body_font_css'],
				'comment_reply_text_font_u' => $dynamik_design_settings['comment_body_font_u'],
				'comment_reply_text_link_u' => $dynamik_design_settings['comment_link_u'],
				'comment_reply_text_bg_type' => 'transparent',
				'comment_reply_text_bg_no_color' => 0,
				'comment_reply_text_bg_color' => 'FFFFFF',
				'comment_reply_text_bg_image' => '',
				'comment_reply_text_hover_bg_type' => 'transparent',
				'comment_reply_text_hover_bg_no_color' => 0,
				'comment_reply_text_hover_bg_color' => 'FFFFFF',
				'comment_reply_text_hover_bg_image' => '',
				'comment_list_border_type' => 'Full',
				'comment_list_border_thickness' => '1',
				'comment_list_border_style' => 'solid',
				'comment_list_border_color' => 'DDDDDD',
				'comment_reply_text_border_type' => 'Full',
				'comment_reply_text_border_thickness' => '0',
				'comment_reply_text_border_style' => 'solid',
				'comment_reply_text_border_color' => 'E8E8E8',
				'comment_reply_text_hover_border_type' => 'Full',
				'comment_reply_text_hover_border_thickness' => '0',
				'comment_reply_text_hover_border_style' => 'solid',
				'comment_reply_text_hover_border_color' => 'E8E8E8',
				'comment_reply_text_padding_top' => '0',
				'comment_reply_text_padding_right' => '0',
				'comment_reply_text_padding_bottom' => '0',
				'comment_reply_text_padding_left' => '0',
				'dynamik_widget_column_class_compatible' => 0
			);
			$new_font_type_settings = array(
				'comment_reply_text' => $dynamik_design_settings['font_type']['comment_body']
			);
			$dynamik_design_settings['font_type'] = wp_parse_args( $new_font_type_settings, $dynamik_design_settings['font_type'] );
			$dynamik_design_settings = wp_parse_args( $new_dynamik_design_settings, $dynamik_design_settings );
			update_option( 'dynamik_gen_design_options', $dynamik_design_settings );

			$media_wrap_width = dynamik_get_responsive( 'media_wrap_width' );
			$dynamik_responsive_settings = get_option( 'dynamik_gen_responsive_options' );
			$vertical_toggle_button_styles = $dynamik_responsive_settings['vertical_toggle_button_styles'];
			$vertical_toggle_button_styles_updated = '.responsive-primary-menu-container { display: none; }' . "\n";
			$vertical_toggle_button_styles_updated .= $vertical_toggle_button_styles;
			$vertical_toggle_button_subnav_styles_updated = '.responsive-secondary-menu-container { display: none; }' . "\n";
			$vertical_toggle_button_subnav_styles_updated .= $vertical_toggle_button_styles;
			$new_dynamik_responsive_settings = array(
				'delayed_header_title_area_width' => '320',
				'delayed_sidebar_width' => '280',
				'vertical_menu_sub_page_pre_text' => '',
				'vertical_menu_sub_page_text_align' => 'center',
				'hamburger_icon_1_margin_top' => '-32',
				'hamburger_icon_2_margin_top' => '-32',
				'vertical_toggle_sub_page_reveal' => 0,
				'vertical_toggle_button_styles' => $vertical_toggle_button_styles_updated,
				'vertical_toggle_button_subnav_styles' => $vertical_toggle_button_subnav_styles_updated,
				'media_query_large_cascading_width' => $media_wrap_width,
				'dynamik_media_query_large_min_width' => '768',
				'dynamik_media_query_large_max_width' => $media_wrap_width,
				'dynamik_media_query_medium_large_min_width' => '480',
				'dynamik_media_query_medium_large_max_width' => $media_wrap_width,
				'media_query_medium_cascading_width' => '767',
				'dynamik_media_query_medium_min_width' => '480',
				'dynamik_media_query_medium_max_width' => '767',
				'media_query_small_width' => '479'
			);
			$dynamik_responsive_settings = wp_parse_args( $new_dynamik_responsive_settings, $dynamik_responsive_settings );
			update_option( 'dynamik_gen_responsive_options', $dynamik_responsive_settings );

			update_option( 'dynamik_gen_version_number', '1.3' );
		}

		// Update to Dynamik 1.3.1
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.3.1', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '1.3.1' );
		}

		// Update to Dynamik 1.4
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.4', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '1.4' );
		}

		// Update to Dynamik 1.4.1
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.4.1', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '1.4.1' );
		}

		// Update to Dynamik 1.4.2
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.4.2', '<' ) )
		{
			$dynamik_settings = get_option( 'dynamik_gen_theme_settings' );
			$new_dynamik_settings = array(
				'bootstrap_column_classes_active' => 0
			);
			$dynamik_settings = wp_parse_args( $new_dynamik_settings, $dynamik_settings );
			update_option( 'dynamik_gen_theme_settings', $dynamik_settings );

			$dynamik_design_settings = get_option( 'dynamik_gen_design_options' );
			$new_dynamik_design_settings = array(
				'retina_logo_active' =>  0,
				'retina_logo_image' => ''
			);
			$dynamik_design_settings = wp_parse_args( $new_dynamik_design_settings, $dynamik_design_settings );
			update_option( 'dynamik_gen_design_options', $dynamik_design_settings );

			update_option( 'dynamik_gen_version_number', '1.4.2' );
		}

		// Update to Dynamik 1.5
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.5', '<' ) )
		{
			$dynamik_settings = get_option( 'dynamik_gen_theme_settings' );
			$new_dynamik_settings = array(
				'protected_folders' => ''
			);
			$dynamik_settings = wp_parse_args( $new_dynamik_settings, $dynamik_settings );
			update_option( 'dynamik_gen_theme_settings', $dynamik_settings );

			$dynamik_design_settings = get_option( 'dynamik_gen_design_options' );
			$new_dynamik_design_settings = array(
				'add_google_fonts' =>  dynamik_deprecated_google_fonts_list()
			);
			
			foreach( $dynamik_design_settings['font_type'] as $key => $value )
			{
				$dynamik_font_type_family_name = substr( $value, 0, strpos( $value, ',' ) );
				$dynamik_design_settings['font_type'][$key] = str_replace( '\'', '', $dynamik_font_type_family_name );
			}

			$dynamik_design_settings = wp_parse_args( $new_dynamik_design_settings, $dynamik_design_settings );
			update_option( 'dynamik_gen_design_options', $dynamik_design_settings );

			$dynamik_responsive_settings = get_option( 'dynamik_gen_responsive_options' );
			$new_dynamik_responsive_settings = array(
				'content_media_query_padded' => 1
			);
			$dynamik_responsive_settings = wp_parse_args( $new_dynamik_responsive_settings, $dynamik_responsive_settings );
			update_option( 'dynamik_gen_responsive_options', $dynamik_responsive_settings );

			update_option( 'dynamik_gen_version_number', '1.5' );
		}

		// Update to Dynamik 1.6
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.6', '<' ) )
		{
			$dynamik_settings = get_option( 'dynamik_gen_theme_settings' );
			$new_dynamik_settings = array(
				'protocol_relative_urls' => 1,
				'codemirror_active' => 1
			);
			$dynamik_settings = wp_parse_args( $new_dynamik_settings, $dynamik_settings );
			update_option( 'dynamik_gen_theme_settings', $dynamik_settings );

			dynamik_skin_options_update( 'default' );
			$dynamik_gen_design_snapshot_options = get_option( 'dynamik_gen_design_snapshot_options' );
			$dynamik_gen_default_skin = get_option( 'dynamik_gen_default_skin' );
			$new_dynamik_gen_default_skin['design_options_snapshot'] = $dynamik_gen_design_snapshot_options['design_options'];
			$new_dynamik_gen_default_skin['responsive_options_snapshot'] = $dynamik_gen_design_snapshot_options['responsive_options'];
			$new_dynamik_gen_default_skin['snapshot_timestamp'] = $dynamik_gen_design_snapshot_options['timestamp'];
			$dynamik_gen_default_skin = wp_parse_args( $new_dynamik_gen_default_skin, $dynamik_gen_default_skin );
			update_option( 'dynamik_gen_default_skin', $dynamik_gen_default_skin );

			update_option( 'dynamik_gen_version_number', '1.6' );
		}

		// Update to Dynamik 1.6.1
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.6.1', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '1.6.1' );
		}

		// Update to Dynamik 1.6.2
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.6.2', '<' ) )
		{
			$dynamik_design_settings = get_option( 'dynamik_gen_design_options' );
			$new_dynamik_design_settings = array(
				'font_awesome_css' => 0
			);
			$dynamik_design_settings = wp_parse_args( $new_dynamik_design_settings, $dynamik_design_settings );
			update_option( 'dynamik_gen_design_options', $dynamik_design_settings );

			update_option( 'dynamik_gen_version_number', '1.6.2' );
		}

		// Update to Dynamik 1.6.3
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.6.3', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '1.6.3' );
		}

		// Update to Dynamik 1.7
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.7', '<' ) )
		{
			$dynamik_design_settings = get_option( 'dynamik_gen_design_options' );
			$new_dynamik_design_settings = array(
				'nav1_sub_page_font_size' => $dynamik_design_settings['nav1_font_size'],
				'nav2_sub_page_font_size' => $dynamik_design_settings['nav2_font_size'],
				'nav3_sub_page_font_size' => $dynamik_design_settings['nav3_font_size']
			);
			$dynamik_design_settings = wp_parse_args( $new_dynamik_design_settings, $dynamik_design_settings );
			update_option( 'dynamik_gen_design_options', $dynamik_design_settings );

			$dynamik_responsive_settings = get_option( 'dynamik_gen_responsive_options' );
			$new_dynamik_responsive_settings = array(
				'primary_menu_as_mobile_header_menu' => 0
			);
			$dynamik_responsive_settings = wp_parse_args( $new_dynamik_responsive_settings, $dynamik_responsive_settings );
			update_option( 'dynamik_gen_responsive_options', $dynamik_responsive_settings );

			update_option( 'dynamik_gen_version_number', '1.7' );
		}

		// Update to Dynamik 1.7.1
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.7.1', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '1.7.1' );
		}

		// Update to Dynamik 1.7.2
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.7.2', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '1.7.2' );
		}

		// Update to Dynamik 1.8
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.8', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '1.8' );
		}

		// Update to Dynamik 1.8.1
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.8.1', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '1.8.1' );
		}

		// Update to Dynamik 1.8.2
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.8.2', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '1.8.2' );
		}

		// Update to Dynamik 1.9
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.9', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '1.9' );
		}

		// Update to Dynamik 1.9.1
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.9.1', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '1.9.1' );
		}

		// Update to Dynamik 1.9.2
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.9.2', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '1.9.2' );
		}

		// Update to Dynamik 1.9.3
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.9.3', '<' ) )
		{
			$dynamik_design_settings = get_option( 'dynamik_gen_design_options' );
			if( genesis_get_option( 'blog_title' ) == 'image' ) {
				$header_title_area_height = $dynamik_design_settings['header_height'] - $dynamik_design_settings['image_logo_top_margin'];
			}
			else
			{
				$header_title_area_height = $dynamik_design_settings['header_height'];
			}
			$new_dynamik_design_settings = array(
				'header_title_area_center' => 0,
				'header_title_area_height' => $header_title_area_height,
				'image_logo_bottom_margin' => '0',
				'nav1_alignment' => 'Left',
				'nav2_alignment' => 'Left'
			);
			$dynamik_design_settings = wp_parse_args( $new_dynamik_design_settings, $dynamik_design_settings );
			update_option( 'dynamik_gen_design_options', $dynamik_design_settings );

			update_option( 'dynamik_gen_version_number', '1.9.3' );
		}

		// Update to Dynamik 1.9.4
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.9.4', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '1.9.4' );
		}

		// Update to Dynamik 1.9.5
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.9.5', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '1.9.5' );
		}

		// Update to Dynamik 1.9.6
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.9.6', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '1.9.6' );
		}

		// Update to Dynamik 1.9.7
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.9.7', '<' ) )
		{
			$dynamik_design_settings = get_option( 'dynamik_gen_design_options' );
			$new_dynamik_design_settings = array(
				'content_filler_image_type' => 'Minimal',
				'content_filler_image_background_type' => 'Transparent',
				'content_filler_image_background_color' => 'FFFFFF'
			);
			$dynamik_design_settings = wp_parse_args( $new_dynamik_design_settings, $dynamik_design_settings );
			update_option( 'dynamik_gen_design_options', $dynamik_design_settings );

			update_option( 'dynamik_gen_version_number', '1.9.7' );
		}

		// Update to Dynamik 1.9.8
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.9.8', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '1.9.8' );
		}
		
		// Update to Dynamik 1.9.9
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '1.9.9', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '1.9.9' );
		}
		
		// Update to Dynamik 2.0
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '2.0', '<' ) )
		{
			$dynamik_design_settings = get_option( 'dynamik_gen_design_options' );
			$new_dynamik_design_settings = array(
				'fixed_header' => 'disabled'
			);
			$dynamik_design_settings = wp_parse_args( $new_dynamik_design_settings, $dynamik_design_settings );
			update_option( 'dynamik_gen_design_options', $dynamik_design_settings );

			update_option( 'dynamik_gen_version_number', '2.0' );
		}
		
		// Update to Dynamik 2.0.1
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '2.0.1', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '2.0.1' );
		}
		
		// Update to Dynamik 2.0.2
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '2.0.2', '<' ) )
		{
			$dynamik_settings = get_option( 'dynamik_gen_theme_settings' );
			$new_dynamik_settings = array(
				'enable_ace_editor_syntax_validation' => 1
			);
			$dynamik_settings = wp_parse_args( $new_dynamik_settings, $dynamik_settings );
			update_option( 'dynamik_gen_theme_settings', $dynamik_settings );

			update_option( 'dynamik_gen_version_number', '2.0.2' );
		}
		
		// Update to Dynamik 2.0.3
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '2.0.3', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '2.0.3' );
		}
		
		// Update to Dynamik 2.0.4
		if( version_compare( get_option( 'dynamik_gen_version_number' ), '2.0.4', '<' ) )
		{
			update_option( 'dynamik_gen_version_number', '2.0.4' );
		}
		
		// Finish the update sequence.
		dynamik_protect_folders( 'restore' );
		dynamik_activate();
		wp_redirect( admin_url( 'admin.php?page=dynamik-settings&updated=dynamik-gen' ) );
	}
}

/**
 * Perform Dynamik activation actions.
 *
 * @since 1.0
 */
function dynamik_activate()
{
	global $dynamik_folders;
	
	if( !get_option( 'dynamik_gen_version_number' ) )
	{
		update_option( 'dynamik_gen_version_number', CHILD_THEME_VERSION );
	}
	
	if( !get_option( 'dynamik_gen_theme_settings' ) )
	{
		update_option( 'dynamik_gen_theme_settings', dynamik_theme_settings_defaults() );
	}
	if( !get_option( 'dynamik_gen_design_options' ) )
	{
		update_option( 'dynamik_gen_design_options', dynamik_design_options_defaults() );
	}
	if( !get_option( 'dynamik_gen_responsive_options' ) )
	{
		update_option( 'dynamik_gen_responsive_options', dynamik_responsive_options_defaults() );
	}
	if( !get_option( 'dynamik_gen_skin_options' ) )
	{
		update_option( 'dynamik_gen_skin_options', array( 'available_skins' => array( 'default' ), 'active_skin' => 'default' ) );
	}
	if( !get_option( 'dynamik_gen_default_skin' ) )
	{
		dynamik_skin_options_update( 'default' );
	}
	if( !get_option( 'dynamik_gen_custom_css' ) )
	{
		update_option( 'dynamik_gen_custom_css', dynamik_custom_css_options_defaults() );
	}
	if( !get_option( 'dynamik_gen_custom_functions' ) )
	{
		update_option( 'dynamik_gen_custom_functions', dynamik_custom_functions_options_defaults() );
	}
	if( !get_option( 'dynamik_gen_custom_js' ) )
	{
		update_option( 'dynamik_gen_custom_js', dynamik_custom_js_options_defaults() );
	}
	if( !get_option( 'dynamik_gen_custom_templates' ) )
	{
		update_option( 'dynamik_gen_custom_templates', array() );
	}
	if( !get_option( 'dynamik_gen_custom_labels' ) )
	{
		update_option( 'dynamik_gen_custom_labels', array() );
	}
	if( !get_option( 'dynamik_gen_custom_conditionals' ) )
	{
		update_option( 'dynamik_gen_custom_conditionals', array() );
	}
	if( !get_option( 'dynamik_gen_custom_widget_areas' ) )
	{
		update_option( 'dynamik_gen_custom_widget_areas', array() );
	}
	if( !get_option( 'dynamik_gen_custom_hook_boxes' ) )
	{
		update_option( 'dynamik_gen_custom_hook_boxes', array() );
	}

	dynamik_dir_check( CHILD_DIR . '/my-templates' );
	dynamik_dir_check( dynamik_get_stylesheet_location( 'path', $root = true ) );
	dynamik_dir_check( dynamik_get_stylesheet_location( 'path', $root = true ) . 'theme' );
	dynamik_dir_check( dynamik_get_stylesheet_location( 'path', $root = true ) . 'protected-folders' );
	dynamik_dir_check( dynamik_get_skins_folder_path() );
	dynamik_dir_check( dynamik_get_skins_folder_path() . '/default/' );
	dynamik_dir_check( dynamik_get_skins_folder_path() . '/default/images/' );
	dynamik_dir_check( dynamik_get_skins_folder_path() . '/default/images/adminthumbnails/' );

	// Delete current /default-images/ directory if it exists to ensure folder is fully updated with all current images.
	dynamik_delete_dir( dynamik_get_stylesheet_location( 'path' ) . 'default-images' );
	dynamik_dir_check( dynamik_get_stylesheet_location( 'path' ) . 'default-images' );
	dynamik_dir_check( dynamik_get_stylesheet_location( 'path' ) . 'default-images/post-formats' );

	$handle = opendir( CHILD_DIR . '/images' );
	while( false !== ( $file = readdir( $handle ) ) && is_dir( dynamik_get_stylesheet_location( 'path' ) . 'default-images' ) )
	{
		$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
		if( $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' )
		{
			copy( CHILD_DIR . '/images/' . $file, dynamik_get_stylesheet_location( 'path' ) . 'default-images/' . $file );
		}
	}
	closedir( $handle );
	
	$handle = opendir( CHILD_DIR . '/images/post-formats' );
	while( false !== ( $file = readdir( $handle ) ) && is_dir( dynamik_get_stylesheet_location( 'path' ) . 'default-images/post-formats' ) )
	{
		$ext = strtolower( substr( strrchr( $file, '.' ), 1 ) );
		if( $ext == 'jpg' || $ext == 'jpeg' || $ext == 'gif' || $ext == 'png' )
		{
			copy( CHILD_DIR . '/images/post-formats/' . $file, dynamik_get_stylesheet_location( 'path' ) . 'default-images/post-formats/' . $file );
		}
	}
	closedir( $handle );
	
	dynamik_dir_check( dynamik_get_stylesheet_location( 'path' ) . 'images' );
	dynamik_dir_check( dynamik_get_stylesheet_location( 'path' ) . 'images/adminthumbnails' );
	dynamik_dir_check( dynamik_get_stylesheet_location( 'path' ) . 'tmp' );
	dynamik_dir_check( dynamik_get_stylesheet_location( 'path' ) . 'tmp/images' );
	dynamik_dir_check( dynamik_get_stylesheet_location( 'path' ) . 'tmp/images/adminthumbnails' );

	dynamik_write_files();
	dynamik_create_custom_functions_file();
	
	$dynamik_unwritable = false;
	foreach( $dynamik_folders as $dynamik_folder )
	{
		if( is_dir( $dynamik_folder ) && !dynamik_writable( $dynamik_folder ) )
		{
			$dynamik_unwritable = true;
		}
	}
	if( $dynamik_unwritable )
	{
		wp_redirect( admin_url( 'admin.php?page=dynamik-settings&notice=dynamik-unwritable' ) );
	}
}

/**
 * Properly convert font sizes for the 1.3 update.
 *
 * @since 1.3
 */
function dynamik_one_three_update_font_size( $font_size_key )
{
	// Build the necessary variables
	$dynamik_design_settings = get_option( 'dynamik_gen_design_options' );
	// Build the $px_em_key based on either the $font_size_key alone or with the addition
	// of 'content_heading_' to accomodate the different naming convention of the Content Headings
	$px_em_key = substr( $font_size_key, 0, 15 ) == 'content_heading' ? substr( $font_size_key, 16, -10 ) . '_px_em' : substr( $font_size_key, 0, -10 ) . '_px_em';
	$body_font_size = $dynamik_design_settings['body_font_size'];
	$font_size = $dynamik_design_settings[$font_size_key];
	$font_value_conversion_px = $font_size * $body_font_size;
	$font_value_conversion_rem = $font_value_conversion_px / 10;
	if( $dynamik_design_settings['universal_px_em'] == 'em' && $dynamik_design_settings[$px_em_key] == 'em' )
		$new_font_size = round( $font_value_conversion_rem, 1 );
	elseif( $dynamik_design_settings['universal_px_em'] == 'em' && $dynamik_design_settings[$px_em_key] == 'px' )
		$new_font_size = $font_size / 10;
	elseif( $dynamik_design_settings['universal_px_em'] == 'px' && $dynamik_design_settings[$px_em_key] == 'em' )
		$new_font_size = round( $font_value_conversion_px );
	else
		$new_font_size = $font_size;

	return $new_font_size;
}
