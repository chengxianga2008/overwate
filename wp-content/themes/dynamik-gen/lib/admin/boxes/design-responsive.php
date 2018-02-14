<?php
/**
 * Builds the Dynamik Responsive admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-design-options-nav-<?php echo $nav_alt_id; ?>responsive-box" class="dynamik-not-universal dynamik-all-options">
	<h3 style="margin-bottom:15px;">
		<?php _e( 'Responsive', 'dynamik' ); ?>
		<span id="show-hide-responsive-options" class="dynamik-options-reset-button button dynamik-structure-settings-hide" style="float:none !important; font-weight:normal;"><?php _e( 'Show/Hide Options', 'dynamik' ); ?></span><a href="http://dynamikdocs.cobaltapps.com/article/43-responsive-design-options" class="tooltip-mark" target="_blank">[?]</a>
	</h3>
	
	<form action="/" id="responsive-options-form" name="responsive-options-form">
	<input type="hidden" name="action" value="dynamik_responsive_options_save" />
	<input type="hidden" name="security" value="<?php echo wp_create_nonce( 'responsive-options' ); ?>" />
	<div id="show-hide-responsive-options-box" class="dynamik-custom-fonts-box" style="background:none; border:none; width:100%; padding:0; float:left; display:none; position:inherit;">
		<h3 class="dynamik-wide-option-heading"><?php _e( 'Meta/Script Options', 'dynamik' ); ?></h3>
		<div class="dynamik-responsive-options-box-wrap">
			<div class="bg-box">
				<p style="margin:0;">
					<code>&#60;meta name=&#34;viewport&#34; content=&#34;</code><input type="text" id="dynamik-viewport-meta-content" class="responsive-option" name="dynamik[viewport_meta_content]" value="<?php if( dynamik_get_responsive( 'viewport_meta_content' ) != '' ) { echo dynamik_get_responsive( 'viewport_meta_content' ); } else { echo 'width=device-width, initial-scale=1.0'; } ?>" style="width:220px;" /><code>&#34; id=&#34;dynamik-viewport&#34;&#62;</code>
					<a href="http://dynamikdocs.cobaltapps.com/article/44-responsive-meta-options" class="tooltip-mark" target="_blank">[?]</a>
				</p>
			</div>
		</div>
		
		<h3 class="dynamik-wide-option-heading"><?php _e( 'Default Media Query Options', 'dynamik' ); ?></h3>
		<div class="dynamik-responsive-options-box-wrap">
			<div class="bg-box responsive-options-2col-left">
				<p>
					<?php _e( 'Site #wrap Media Query Styles:', 'dynamik' ); ?> <select id="dynamik-wrap-media-query-default" class="responsive-option" name="dynamik[wrap_media_query_default]" size="1" style="width:80px;">
						<option value="default"<?php if( dynamik_get_responsive( 'wrap_media_query_default' ) == 'default' ) echo ' selected="selected"'; ?>><?php _e( 'Default', 'dynamik' ); ?></option>
						<option value="none"<?php if( dynamik_get_responsive( 'wrap_media_query_default' ) == 'none' ) echo ' selected="selected"'; ?>><?php _e( 'None', 'dynamik' ); ?></option>
					</select>
					<a href="http://dynamikdocs.cobaltapps.com/article/45-responsive-site-wrap-media-query-styles" class="tooltip-mark" target="_blank">[?]</a>
				</p>
			</div>

			<div class="bg-box responsive-options-2col-right">
				<p>
					<?php _e( 'Navbar Media Query Styles:', 'dynamik' ); ?> <select id="dynamik-navbar-media-query-default" class="responsive-option" name="dynamik[navbar_media_query_default]" size="1" style="width:130px;">
						<option value="default"<?php if( dynamik_get_responsive( 'navbar_media_query_default' ) == 'default' ) echo ' selected="selected"'; ?>><?php _e( 'Default', 'dynamik' ); ?></option>
						<option value="vertical"<?php if( dynamik_get_responsive( 'navbar_media_query_default' ) == 'vertical' ) echo ' selected="selected"'; ?>><?php _e( 'Vertical Mobile', 'dynamik' ); ?></option>
						<option value="vertical_toggle_tablet"<?php if( dynamik_get_responsive( 'navbar_media_query_default' ) == 'vertical_toggle_tablet' ) echo ' selected="selected"'; ?>><?php _e( 'Vertical Toggle Tablet', 'dynamik' ); ?></option>
						<option value="vertical_toggle"<?php if( dynamik_get_responsive( 'navbar_media_query_default' ) == 'vertical_toggle' ) echo ' selected="selected"'; ?>><?php _e( 'Vertical Toggle Mobile', 'dynamik' ); ?></option>
						<option value="tablet_dropdown"<?php if( dynamik_get_responsive( 'navbar_media_query_default' ) == 'tablet_dropdown' ) echo ' selected="selected"'; ?>><?php _e( 'Tablet Dropdown', 'dynamik' ); ?></option>
						<option value="mobile_dropdown"<?php if( dynamik_get_responsive( 'navbar_media_query_default' ) == 'mobile_dropdown' ) echo ' selected="selected"'; ?>><?php _e( 'Mobile Dropdown', 'dynamik' ); ?></option>
						<option value="none"<?php if( dynamik_get_responsive( 'navbar_media_query_default' ) == 'none' ) echo ' selected="selected"'; ?>><?php _e( 'None', 'dynamik' ); ?></option>
					</select>
					<?php _e( 'Delay?', 'dynamik' ); ?> <input type="checkbox" id="dynamik-navbar-media-query-delayed" class="responsive-option" name="dynamik[navbar_media_query_delayed]" value="1" <?php if( checked( 1, dynamik_get_responsive( 'navbar_media_query_delayed' ) ) ); ?> />
					<a href="http://dynamikdocs.cobaltapps.com/article/46-responsive-navbar-media-query-styles" class="tooltip-mark" target="_blank">[?]</a>
				</p>
			</div>
			
			<div style="clear:both;"></div>
			
			<div class="bg-box responsive-options-2col-left">
				<p>
					<?php _e( 'Header Media Query Styles:', 'dynamik' ); ?> <select id="dynamik-header-media-query-default" class="responsive-option" name="dynamik[header_media_query_default]" size="1" style="width:80px;">
						<option value="default"<?php if( dynamik_get_responsive( 'header_media_query_default' ) == 'default' ) echo ' selected="selected"'; ?>><?php _e( 'Default', 'dynamik' ); ?></option>
						<option value="delayed"<?php if( dynamik_get_responsive( 'header_media_query_default' ) == 'delayed' ) echo ' selected="selected"'; ?>><?php _e( 'Delayed', 'dynamik' ); ?></option>
						<option value="none"<?php if( dynamik_get_responsive( 'header_media_query_default' ) == 'none' ) echo ' selected="selected"'; ?>><?php _e( 'None', 'dynamik' ); ?></option>
					</select>
					<a href="http://dynamikdocs.cobaltapps.com/article/47-responsive-header-media-query-styles" class="tooltip-mark" target="_blank">[?]</a>
				</p>
			</div>
			
			<div class="bg-box responsive-options-2col-right">
				<p>
					<?php _e( 'Content/Sidebar Media Query Styles:', 'dynamik' ); ?> <select id="dynamik-content-media-query-default" class="responsive-option" name="dynamik[content_media_query_default]" size="1" style="width:80px;">
						<option value="default"<?php if( dynamik_get_responsive( 'content_media_query_default' ) == 'default' ) echo ' selected="selected"'; ?>><?php _e( 'Default', 'dynamik' ); ?></option>
						<option value="delayed"<?php if( dynamik_get_responsive( 'content_media_query_default' ) == 'delayed' ) echo ' selected="selected"'; ?>><?php _e( 'Delayed', 'dynamik' ); ?></option>
						<option value="none"<?php if( dynamik_get_responsive( 'content_media_query_default' ) == 'none' ) echo ' selected="selected"'; ?>><?php _e( 'None', 'dynamik' ); ?></option>
					</select>
					<?php _e( 'Pad?', 'dynamik' ); ?> <input type="checkbox" id="dynamik-content-media-query-padded" class="responsive-option" name="dynamik[content_media_query_padded]" value="1" <?php if( checked( 1, dynamik_get_responsive( 'content_media_query_padded' ) ) ); ?> />
					<a href="http://dynamikdocs.cobaltapps.com/article/48-responsive-content-sidebar-media-query-styles" class="tooltip-mark" target="_blank">[?]</a>
				</p>
			</div>
			
			<div style="clear:both;"></div>

			<div id="dynamik-display-delayed-header-title-area-width-box" class="bg-box responsive-options-2col-left" style="display:none;">
				<p>
					<?php _e( 'Delayed Title Area Width:', 'dynamik' ); ?>
					<input type="text" id="dynamik-delayed-header-title-area-width" class="responsive-option" name="dynamik[delayed_header_title_area_width]" value="<?php echo dynamik_get_responsive( 'delayed_header_title_area_width' ) ?>" style="width:40px;" /><code class="dynamik-px-unit">px</code>
					<a href="http://dynamikdocs.cobaltapps.com/article/49-responsive-delayed-title-area-width" class="tooltip-mark" target="_blank">[?]</a>
				</p>
			</div>

			<div id="dynamik-display-delayed-sidebar-width-box" class="bg-box responsive-options-2col-right" style="display:none;">
				<p>
					<?php _e( 'Delayed Sidebar Width:', 'dynamik' ); ?>
					<input type="text" id="dynamik-delayed-sidebar-width" class="responsive-option" name="dynamik[delayed_sidebar_width]" value="<?php echo dynamik_get_responsive( 'delayed_sidebar_width' ) ?>" style="width:40px;" /><code class="dynamik-px-unit">px</code>
					<a href="http://dynamikdocs.cobaltapps.com/article/50-responsive-delayed-sidebar-width" class="tooltip-mark" target="_blank">[?]</a>
				</p>
			</div>
			
			<div style="clear:both;"></div>
			
			<div class="bg-box responsive-options-2col-left">
				<p>
					<?php _e( 'EZ Widget Area Media Query Styles:', 'dynamik' ); ?> <select id="dynamik-ez-media-query-default" class="responsive-option" name="dynamik[ez_media_query_default]" size="1" style="width:80px;">
						<option value="default"<?php if( dynamik_get_responsive( 'ez_media_query_default' ) == 'default' ) echo ' selected="selected"'; ?>><?php _e( 'Default', 'dynamik' ); ?></option>
						<option value="delayed"<?php if( dynamik_get_responsive( 'ez_media_query_default' ) == 'delayed' ) echo ' selected="selected"'; ?>><?php _e( 'Delayed', 'dynamik' ); ?></option>
						<option value="none"<?php if( dynamik_get_responsive( 'ez_media_query_default' ) == 'none' ) echo ' selected="selected"'; ?>><?php _e( 'None', 'dynamik' ); ?></option>
					</select>
					<a href="http://dynamikdocs.cobaltapps.com/article/51-responsive-ez-widget-area-media-query-styles" class="tooltip-mark" target="_blank">[?]</a>
				</p>
			</div>
			
			<div class="bg-box responsive-options-2col-right">
				<p>
					<?php _e( 'Footer Media Query Styles:', 'dynamik' ); ?> <select id="dynamik-footer-media-query-default" class="responsive-option" name="dynamik[footer_media_query_default]" size="1" style="width:80px;">
						<option value="default"<?php if( dynamik_get_responsive( 'footer_media_query_default' ) == 'default' ) echo ' selected="selected"'; ?>><?php _e( 'Default', 'dynamik' ); ?></option>
						<option value="none"<?php if( dynamik_get_responsive( 'footer_media_query_default' ) == 'none' ) echo ' selected="selected"'; ?>><?php _e( 'None', 'dynamik' ); ?></option>
					</select>
					<a href="http://dynamikdocs.cobaltapps.com/article/52-responsive-footer-media-query-styles" class="tooltip-mark" target="_blank">[?]</a>
				</p>
			</div>
			
			<div style="clear:both;"></div>

			<div class="bg-box dynamik-display-vertical-menu-options-box responsive-options-2col-left">
				<p>
					<?php _e( 'Vertical Menu Sub-Page "Pre-Text":', 'dynamik' ); ?>
					<input type="text" id="dynamik-vertical-menu-sub-page-pre-text" class="responsive-option" name="dynamik[vertical_menu_sub_page_pre_text]" value="<?php echo dynamik_get_responsive( 'vertical_menu_sub_page_pre_text' ) ?>" style="width:40px;" />
				</p>
			</div>

			<div class="bg-box dynamik-display-vertical-menu-options-box responsive-options-2col-right">
				<p>
					<?php _e( 'Vertical Menu Sub-Page Text-Align', 'dynamik' ); ?> <select id="dynamik-vertical-menu-sub-page-text-align" class="responsive-option" name="dynamik[vertical_menu_sub_page_text_align]" size="1" style="width:75px;">
						<option value="left"<?php if( dynamik_get_responsive( 'vertical_menu_sub_page_text_align' ) == 'left' ) echo ' selected="selected"'; ?>><?php _e( 'Left', 'dynamik' ); ?></option>
						<option value="center"<?php if( dynamik_get_responsive( 'vertical_menu_sub_page_text_align' ) == 'center' ) echo ' selected="selected"'; ?>><?php _e( 'Center', 'dynamik' ); ?></option>
					</select>
				</p>
			</div>

			<div style="clear:both;"></div>
			
			<div style="display:none;" id="dynamik-display-dropdown-menu-text-box">
			
				<div class="bg-box responsive-options-2col-left">
					<p>
						<?php _e( 'Toggle/Dropdown Menu 1 Text:', 'dynamik' ); ?>
						<input type="text" id="dynamik-dropdown-menu-1-text" class="responsive-option" name="dynamik[dropdown_menu_1_text]" value="<?php echo dynamik_get_responsive( 'dropdown_menu_1_text' ) ?>" style="width:170px;" />
						<a href="http://dynamikdocs.cobaltapps.com/article/53-responsive-toggle-dropdown-menu-text" class="tooltip-mark" target="_blank">[?]</a>
					</p>
				</div>
				
				<div class="bg-box responsive-options-2col-right">
					<p>
						<?php _e( 'Toggle/Dropdown Menu 2 Text:', 'dynamik' ); ?>
						<input type="text" id="dynamik-dropdown-menu-2-text" class="responsive-option" name="dynamik[dropdown_menu_2_text]" value="<?php echo dynamik_get_responsive( 'dropdown_menu_2_text' ) ?>" style="width:185px;" />
					</p>
				</div>

				<div class="bg-box dynamik-responsive-options-full-width">
					<p style="text-align:center;">
						<?php _e( '<strong>Are you using a Header Menu?</strong> Use Primary Menu as a mobile version of the Header Menu', 'dynamik' ); ?> <input type="checkbox" id="dynamik-primary-menu-as-mobile-header-menu" class="responsive-option" name="dynamik[primary_menu_as_mobile_header_menu]" value="1" <?php if( checked( 1, dynamik_get_responsive( 'primary_menu_as_mobile_header_menu' ) ) ); ?> />
						<a href="http://dynamikdocs.cobaltapps.com/article/221-using-the-primary-menu-as-the-mobile-header-menu" class="tooltip-mark" target="_blank">[?]</a>
					</p>
				</div>

				<div class="bg-box dynamik-display-hamburger-icon-margin-box dynamik-responsive-options-full-width" style="display:none;">
					<p style="text-align:center;">
						<?php _e( 'Be sure to assign your Tablet/Mobile Dropdown Menus a Custom Menu in', 'dynamik' ); ?>
						<a href="<?php echo admin_url( 'nav-menus.php' ) ?>?action=locations"><?php _e( 'Appearance > Menus > Theme Locations', 'dynamik' ); ?></a>
					</p>
				</div>

				<div class="bg-box dynamik-display-hamburger-icon-margin-box responsive-options-2col-left" style="display:none;">
					<p>
						<?php _e( 'Dropdown Menu 1 Hamburger Icon Margin Top:', 'dynamik' ); ?>
						<input type="text" id="dynamik-hamburger-icon-1-margin-top" class="responsive-option" name="dynamik[hamburger_icon_1_margin_top]" value="<?php echo dynamik_get_responsive( 'hamburger_icon_1_margin_top' ) ?>" style="width:40px;" /><code class="dynamik-px-unit">px</code>
						<a href="http://dynamikdocs.cobaltapps.com/article/55-responsive-dropdown-menu-hamburger-icon-margin-top" class="tooltip-mark" target="_blank">[?]</a>
					</p>
				</div>

				<div class="bg-box dynamik-display-hamburger-icon-margin-box responsive-options-2col-right" style="display:none;">
					<p>
						<?php _e( 'Dropdown Menu 2 Hamburger Icon Margin Top:', 'dynamik' ); ?>
						<input type="text" id="dynamik-hamburger-icon-2-margin-top" class="responsive-option" name="dynamik[hamburger_icon_2_margin_top]" value="<?php echo dynamik_get_responsive( 'hamburger_icon_2_margin_top' ) ?>" style="width:40px;" /><code class="dynamik-px-unit">px</code>
					</p>
				</div>
				
				<div style="clear:both;"></div>

				<div style="display:none;" id="dynamik-display-vertical-toggle-menu-styles-box">

					<div class="bg-box dynamik-responsive-options-full-width">
						<p style="text-align:center;">
							<?php _e( 'Reveal ALL pages (including sub-pages) upon clicking the Vertical Toggle menu', 'dynamik' ); ?> <input type="checkbox" id="dynamik-vertical-toggle-sub-page-reveal" class="responsive-option" name="dynamik[vertical_toggle_sub_page_reveal]" value="1" <?php if( checked( 1, dynamik_get_responsive( 'vertical_toggle_sub_page_reveal' ) ) ); ?> />
							<?php _e( '(leave unchecked for hover-dropdown effect)', 'dynamik' ); ?><br />
							<?php _e( '<strong>Please Note:</strong> If Dynamik Settings > General > "Fancy Dropdowns" are disabled then ALL pages will be revealed regardless of the above setting.', 'dynamik' ); ?>
						</p>
					</div>

					<div class="bg-box responsive-options-2col-left">
						<p>
							<?php _e( '(Primary Navigation) Vertical Toggle Menu Styles:', 'dynamik' ); ?>
							<a href="http://dynamikdocs.cobaltapps.com/article/54-responsive-navigation-vertical-toggle-menu-styles" class="tooltip-mark" target="_blank">[?]</a>
							<textarea id="dynamik-vertical-toggle-menu-1-styles" class="responsive-option dynamik-tabby-textarea" name="dynamik[vertical_toggle_button_styles]" style="width:100%; height:150px;"><?php if( dynamik_get_responsive( 'vertical_toggle_button_styles' ) ) echo dynamik_get_responsive( 'vertical_toggle_button_styles' ); ?></textarea>
						</p>
					</div>

					<div class="bg-box responsive-options-2col-right">
						<p>
							<?php _e( '(Secondary Navigation) Vertical Toggle Menu Styles:', 'dynamik' ); ?>
							<textarea id="dynamik-vertical-toggle-menu-2-styles" class="responsive-option dynamik-tabby-textarea" name="dynamik[vertical_toggle_button_subnav_styles]" style="width:100%; height:150px;"><?php if( dynamik_get_responsive( 'vertical_toggle_button_subnav_styles' ) ) echo dynamik_get_responsive( 'vertical_toggle_button_subnav_styles' ); ?></textarea>
						</p>
					</div>

				</div>
				
				<div style="clear:both;"></div>
			
			</div>
		</div>
	</div>
	
	<div class="dynamik-structure-settings-hide">
	
	<div id="responsive-nav">
		<div class="responsive-nav-group">
			<span id="query-1" class="responsive-icon responsive-icon-first responsive-hover-first"></span>
			<span id="query-2" class="responsive-icon"></span>
			<span id="query-3" class="responsive-icon"></span>
		</div>
		<div class="responsive-nav-group">
			<span id="query-4" class="responsive-icon responsive-icon-group-first"></span>
			<span id="query-5" class="responsive-icon"></span>
			<span id="query-6" class="responsive-icon"></span>
		</div>
	</div>
	
	<div id="query-1-box" class="query-box-all">
		<h3 class="dynamik-wide-option-heading"><?php _e( 'Tablet Landscape Cascading @media query <strong>(1st)</strong>', 'dynamik' ); ?> <a href="http://dynamikdocs.cobaltapps.com/article/42-responsive-custom-media-query-css-box-max-width-values" class="tooltip-mark" target="_blank">[?]</a></h3>
		<div class="dynamik-media-query-box">
			<div class="bg-box">
				<p>
					<strong><code>@media only screen and (max-width:</code><input type="text" id="dynamik-media-query-large-cascading-width" class="responsive-option" name="dynamik[media_query_large_cascading_width]" value="<?php echo dynamik_get_responsive( 'media_query_large_cascading_width' ); ?>" style="width:50px;" /><code>px) { }</code></strong>
					<textarea id="dynamik-media-query-large-cascading-content" class="responsive-option dynamik-tabby-textarea" name="dynamik[media_query_large_cascading_content]" style="width:100%; height:250px;"><?php if( dynamik_get_responsive( 'media_query_large_cascading_content' ) ) echo dynamik_get_responsive( 'media_query_large_cascading_content' ); ?></textarea><br />
				</p>
			</div>
		</div>
	</div>
	
	<div id="query-2-box" class="query-box-all">
		<h3 class="dynamik-wide-option-heading"><?php _e( 'Tablet Landscape Specific @media query <strong>(2nd)</strong>', 'dynamik' ); ?></h3>
		<div class="dynamik-media-query-box">
			<div class="bg-box">
				<p>
					<strong><code>@media only screen and (min-width:</code><input type="text" id="dynamik-media-query-large-min-width" class="responsive-option" name="dynamik[dynamik_media_query_large_min_width]" value="<?php echo dynamik_get_responsive( 'dynamik_media_query_large_min_width' ); ?>" style="width:50px;" /><code>px) and (max-width:</code><input type="text" id="dynamik-media-query-large-max-width" class="responsive-option" name="dynamik[dynamik_media_query_large_max_width]" value="<?php echo dynamik_get_responsive( 'dynamik_media_query_large_max_width' ); ?>" style="width:50px;" /><code>px) { }</code></strong><br />
					<textarea id="dynamik-media-query-large-content" class="responsive-option dynamik-tabby-textarea" name="dynamik[media_query_large_content]" style="width:100%; height:250px;"><?php echo dynamik_get_responsive( 'media_query_large_content' ); ?></textarea><br />
				</p>
			</div>
		</div>
	</div>
	
	<div id="query-3-box" class="query-box-all">
		<h3 class="dynamik-wide-option-heading"><?php _e( 'Tablet Portrait to Tablet Landscape Specific @media query <strong>(3rd)</strong>', 'dynamik' ); ?></h3>
		<div class="dynamik-media-query-box">
			<div class="bg-box">
				<p>
					<strong><code>@media only screen and (min-width:</code><input type="text" id="dynamik-media-query-medium-large-min-width" class="responsive-option" name="dynamik[dynamik_media_query_medium_large_min_width]" value="<?php echo dynamik_get_responsive( 'dynamik_media_query_medium_large_min_width' ); ?>" style="width:50px;" /><code>px) and (max-width:</code><input type="text" id="dynamik-media-query-medium-large-max-width" class="responsive-option" name="dynamik[dynamik_media_query_medium_large_max_width]" value="<?php echo dynamik_get_responsive( 'dynamik_media_query_medium_large_max_width' ); ?>" style="width:50px;" /><code>px) { }</code></strong><br />
					<textarea id="dynamik-media-query-medium-large-content" class="responsive-option dynamik-tabby-textarea" name="dynamik[media_query_medium_large_content]" style="width:100%; height:250px;"><?php echo dynamik_get_responsive( 'media_query_medium_large_content' ); ?></textarea><br />
				</p>
			</div>
		</div>
	</div>
	
	<div id="query-4-box" class="query-box-all">
		<h3 class="dynamik-wide-option-heading"><?php _e( 'Tablet Portrait Cascading @media query <strong>(4th)</strong>', 'dynamik' ); ?></h3>
		<div class="dynamik-media-query-box">
			<div class="bg-box">
				<p>
					<strong><code>@media only screen and (max-width:</code><input type="text" id="dynamik-media-query-medium-large-cascading-width" class="responsive-option" name="dynamik[media_query_medium_cascading_width]" value="<?php echo dynamik_get_responsive( 'media_query_medium_cascading_width' ); ?>" style="width:50px;" /><code>px) { }</code></strong>
					<textarea id="dynamik-media-query-medium-cascading-content" class="responsive-option dynamik-tabby-textarea" name="dynamik[media_query_medium_cascading_content]" style="width:100%; height:250px;"><?php if( dynamik_get_responsive( 'media_query_medium_cascading_content' ) ) echo dynamik_get_responsive( 'media_query_medium_cascading_content' ); ?></textarea><br />
				</p>
			</div>
		</div>
	</div>
	
	<div id="query-5-box" class="query-box-all">
		<h3 class="dynamik-wide-option-heading"><?php _e( 'Mobile Landscape to Tablet Portrait Specific @media query <strong>(5th)</strong>', 'dynamik' ); ?></h3>
		<div class="dynamik-media-query-box">
			<div class="bg-box">
				<p>
					<strong><code>@media only screen and (min-width:</code><input type="text" id="dynamik-media-query-medium-min-width" class="responsive-option" name="dynamik[dynamik_media_query_medium_min_width]" value="<?php echo dynamik_get_responsive( 'dynamik_media_query_medium_min_width' ); ?>" style="width:50px;" /><code>px) and (max-width:</code><input type="text" id="dynamik-media-query-medium-max-width" class="responsive-option" name="dynamik[dynamik_media_query_medium_max_width]" value="<?php echo dynamik_get_responsive( 'dynamik_media_query_medium_max_width' ); ?>" style="width:50px;" /><code>px) { }</code></strong><br />
					<textarea id="dynamik-media-query-medium-content" class="responsive-option dynamik-tabby-textarea" name="dynamik[media_query_medium_content]" style="width:100%; height:250px;"><?php echo dynamik_get_responsive( 'media_query_medium_content' ); ?></textarea><br />
				</p>
			</div>
		</div>
	</div>
	
	<div id="query-6-box" class="query-box-all">
		<h3 class="dynamik-wide-option-heading"><?php _e( 'Mobile Portrait Specific @media query <strong>(6th)</strong>', 'dynamik' ); ?></h3>
		<div class="dynamik-media-query-box">
			<div class="bg-box">
				<p>
					<strong><code>@media only screen and (max-width:</code><input type="text" id="dynamik-media-query-small-width" class="responsive-option" name="dynamik[media_query_small_width]" value="<?php echo dynamik_get_responsive( 'media_query_small_width' ); ?>" style="width:50px;" /><code>px) { }</code></strong>
					<textarea id="dynamik-media-query-small-content" class="responsive-option dynamik-tabby-textarea" name="dynamik[media_query_small_content]" style="width:100%; height:250px;"><?php echo dynamik_get_responsive( 'media_query_small_content' ); ?></textarea><br />
				</p>
			</div>
		</div>
	</div>
	
	</div><!-- End .dynamik-structure-settings-hide -->
	
	</form>
</div>