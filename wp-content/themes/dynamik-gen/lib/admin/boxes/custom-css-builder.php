<?php
/**
 * Builds the Custom CSS Builder admin content.
 *
 * @package Dynamik
 */
?>

<div style="display:none;" id="dynamik-custom-css-builder" class="dynamik-optionbox-outer-1col">
	<div class="dynamik-optionbox-inner-1col">
		<h3 style="width:805px; border-bottom:0;"><?php _e( 'Custom CSS Builder', 'coder' ); ?> <a href="http://dynamikdocs.cobaltapps.com/article/72-custom-css-builder" class="tooltip-mark" target="_blank">[?]</a></h3>

		<div id="dynamik-custom-css-builder-wrap">
		<form name="form">
			<div id="dynamik-custom-css-builder-wrap-inner" class="bg-box">
				<div id="dynamik-custom-css-builder-nav">
					<ul>
						<li id="custom-css-builder-nav-open-close-elements" class="dynamik-css-builder-nav-all"><a href="#">Elements</a></li><li id="custom-css-builder-nav-backgrounds" class="dynamik-css-builder-nav-all"><a href="#">Backgrounds</a></li><li id="custom-css-builder-nav-borders" class="dynamik-css-builder-nav-all"><a href="#">Borders</a></li><li id="custom-css-builder-nav-border-radius" class="dynamik-css-builder-nav-all"><a href="#">Border Radius</a></li><li id="custom-css-builder-nav-margins" class="dynamik-css-builder-nav-all"><a href="#">Margins</a></li><li id="custom-css-builder-nav-padding" class="dynamik-css-builder-nav-all"><a href="#">Padding</a></li><li id="custom-css-builder-nav-fonts" class="dynamik-css-builder-nav-all dynamik-options-nav-active"><a href="#">Fonts</a></li><li id="custom-css-builder-nav-width-float" class="dynamik-css-builder-nav-all"><a href="#">Width/Float</a></li><li id="custom-css-builder-nav-shadows" class="dynamik-css-builder-nav-all"><a href="#">Shadows</a></li><li id="custom-css-builder-nav-responsive" class="dynamik-css-builder-nav-all"><a class="dynamik-options-nav-last" href="#">Responsive</a></li>
					</ul>
				</div>
				
				<div id="custom-css-builder-nav-open-close-elements-box" class="dynamik-all-css-builder">
					<p style="float:left;">
						<span style="color:#444; font-size:13px; font-weight:bold; line-height:21px;"><?php _e( 'Select and Insert [&raquo;] Elements to be styled:', 'coder' ); ?><br /></span>
						<?php _e( 'Select Element Type', 'coder' ); ?><br />
						<select id="custom_css_elements" class="css-builder-elements-select" name="custom_css_elements" size="1">
						<?php dynamik_build_css_builder_elements_menu(); ?>
						</select><br />

						<span id="page_elements" class="css_builder_element_select">
						<?php _e( 'Page Elements', 'coder' ); ?><br />
						<select id="page_css_divs" class="css-builder-elements-select" name="page_css_divs" size="1">
						<?php dynamik_build_css_builder_select_menu( dynamik_page_elements_array() ); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons button" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.page_css_divs.value+'\n\n}\n')">
						</span>

						<span id="header_elements" class="css_builder_element_select" style="display:none;">
						<?php _e( 'Header Elements', 'coder' ); ?><br />
						<select id="header_css_divs" class="css-builder-elements-select" name="header_css_divs" size="1">
						<?php dynamik_build_css_builder_select_menu( dynamik_header_elements_array() ); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons button" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.header_css_divs.value+'\n\n}\n')">
						</span>

						<span id="header_menu_elements" class="css_builder_element_select" style="display:none;">
						<?php _e( 'Header Menu Elements', 'coder' ); ?><br />
						<select id="header_menu_css_divs" class="css-builder-elements-select" name="header_menu_css_divs" size="1">
						<?php dynamik_build_css_builder_select_menu( dynamik_header_menu_elements_array() ); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons button" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.header_menu_css_divs.value+'\n\n}\n')">
						</span>

						<span id="primary_menu_elements" class="css_builder_element_select" style="display:none;">
						<?php _e( 'Primary Menu Elements', 'coder' ); ?><br />
						<select id="primary_menu_css_divs" class="css-builder-elements-select" name="primary_menu_css_divs" size="1">
						<?php dynamik_build_css_builder_select_menu( dynamik_primary_menu_elements_array() ); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons button" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.primary_menu_css_divs.value+'\n\n}\n')">
						</span>

						<span id="secondary_menu_elements" class="css_builder_element_select" style="display:none;">
						<?php _e( 'Secondary Menu Elements', 'coder' ); ?><br />
						<select id="secondary_menu_css_divs" class="css-builder-elements-select" name="secondary_menu_css_divs" size="1">
						<?php dynamik_build_css_builder_select_menu( dynamik_secondary_menu_elements_array() ); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons button" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.secondary_menu_css_divs.value+'\n\n}\n')">
						</span>

						<span id="content_elements" class="css_builder_element_select" style="display:none;">
						<?php _e( 'Content Elements', 'coder' ); ?><br />
						<select id="content_css_divs" class="css-builder-elements-select" name="content_css_divs" size="1">
						<?php dynamik_build_css_builder_select_menu( dynamik_content_elements_array() ); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons button" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.content_css_divs.value+'\n\n}\n')">
						</span>

						<span id="breadcrumbs_elements" class="css_builder_element_select" style="display:none;">
						<?php _e( 'Breadcrumb Elements', 'coder' ); ?><br />
						<select id="breadcrumbs_css_divs" class="css-builder-elements-select" name="breadcrumbs_css_divs" size="1">
						<?php dynamik_build_css_builder_select_menu( dynamik_breadcrumb_elements_array() ); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons button" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.breadcrumbs_css_divs.value+'\n\n}\n')">
						</span>

						<span id="archive_description_elements" class="css_builder_element_select" style="display:none;">
						<?php _e( 'Archive Description Elements', 'coder' ); ?><br />
						<select id="archive_description_css_divs" class="css-builder-elements-select" name="archive_description_css_divs" size="1">
						<?php dynamik_build_css_builder_select_menu( dynamik_archive_description_elements_array() ); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons button" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.archive_description_css_divs.value+'\n\n}\n')">
						</span>

						<span id="author_box_elements" class="css_builder_element_select" style="display:none;">
						<?php _e( 'Author Box Elements', 'coder' ); ?><br />
						<select id="author_box_css_divs" class="css-builder-elements-select" name="author_box_css_divs" size="1">
						<?php dynamik_build_css_builder_select_menu( dynamik_author_box_elements_array() ); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons button" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.author_box_css_divs.value+'\n\n}\n')">
						</span>

						<span id="featured_content_elements" class="css_builder_element_select" style="display:none;">
						<?php _e( 'Featured Content Elements', 'coder' ); ?><br />
						<select id="featured_content_css_divs" class="css-builder-elements-select" name="featured_content_css_divs" size="1">
						<?php dynamik_build_css_builder_select_menu( dynamik_featured_content_elements_array() ); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons button" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.featured_content_css_divs.value+'\n\n}\n')">
						</span>

						<span id="sidebar_elements" class="css_builder_element_select" style="display:none;">
						<?php _e( 'Sidebar Elements', 'coder' ); ?><br />
						<select id="sidebar_css_divs" class="css-builder-elements-select" name="sidebar_css_divs" size="1">
						<?php dynamik_build_css_builder_select_menu( dynamik_sidebar_elements_array() ); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons button" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.sidebar_css_divs.value+'\n\n}\n')">
						</span>

						<span id="comment_elements" class="css_builder_element_select" style="display:none;">
						<?php _e( 'Comment Elements', 'coder' ); ?><br />
						<select id="comment_css_divs" class="css-builder-elements-select" name="comment_css_divs" size="1">
						<?php dynamik_build_css_builder_select_menu( dynamik_comment_elements_array() ); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons button" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.comment_css_divs.value+'\n\n}\n')">
						</span>
						
						<span id="comment_respond_elements" class="css_builder_element_select" style="display:none;">
						<?php _e( 'Comment Elements', 'coder' ); ?><br />
						<select id="comment_respond_css_divs" class="css-builder-elements-select" name="comment_respond_css_divs" size="1">
						<?php dynamik_build_css_builder_select_menu( dynamik_comment_respond_elements_array() ); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons button" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.comment_respond_css_divs.value+'\n\n}\n')">
						</span>
						
						<span id="ez_feature_top_elements" class="css_builder_element_select" style="display:none;">
						<?php _e( 'EZ Feature Top Elements', 'dynamik' ); ?><br />
						<select id="ez_feature_top_css_divs" class="css-builder-elements-select" name="ez_feature_top_css_divs" size="1">
						<?php dynamik_build_css_builder_select_menu( dynamik_ez_feature_top_elements_array() ); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons button" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.ez_feature_top_css_divs.value+'\n\n}\n')">
						</span>

						<span id="ez_fat_footer_elements" class="css_builder_element_select" style="display:none;">
						<?php _e( 'EZ Fat Footer Elements', 'dynamik' ); ?><br />
						<select id="ez_fat_footer_css_divs" class="css-builder-elements-select" name="ez_fat_footer_css_divs" size="1">
						<?php dynamik_build_css_builder_select_menu( dynamik_ez_fat_footer_elements_array() ); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons button" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.ez_fat_footer_css_divs.value+'\n\n}\n')">
						</span>

						<span id="ez_home_elements" class="css_builder_element_select" style="display:none;">
						<?php _e( 'EZ Home Elements', 'dynamik' ); ?><br />
						<select id="ez_home_css_divs" class="css-builder-elements-select" name="ez_home_css_divs" size="1">
						<?php dynamik_build_css_builder_select_menu( dynamik_ez_home_elements_array() ); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons button" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.ez_home_css_divs.value+'\n\n}\n')">
						</span>

						<span id="ez_home_sidebar_elements" class="css_builder_element_select" style="display:none;">
						<?php _e( 'EZ Home Sidebar Elements', 'dynamik' ); ?><br />
						<select id="ez_home_sidebar_css_divs" class="css-builder-elements-select" name="ez_home_sidebar_css_divs" size="1">
						<?php dynamik_build_css_builder_select_menu( dynamik_ez_home_sidebar_elements_array() ); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons button" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.ez_home_sidebar_css_divs.value+'\n\n}\n')">
						</span>

						<span id="ez_home_slider_elements" class="css_builder_element_select" style="display:none;">
						<?php _e( 'EZ Home Slider Elements', 'dynamik' ); ?><br />
						<select id="ez_home_slider_css_divs" class="css-builder-elements-select" name="ez_home_slider_css_divs" size="1">
						<?php dynamik_build_css_builder_select_menu( dynamik_ez_home_slider_elements_array() ); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons button" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.ez_home_slider_css_divs.value+'\n\n}\n')">
						</span>

						<span id="custom_widget_areas_elements" class="css_builder_element_select" style="display:none;">
						<?php _e( 'Custom Widget Areas Elements', 'dynamik' ); ?><br />
						<select id="custom_widget_areas_css_divs" class="css-builder-elements-select" name="custom_widget_areas_css_divs" size="1">
						<?php dynamik_build_css_builder_select_menu( dynamik_custom_widget_areas_elements_array() ); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons button" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.custom_widget_areas_css_divs.value+'\n\n}\n')">
						</span>

						<span id="genesis_footer_widget_elements" class="css_builder_element_select" style="display:none;">
						<?php _e( 'Genesis Footer Widgets Elements', 'coder' ); ?><br />
						<select id="genesis_footer_widgets_css_divs" class="css-builder-elements-select" name="genesis_footer_widgets_css_divs" size="1">
						<?php dynamik_build_css_builder_select_menu( dynamik_genesis_footer_widget_elements_array() ); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons button" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.genesis_footer_widgets_css_divs.value+'\n\n}\n')">
						</span>

						<span id="footer_elements" class="css_builder_element_select" style="display:none;">
						<?php _e( 'Footer Elements', 'coder' ); ?><br />
						<select id="footer_css_divs" class="css-builder-elements-select" name="footer_css_divs" size="1">
						<?php dynamik_build_css_builder_select_menu( dynamik_footer_elements_array() ); ?>
						</select>
						<input class="custom-css-builder-button-elements custom-css-builder-buttons button" type="button" value="&raquo;" onclick="insertAtCaret(this.form.text, this.form.footer_css_divs.value+'\n\n}\n')">
						</span>
					</p>
				</div>
				
				<div id="custom-css-builder-nav-backgrounds-box" class="dynamik-all-css-builder">
					<div class="custom-css-builder-options-box-wrap">
						<div class="custom-css-builder-options-box">
							<input class="custom-css-builder-button-bgs custom-css-builder-buttons button" type="button" value="Insert Background Color" style="width:175px;margin:0 5px 0 0 !important;float:left;" onclick="insertAtCaret(this.form.text, '\tbackground: #'+this.form.background_color2.value+';\n')">
							<input type="text" class="color {pickerFaceColor:'#FFFFFF'}" id="background_color2" name="background_color2" value="" style="width:90px;" />
						</div>
						<div class="custom-css-builder-options-box">
							<input class="custom-css-builder-button-bgs custom-css-builder-buttons button" type="button" value="Insert Transparent Background CSS" style="width:100%;margin:10px;" onclick="insertAtCaret(this.form.text, '\tbackground: transparent;\n')"><br />
						</div>
					</div>
				</div>
				
				<div id="custom-css-builder-nav-borders-box" class="dynamik-all-css-builder">
					<div class="custom-css-builder-options-box-wrap">
						<div class="custom-css-builder-options-box">
							<?php _e( 'Type', 'coder' ); ?>
							<select id="border_type" name="border_type" size="1" style="width:100px;margin-bottom:10px;">
								<option value="border"><?php _e( 'Full', 'coder' ); ?></option>
								<option value="border-top"><?php _e( 'Top', 'coder' ); ?></option>
								<option value="border-bottom"><?php _e( 'Bottom', 'coder' ); ?></option>
								<option value="border-left"><?php _e( 'Left', 'coder' ); ?></option>
								<option value="border-right"><?php _e( 'Right', 'coder' ); ?></option>
							</select>
							<?php _e( 'Thickness', 'coder' ); ?>
							<input type="text" id="border_thickness" name="border_thickness" value="0" style="width:35px;" /><?php _e( 'px', 'coder' ); ?><br />
							<?php _e( 'Style', 'coder' ); ?>
							<select id="border_style" name="border_style" size="1" style="width:100px;">
								<?php dynamik_list_borders(); ?>
							</select>
							<?php _e( 'Color', 'coder' ); ?>
							<input type="text" class="color {pickerFaceColor:'#FFFFFF'}" style="width:70px;" id="border_color" name="border_color" value="" /><br />
							<input class="custom-css-builder-button-bgs custom-css-builder-buttons button" type="button" value="Insert Border CSS" onclick="insertAtCaret(this.form.text, '\t'+this.form.border_type.value+': '+this.form.border_thickness.value+'px '+this.form.border_style.value+' #'+this.form.border_color.value+';\n')"><br />
						</div>
						<div class="custom-css-builder-options-box">
							<input class="custom-css-builder-button-bgs custom-css-builder-buttons button" style="margin-top:0 !important;" type="button" value="Insert Border Zero CSS" onclick="insertAtCaret(this.form.text, '\tborder: 0;\n')"><br />
						</div>
					</div>
				</div>
				
				<div id="custom-css-builder-nav-border-radius-box" class="dynamik-all-css-builder">
					<div class="custom-css-builder-options-box-wrap">
						<div class="custom-css-builder-options-box">
							<?php _e( 'Tp-Lft', 'coder' ); ?>
							<input type="text" id="border_radius_top" name="border_radius_top" value="0" style="width:24px;" />
							<?php _e( 'Tp-Rt', 'coder' ); ?>
							<input type="text" id="border_radius_right" name="border_radius_right" value="0" style="width:24px;" />
							<?php _e( 'Btm-Rt', 'coder' ); ?>
							<input type="text" id="border_radius_bottom" name="border_radius_bottom" value="0" style="width:24px;" />
							<?php _e( 'Btm-Lft', 'coder' ); ?>
							<input type="text" id="border_radius_left" name="border_radius_left" value="0" style="width:24px;" /><br />
							<input class="custom-css-builder-button-bgs custom-css-builder-buttons button" type="button" value="Insert Border Radius CSS" onclick="insertAtCaret(this.form.text, '\t-webkit-border-radius: '+this.form.border_radius_top.value+'px '+this.form.border_radius_right.value+'px '+this.form.border_radius_bottom.value+'px '+this.form.border_radius_left.value+'px;\n\tborder-radius: '+this.form.border_radius_top.value+'px '+this.form.border_radius_right.value+'px '+this.form.border_radius_bottom.value+'px '+this.form.border_radius_left.value+'px;\n')">
						</div>
						<div class="custom-css-builder-options-box">
							<?php _e( 'Full', 'coder' ); ?>
							<input type="text" id="border_radius_full" name="border_radius_full" value="0" style="width:24px;" /><br />
							<input class="custom-css-builder-button-bgs custom-css-builder-buttons button" type="button" value="Insert Full Border Radius CSS" onclick="insertAtCaret(this.form.text, '\t-webkit-border-radius: '+this.form.border_radius_full.value+'px;\n\tborder-radius: '+this.form.border_radius_full.value+'px;\n')">
						</div>
					</div>
				</div>
				
				<div id="custom-css-builder-nav-margins-box" class="dynamik-all-css-builder">
					<div class="custom-css-builder-options-box-wrap">
						<div class="custom-css-builder-options-box">
							<?php _e( 'Top', 'coder' ); ?>
							<input type="text" id="margin_top" name="margin_top" value="0" style="width:25px;margin-right:5px;" />
							<?php _e( 'Right', 'coder' ); ?>
							<input type="text" id="margin_right" name="margin_right" value="0" style="width:25px;margin-right:5px;" />
							<?php _e( 'Bottom', 'coder' ); ?>
							<input type="text" id="margin_bottom" name="margin_bottom" value="0" style="width:25px;margin-right:5px;" />
							<?php _e( 'Left', 'coder' ); ?>
							<input type="text" id="margin_left" name="margin_left" value="0" style="width:25px;" /><br />
							<input class="custom-css-builder-button-bgs custom-css-builder-buttons button" type="button" value="Insert Margin CSS" onclick="insertAtCaret(this.form.text, '\tmargin: '+this.form.margin_top.value+'px '+this.form.margin_right.value+'px '+this.form.margin_bottom.value+'px '+this.form.margin_left.value+'px;\n')"><br />
						</div>
						<div class="custom-css-builder-options-box">
							<?php _e( 'Top/Bottom', 'coder' ); ?>
							<input type="text" id="margin_top_bottom" name="margin_top_bottom" value="0" style="width:25px;margin-right:5px;" />
							<?php _e( 'Left/Right', 'coder' ); ?>
							<input type="text" id="margin_left_right" name="margin_left_right" value="0" style="width:25px;margin-right:5px;" /><br />
							<input class="custom-css-builder-button-bgs custom-css-builder-buttons button" type="button" value="Insert Top/Bottom Margin CSS" onclick="insertAtCaret(this.form.text, '\tmargin: '+this.form.margin_top_bottom.value+'px '+this.form.margin_left_right.value+'px;\n')"><br />
						</div>
						<div class="custom-css-builder-options-box">
							<?php _e( 'Full', 'coder' ); ?>
							<input type="text" id="margin_full" name="margin_full" value="0" style="width:25px;margin-right:5px;" /><br />
							<input class="custom-css-builder-button-bgs custom-css-builder-buttons button" type="button" value="Insert Full Margin CSS" onclick="insertAtCaret(this.form.text, '\tmargin: '+this.form.margin_full.value+'px;\n')"><br />
						</div>
					</div>
				</div>
				
				<div id="custom-css-builder-nav-padding-box" class="dynamik-all-css-builder">
					<div class="custom-css-builder-options-box-wrap">
						<div class="custom-css-builder-options-box">
							<?php _e( 'Top', 'coder' ); ?>
							<input type="text" id="padding_top" name="padding_top" value="0" style="width:25px;margin-right:5px;" />
							<?php _e( 'Right', 'coder' ); ?>
							<input type="text" id="padding_right" name="padding_right" value="0" style="width:25px;margin-right:5px;" />
							<?php _e( 'Bottom', 'coder' ); ?>
							<input type="text" id="padding_bottom" name="padding_bottom" value="0" style="width:25px;margin-right:5px;" />
							<?php _e( 'Left', 'coder' ); ?>
							<input type="text" id="padding_left" name="padding_left" value="0" style="width:25px;" /><br />
							<input class="custom-css-builder-button-bgs custom-css-builder-buttons button" type="button" value="Insert Padding CSS" onclick="insertAtCaret(this.form.text, '\tpadding: '+this.form.padding_top.value+'px '+this.form.padding_right.value+'px '+this.form.padding_bottom.value+'px '+this.form.padding_left.value+'px;\n')">
						</div>
						<div class="custom-css-builder-options-box">
							<?php _e( 'Top/Bottom', 'coder' ); ?>
							<input type="text" id="padding_top_bottom" name="padding_top_bottom" value="0" style="width:25px;margin-right:5px;" />
							<?php _e( 'Left/Right', 'coder' ); ?>
							<input type="text" id="padding_left_right" name="padding_left_right" value="0" style="width:25px;margin-right:5px;" /><br />
							<input class="custom-css-builder-button-bgs custom-css-builder-buttons button" type="button" value="Insert Top/Bottom Padding CSS" onclick="insertAtCaret(this.form.text, '\tpadding: '+this.form.padding_top_bottom.value+'px '+this.form.padding_left_right.value+'px;\n')"><br />
						</div>
						<div class="custom-css-builder-options-box">
							<?php _e( 'Full', 'coder' ); ?>
							<input type="text" id="padding_full" name="padding_full" value="0" style="width:25px;margin-right:5px;" /><br />
							<input class="custom-css-builder-button-bgs custom-css-builder-buttons button" type="button" value="Insert Full Padding CSS" onclick="insertAtCaret(this.form.text, '\tpadding: '+this.form.padding_full.value+'px;\n')"><br />
						</div>
					</div>
				</div>

				<div id="custom-css-builder-nav-fonts-box" class="dynamik-all-css-builder dynamik-options-display">
					<p style="float:left;">
						<input id="font-type-button" class="custom-css-builder-button custom-css-builder-buttons button" type="button" value="Insert Font Type" onclick="insertAtCaret(this.form.text, '\tfont-family: '+this.form.font_type.value+';\n')">
						<select id="font_type" name="font_type" size="1" style="width:150px;">
							<?php dynamik_build_font_menu( 'font_type', true ); ?>
						</select><br />
						<input class="custom-css-builder-button custom-css-builder-buttons button" type="button" value="Insert Font Size" onclick="insertAtCaret(this.form.text, '\tfont-size: '+this.form.font_size.value+'px;\n')">
						<input type="text" id="font_size" name="font_size" value="12" style="width:35px;" /><code class="dynamik-px-unit">px</code><br />
						<input class="custom-css-builder-button custom-css-builder-buttons button" type="button" value="Insert Font Color" onclick="insertAtCaret(this.form.text, '\tcolor: #'+this.form.font_color.value+';\n')">
						<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box-150" id="font_color" name="font_color" value="" /><br />
						<input class="custom-css-builder-button custom-css-builder-buttons button" type="button" value="Insert Font Weight" onclick="insertAtCaret(this.form.text, '\tfont-weight: '+this.form.font_weight.value+';\n')">
						<select id="font_weight" name="font_weight" size="1" class="iewide" style="width:150px;">
							<option value="normal"><?php _e( 'Normal', 'coder' ); ?></option>
							<option value="bold"><?php _e( 'Bold', 'coder' ); ?></option>
							<option value="100"><?php _e( '100', 'coder' ); ?></option>
							<option value="200"><?php _e( '200', 'coder' ); ?></option>
							<option value="300"><?php _e( '300', 'coder' ); ?></option>
							<option value="400"><?php _e( '400', 'coder' ); ?></option>
							<option value="500"><?php _e( '500', 'coder' ); ?></option>
							<option value="600"><?php _e( '600', 'coder' ); ?></option>
							<option value="700"><?php _e( '700', 'coder' ); ?></option>
							<option value="800"><?php _e( '800', 'coder' ); ?></option>
							<option value="900"><?php _e( '900', 'coder' ); ?></option>
						</select><br />
						<input class="custom-css-builder-button custom-css-builder-buttons button" type="button" value="Insert Font Style" onclick="insertAtCaret(this.form.text, '\tfont-style: '+this.form.font_style.value+';\n')">
						<select id="font_style" name="font_style" size="1" class="iewide" style="width:150px;">
							<option value="normal"><?php _e( 'Normal', 'coder' ); ?></option>
							<option value="italic"><?php _e( 'Italic', 'coder' ); ?></option>
						</select><br />
						<input class="custom-css-builder-button custom-css-builder-buttons button" type="button" value="Insert Text Align" onclick="insertAtCaret(this.form.text, '\ttext-align: '+this.form.text_align.value+';\n')">
						<select id="text_align" name="text_align" size="1" class="iewide" style="width:150px;">
							<option value="left"><?php _e( 'Left', 'coder' ); ?></option>
							<option value="center"><?php _e( 'Center', 'coder' ); ?></option>
							<option value="right"><?php _e( 'Right', 'coder' ); ?></option>
							<option value="justify"><?php _e( 'Justify', 'coder' ); ?></option>
						</select><br />
						<input class="custom-css-builder-button custom-css-builder-buttons button" type="button" value="Insert Transform" onclick="insertAtCaret(this.form.text, '\ttext-transform: '+this.form.font_caps.value+';\n')">
						<select id="font_caps" name="font_caps" size="1" class="iewide" style="width:150px;">
							<option value="none"><?php _e( 'None', 'coder' ); ?></option>
							<option value="uppercase"><?php _e( 'Uppercase', 'coder' ); ?></option>
							<option value="lowercase"><?php _e( 'Lowercase', 'coder' ); ?></option>
							<option value="capitalize"><?php _e( 'Capitalize', 'coder' ); ?></option>
						</select><br />
						<input class="custom-css-builder-button custom-css-builder-buttons button" type="button" value="Insert Letter Spacing" onclick="insertAtCaret(this.form.text, '\tletter-spacing: '+this.form.letter_spacing.value+';\n')">
						<select id="letter_spacing" name="letter_spacing" size="1" class="iewide" style="width:150px;">
							<option value=".5px"><?php _e( '.5px', 'coder' ); ?></option>
							<option value="1px"><?php _e( '1px', 'coder' ); ?></option>
							<option value="1.5px"><?php _e( '1.5px', 'coder' ); ?></option>
							<option value="2px"><?php _e( '2px', 'coder' ); ?></option>
							<option value="2.5px"><?php _e( '2.5px', 'coder' ); ?></option>
							<option value="3px"><?php _e( '3px', 'coder' ); ?></option>
							<option value="3.5px"><?php _e( '3.5px', 'coder' ); ?></option>
							<option value="4px"><?php _e( '4px', 'coder' ); ?></option>
						</select><br />
						<input class="custom-css-builder-button custom-css-builder-buttons button" type="button" value="Insert Line Height" onclick="insertAtCaret(this.form.text, '\tline-height: '+this.form.line_height.value+';\n')">
						<select id="line_height" name="line_height" size="1" class="iewide" style="width:150px;">
							<option value="100%"><?php _e( '100%', 'coder' ); ?></option>
							<option value="110%"><?php _e( '110%', 'coder' ); ?></option>
							<option value="120%"><?php _e( '120%', 'coder' ); ?></option>
							<option value="130%"><?php _e( '130%', 'coder' ); ?></option>
							<option value="140%"><?php _e( '140%', 'coder' ); ?></option>
							<option value="150%"><?php _e( '150%', 'coder' ); ?></option>
							<option value="160%"><?php _e( '160%', 'coder' ); ?></option>
							<option value="170%"><?php _e( '170%', 'coder' ); ?></option>
							<option value="180%"><?php _e( '180%', 'coder' ); ?></option>
							<option value="190%"><?php _e( '190%', 'coder' ); ?></option>
							<option value="200%"><?php _e( '200%', 'coder' ); ?></option>
						</select><br />
						<input class="custom-css-builder-button custom-css-builder-buttons button" type="button" value="Insert Txt Decoration" onclick="insertAtCaret(this.form.text, '\ttext-decoration: '+this.form.text_decoration.value+';\n')">
						<select id="text_decoration" name="text_decoration" size="1" class="iewide" style="width:150px;">
							<option value="none"><?php _e( 'none', 'coder' ); ?></option>
							<option value="underline"><?php _e( 'underline', 'coder' ); ?></option>
							<option value="overline"><?php _e( 'overline', 'coder' ); ?></option>
							<option value="line-through"><?php _e( 'line-through', 'coder' ); ?></option>
							<option value="blink"><?php _e( 'blink', 'coder' ); ?></option>
							<option value="inherit"><?php _e( 'inherit', 'coder' ); ?></option>
						</select><br />
					</p>
				</div>

				<div id="custom-css-builder-nav-width-float-box" class="dynamik-all-css-builder">
					<p style="float:left;">		
						<input class="custom-css-builder-button custom-css-builder-buttons button" type="button" value="Insert px Width CSS" onclick="insertAtCaret(this.form.text, '\twidth: '+this.form.width_px.value+'px;\n')">
						<input type="text" id="width_px" name="width_px" value="" style="width:40px;" /><code class="dynamik-px-unit">px</code><br />
						<input class="custom-css-builder-button custom-css-builder-buttons button" type="button" value="Insert % Width CSS" onclick="insertAtCaret(this.form.text, '\twidth: '+this.form.width_percent.value+'%;\n')">
						<input type="text" id="width_percent" name="width_percent" value="" style="width:40px;" /><code class="dynamik-px-unit">%</code><br />
						<input class="custom-css-builder-button custom-css-builder-buttons button" type="button" value="px Max Width CSS" onclick="insertAtCaret(this.form.text, '\tmax-width: '+this.form.max_width_px.value+'px;\n')">
						<input type="text" id="max_width_px" name="max_width_px" value="" style="width:40px;" /><code class="dynamik-px-unit">px</code><br />
						<input class="custom-css-builder-button custom-css-builder-buttons button" type="button" value="% Max Width CSS" onclick="insertAtCaret(this.form.text, '\tmax-width: '+this.form.max_width_percent.value+'%;\n')">
						<input type="text" id="max_width_percent" name="max_width_percent" value="" style="width:40px;" /><code class="dynamik-px-unit">%</code><br />
						<input class="custom-css-builder-button custom-css-builder-buttons button" type="button" value="Insert Height CSS" onclick="insertAtCaret(this.form.text, '\theight: '+this.form.height.value+'px;\n')">
						<input type="text" id="height" name="height" value="" style="width:40px;" /><code class="dynamik-px-unit">px</code><br />
						<input class="custom-css-builder-button custom-css-builder-buttons button" type="button" value="Insert Float CSS" onclick="insertAtCaret(this.form.text, '\tfloat: '+this.form.float_direction.value+';\n')">
						<select id="float_direction" name="float_direction" size="1" class="iewide" style="width:110px;">
							<option value="none"><?php _e( 'None', 'coder' ); ?></option>
							<option value="left"><?php _e( 'Left', 'coder' ); ?></option>
							<option value="right"><?php _e( 'Right', 'coder' ); ?></option>
						</select><br />
						<input class="custom-css-builder-button custom-css-builder-buttons button" type="button" value="Insert Position" onclick="insertAtCaret(this.form.text, '\tposition: '+this.form.position.value+';\n')">
						<select id="position" name="position" size="1" class="iewide" style="width:150px;">
							<option value="absolute"><?php _e( 'absolute', 'coder' ); ?></option>
							<option value="fixed"><?php _e( 'fixed', 'coder' ); ?></option>
							<option value="relative"><?php _e( 'relative', 'coder' ); ?></option>
							<option value="static"><?php _e( 'static', 'coder' ); ?></option>
							<option value="inherit"><?php _e( 'inherit', 'coder' ); ?></option>
						</select><br />
						<input class="custom-css-builder-button custom-css-builder-buttons button" type="button" value="Insert Display" onclick="insertAtCaret(this.form.text, '\tdisplay: '+this.form.display.value+';\n')">
						<select id="display" name="display" size="1" class="iewide" style="width:150px;">
							<option value="none"><?php _e( 'none', 'coder' ); ?></option>
							<option value="block"><?php _e( 'block', 'coder' ); ?></option>
							<option value="inline"><?php _e( 'inline', 'coder' ); ?></option>
							<option value="inline-block"><?php _e( 'inline-block', 'coder' ); ?></option>
							<option value="inline-table"><?php _e( 'inline-table', 'coder' ); ?></option>
							<option value="list-item"><?php _e( 'list-item', 'coder' ); ?></option>
							<option value="run-in"><?php _e( 'run-in', 'coder' ); ?></option>
							<option value="table"><?php _e( 'table', 'coder' ); ?></option>
							<option value="table-caption"><?php _e( 'table-caption', 'coder' ); ?></option>
							<option value="table-cell"><?php _e( 'table-cell', 'coder' ); ?></option>
							<option value="table-column"><?php _e( 'table-column', 'coder' ); ?></option>
							<option value="table-column-group"><?php _e( 'table-column-group', 'coder' ); ?></option>
							<option value="table-footer-group"><?php _e( 'table-footer-group', 'coder' ); ?></option>
							<option value="table-header-group"><?php _e( 'table-header-group', 'coder' ); ?></option>
							<option value="table-row"><?php _e( 'table-row', 'coder' ); ?></option>
							<option value="table-row-group"><?php _e( 'table-row-group', 'coder' ); ?></option>
							<option value="inherit"><?php _e( 'inherit', 'coder' ); ?></option>
						</select>
					</p>
				</div>
				
				<div id="custom-css-builder-nav-shadows-box" class="dynamik-all-css-builder">
					<div class="custom-css-builder-options-box-wrap">
						<div class="custom-css-builder-options-box">
							<?php _e( 'Lft-Rt', 'coder' ); ?>
							<input type="text" id="box_shadow_lr" name="box_shadow_lr" value="0" style="width:40px;" />
							<?php _e( 'Tp-Btm', 'coder' ); ?>
							<input type="text" id="box_shadow_tb" name="box_shadow_tb" value="0" style="width:40px;" /><br />
							<?php _e( 'Blur', 'coder' ); ?>
							<input type="text" id="box_shadow_blur" name="box_shadow_blur" value="0" style="width:30px;" />
							<?php _e( 'Spread', 'coder' ); ?>
							<input type="text" id="box_shadow_spread" name="box_shadow_spread" value="0" style="width:30px; margin-bottom:10px;" />
							<?php _e( 'Color', 'coder' ); ?>
							<input type="text" class="color {pickerFaceColor:'#FFFFFF'}" style="width:70px;" id="box_shadow_color" name="box_shadow_color" value="" style="margin-bottom:10px;"/><br />
							<input class="custom-css-builder-button-bgs custom-css-builder-buttons button" type="button" value="Insert Box Shadow CSS (in pixels)" style="width:270px;" onclick="insertAtCaret(this.form.text, '\t-webkit-box-shadow: '+this.form.box_shadow_lr.value+'px '+this.form.box_shadow_tb.value+'px '+this.form.box_shadow_blur.value+'px '+this.form.box_shadow_spread.value+'px #'+this.form.box_shadow_color.value+';\n\tbox-shadow: '+this.form.box_shadow_lr.value+'px '+this.form.box_shadow_tb.value+'px '+this.form.box_shadow_blur.value+'px '+this.form.box_shadow_spread.value+'px #'+this.form.box_shadow_color.value+';\n')"><br />
						</div>
						<div class="custom-css-builder-options-box">							
							<?php _e( 'Lft-Rt', 'coder' ); ?>
							<input type="text" id="text_shadow_lr" name="text_shadow_lr" value="0" style="width:40px;" />
							<?php _e( 'Tp-Btm', 'coder' ); ?>
							<input type="text" id="text_shadow_tb" name="text_shadow_tb" value="0" style="width:40px;" /><br />
							<?php _e( 'Blur', 'coder' ); ?>
							<input type="text" id="text_shadow_blur" name="text_shadow_blur" value="0" style="width:30px; margin-bottom:10px;" />
							<?php _e( 'Color', 'coder' ); ?>
							<input type="text" class="color {pickerFaceColor:'#FFFFFF'}" style="width:70px;" id="text_shadow_color" name="text_shadow_color" value="" style="margin-bottom:10px;"/><br />
							<input class="custom-css-builder-button-bgs custom-css-builder-buttons button" type="button" value="Insert Text Shadow CSS (in pixels)" style="width:270px;" onclick="insertAtCaret(this.form.text, '\ttext-shadow: '+this.form.text_shadow_lr.value+'px '+this.form.text_shadow_tb.value+'px '+this.form.text_shadow_blur.value+'px #'+this.form.text_shadow_color.value+';\n')">
						</div>
					</div>
				</div>
				
				<div id="custom-css-builder-nav-responsive-box" class="dynamik-all-css-builder">
					<div class="custom-css-builder-options-box-wrap">
						<div class="custom-css-builder-options-box">
							(<?php _e( 'min-width', 'coder' ); ?>
							<input type="text" id="min_width" name="min_width" value="0" style="width:50px;" />px)
							(<?php _e( 'max-width', 'coder' ); ?>
							<input type="text" id="max_width" name="max_width" value="0" style="width:50px;" />px)<br />
							<input class="custom-css-builder-button-bgs custom-css-builder-buttons button" type="button" value="Insert min/max-width CSS" onclick="insertAtCaret(this.form.text, '@media only screen and (min-width: '+this.form.min_width.value+'px) and (max-width: '+this.form.max_width.value+'px) {\n\n}')">
						</div>
						<div class="custom-css-builder-options-box">
							(<?php _e( 'min-width', 'coder' ); ?>
							<input type="text" id="min_width_only" name="min_width_only" value="0" style="width:50px;" />px)<br />
							<input class="custom-css-builder-button-bgs custom-css-builder-buttons button" type="button" value="Insert min-width CSS" onclick="insertAtCaret(this.form.text, '@media only screen and (min-width: '+this.form.min_width_only.value+'px) {\n\n}')">
						</div>
						<div class="custom-css-builder-options-box">
							(<?php _e( 'max-width', 'coder' ); ?>
							<input type="text" id="max_width_only" name="max_width_only" value="0" style="width:50px;" />px)<br />
							<input class="custom-css-builder-button-bgs custom-css-builder-buttons button" type="button" value="Insert max-width CSS" onclick="insertAtCaret(this.form.text, '@media only screen and (max-width: '+this.form.max_width_only.value+'px) {\n\n}')">
						</div>
					</div>
				</div>

				<div id="css-builder-output-wrap">
					<textarea wrap="off" id="css-builder-output" class="dynamik-tabby-textarea code-builder-output" name="text"></textarea>
				</div>
			</div>
		</form>
		<button id="css-builder-output-cut-button" class="code-builder-output-cut" data-clipboard-action="cut" data-clipboard-target="#css-builder-output">Copy To Clipboard</button>
		<button style="display:none;" id="css-builder-output-copied-button" class="code-builder-output-cut">Copied!</button>
		</div>
	</div>
</div>