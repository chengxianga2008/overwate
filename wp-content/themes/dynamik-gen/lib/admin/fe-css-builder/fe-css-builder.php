<?php
/**
 * Builds the Dynamik FE CSS Builder.
 *
 * @package Dynamik
 */

add_action( 'dynamik_fe_style_editor_form', 'dynamik_fe_css_builder_build_form' );	
/**
 * Build and add_action the FE CSS Editor form.
 *
 * @since 2.0
 */
function dynamik_fe_css_builder_build_form() {
	
?>
	<div id="dynamik-fe-css-builder-container" style="display:none;">
		
		<div id="dynamik-fe-css-builder-nav">
			<ul>
				<li id="dynamik-fe-css-builder-nav-open-close-elements" class="dynamik-fe-css-builder-css-builder-nav-all dynamik-fe-css-builder-options-nav-active"><a>Elements</a></li>
				<li id="dynamik-fe-css-builder-nav-backgrounds" class="dynamik-fe-css-builder-css-builder-nav-all"><a>Backgrounds</a></li>
				<li id="dynamik-fe-css-builder-nav-borders" class="dynamik-fe-css-builder-css-builder-nav-all"><a>Borders</a></li>
				<li id="dynamik-fe-css-builder-nav-border-radius" class="dynamik-fe-css-builder-css-builder-nav-all"><a>Border Radius</a></li>
				<li id="dynamik-fe-css-builder-nav-margins" class="dynamik-fe-css-builder-css-builder-nav-all"><a>Margins</a></li>
				<li id="dynamik-fe-css-builder-nav-padding" class="dynamik-fe-css-builder-css-builder-nav-all"><a>Padding</a></li>
				<li id="dynamik-fe-css-builder-nav-fonts" class="dynamik-fe-css-builder-css-builder-nav-all"><a>Fonts</a></li>
				<li id="dynamik-fe-css-builder-nav-width-float" class="dynamik-fe-css-builder-css-builder-nav-all"><a>Width/Float</a></li>
				<li id="dynamik-fe-css-builder-nav-shadows" class="dynamik-fe-css-builder-css-builder-nav-all"><a class="dynamik-fe-css-builder-options-nav-last">Shadows</a></li>
				<span id="dynamik-fe-css-builder-element-selectors-icon" class="dynamik-fe-css-builder-icons dashicons dashicons-screenoptions"></span>
				<span id="dynamik-fe-css-builder-style-editor-toggle-icon" class="dynamik-fe-css-builder-icons dashicons dashicons-editor-code"></span>
			</ul>
		</div>
		
		<div id="dynamik-fe-css-builder-col-container">
			
			<form id="dynamik-fe-css-builder-form" name="dynamik-fe-css-builder-form">
			
				<div class="dynamik-fe-css-builder-col dynamik-fe-css-builder-col-left">
					
					<div id="dynamik-fe-css-builder-nav-open-close-elements-box" class="dynamik-fe-css-builder-all-css-builder dynamik-fe-css-builder-options-display">
						<p style="padding-top:5px; float:left;">
							
							<?php dynamik_fe_css_builder_display_labeled_elements(); ?>
							
							<p class="dynamik-fe-css-builder-info"><?php _e( 'Click ', 'dynamik' ); ?><span class="dashicons dashicons-screenoptions"></span><?php _e( ' to enable the element selector labels, then select and insert elements to be styled.', 'dynamik' ); ?></p>
							<p class="dynamik-fe-css-builder-info"><?php _e( 'Learn:', 'dynamik' ); ?> <a href="https://vimeo.com/200436020" target="_blank"><?php _e( 'How To Use The FE CSS Builder', 'dynamik' ); ?></a></p>
							<p class="dynamik-fe-css-builder-info"><?php _e( 'CSS Links: ', 'dynamik' ); ?><a href="http://www.w3schools.com/css/css_intro.asp" target="_blank"><?php _e( 'Intro', 'dynamik' ); ?></a> | <a href="http://www.w3schools.com/css/" target="_blank"><?php _e( 'Turorials', 'dynamik' ); ?></a> | <a href="http://www.w3schools.com/cssref/" target="_blank"><?php _e( 'References', 'dynamik' ); ?></a></p>
						</p>
					</div>
					
					<div id="dynamik-fe-css-builder-nav-backgrounds-box" class="dynamik-fe-css-builder-all-css-builder">
						<p style="float:left;">
							<div class="dynamik-fe-css-builder-options-box">
								<input class="dynamik-fe-css-builder-button-bgs dynamik-fe-css-builder-buttons" type="button" value="Insert Background Color" style="width:160px;margin:0 5px 10px 0 !important;float:left;" onclick="insertAtCaret(this.form.text, '\tbackground: #'+this.form.background_color.value+';\n')">
								<input type="text" class="color {pickerFaceColor:'#FFFFFF'}" id="background_color" name="background_color" value="" style="width:90px;" /><br />
							</div>
							<div class="dynamik-fe-css-builder-options-box">
								<input class="dynamik-fe-css-builder-button-bgs dynamik-fe-css-builder-buttons" type="button" value="Insert Transparent Background CSS" onclick="insertAtCaret(this.form.text, '\tbackground: transparent;\n')"><br />
							</div>
						</p>
					</div>
					
					<div id="dynamik-fe-css-builder-nav-borders-box" class="dynamik-fe-css-builder-all-css-builder">
						<p style="float:left;">
							<div class="dynamik-fe-css-builder-options-box">
								<?php _e( 'Type', 'dynamik' ); ?>
								<select id="border_type" name="border_type" size="1" style="width:100px;margin-bottom:10px;">
									<option value="border"><?php _e( 'Full', 'dynamik' ); ?></option>
									<option value="border-top"><?php _e( 'Top', 'dynamik' ); ?></option>
									<option value="border-bottom"><?php _e( 'Bottom', 'dynamik' ); ?></option>
									<option value="border-left"><?php _e( 'Left', 'dynamik' ); ?></option>
									<option value="border-right"><?php _e( 'Right', 'dynamik' ); ?></option>
								</select>
								<?php _e( 'Thickness', 'dynamik' ); ?>
								<input type="text" id="border_thickness" name="border_thickness" value="0" style="width:35px;" /><?php _e( 'px', 'dynamik' ); ?><br />
								<?php _e( 'Style', 'dynamik' ); ?>
								<select id="border_style" name="border_style" size="1" style="width:100px;">
									<option value="solid"><?php _e( 'solid', 'dynamik' ); ?></option>
									<option value="dotted"><?php _e( 'dotted', 'dynamik' ); ?></option>
									<option value="dashed"><?php _e( 'dashed', 'dynamik' ); ?></option>
									<option value="double"><?php _e( 'double', 'dynamik' ); ?></option>
									<option value="groove"><?php _e( 'groove', 'dynamik' ); ?></option>
									<option value="ridge"><?php _e( 'ridge', 'dynamik' ); ?></option>
									<option value="inset"><?php _e( 'inset', 'dynamik' ); ?></option>
									<option value="outset"><?php _e( 'outset', 'dynamik' ); ?></option>
								</select>
								<?php _e( 'Color', 'dynamik' ); ?>
								<input type="text" class="color {pickerFaceColor:'#FFFFFF'}" style="width:70px;" id="border_color" name="border_color" value="" /><br />
								<input class="dynamik-fe-css-builder-button-bgs dynamik-fe-css-builder-buttons" type="button" value="Insert Border CSS" style="margin-top:10px;" onclick="insertAtCaret(this.form.text, '\t'+this.form.border_type.value+': '+this.form.border_thickness.value+'px '+this.form.border_style.value+' #'+this.form.border_color.value+';\n')"><br />
							</div>
							<div class="dynamik-fe-css-builder-options-box">
								<input class="dynamik-fe-css-builder-button-bgs dynamik-fe-css-builder-buttons" type="button" value="Insert Border Zero CSS" onclick="insertAtCaret(this.form.text, '\tborder: 0;\n')"><br />
							</div>
						</p>
					</div>
					
					<div id="dynamik-fe-css-builder-nav-border-radius-box" class="dynamik-fe-css-builder-all-css-builder">
						<p style="float:left;">
							<div class="dynamik-fe-css-builder-options-box">
								<?php _e( 'Tp-Lft', 'dynamik' ); ?>
								<input type="text" id="border_radius_top" name="border_radius_top" value="0" style="width:24px;" />
								<?php _e( 'Tp-Rt', 'dynamik' ); ?>
								<input type="text" id="border_radius_right" name="border_radius_right" value="0" style="width:24px;" />
								<?php _e( 'Btm-Rt', 'dynamik' ); ?>
								<input type="text" id="border_radius_bottom" name="border_radius_bottom" value="0" style="width:24px;" />
								<?php _e( 'Btm-Lft', 'dynamik' ); ?>
								<input type="text" id="border_radius_left" name="border_radius_left" value="0" style="width:24px;" /><br />
								<input class="dynamik-fe-css-builder-button-bgs dynamik-fe-css-builder-buttons" style="margin-top:10px;" type="button" value="Insert Border Radius CSS" onclick="insertAtCaret(this.form.text, '\t-webkit-border-radius: '+this.form.border_radius_top.value+'px '+this.form.border_radius_right.value+'px '+this.form.border_radius_bottom.value+'px '+this.form.border_radius_left.value+'px;\n\tborder-radius: '+this.form.border_radius_top.value+'px '+this.form.border_radius_right.value+'px '+this.form.border_radius_bottom.value+'px '+this.form.border_radius_left.value+'px;\n')">
							</div>
							<div class="dynamik-fe-css-builder-options-box">
								<?php _e( 'Full', 'dynamik' ); ?>
								<input type="text" id="border_radius_full" name="border_radius_full" value="0" style="width:24px;" /><br />
								<input class="dynamik-fe-css-builder-button-bgs dynamik-fe-css-builder-buttons" style="margin-top:10px;" type="button" value="Insert Full Border Radius CSS" onclick="insertAtCaret(this.form.text, '\t-webkit-border-radius: '+this.form.border_radius_full.value+'px;\n\tborder-radius: '+this.form.border_radius_full.value+'px;\n')">
							</div>
						</p>
					</div>
					
					<div id="dynamik-fe-css-builder-nav-margins-box" class="dynamik-fe-css-builder-all-css-builder">
						<p style="float:left;">
							<div class="dynamik-fe-css-builder-options-box">
								<?php _e( 'Top', 'dynamik' ); ?>
								<input type="text" id="margin_top" name="margin_top" value="0" style="width:25px;margin-right:5px;" />
								<?php _e( 'Right', 'dynamik' ); ?>
								<input type="text" id="margin_right" name="margin_right" value="0" style="width:25px;margin-right:5px;" />
								<?php _e( 'Bottom', 'dynamik' ); ?>
								<input type="text" id="margin_bottom" name="margin_bottom" value="0" style="width:25px;margin-right:5px;" />
								<?php _e( 'Left', 'dynamik' ); ?>
								<input type="text" id="margin_left" name="margin_left" value="0" style="width:25px;" /><br />
								<input class="dynamik-fe-css-builder-button-bgs dynamik-fe-css-builder-buttons" style="margin-top:10px;" type="button" value="Insert Margin CSS" onclick="insertAtCaret(this.form.text, '\tmargin: '+this.form.margin_top.value+'px '+this.form.margin_right.value+'px '+this.form.margin_bottom.value+'px '+this.form.margin_left.value+'px;\n')"><br />
							</div>
							<div class="dynamik-fe-css-builder-options-box">
								<?php _e( 'Top/Bottom', 'dynamik' ); ?>
								<input type="text" id="margin_top_bottom" name="margin_top_bottom" value="0" style="width:25px;margin-right:5px;" />
								<?php _e( 'Left/Right', 'dynamik' ); ?>
								<input type="text" id="margin_left_right" name="margin_left_right" value="0" style="width:25px;margin-right:5px;" /><br />
								<input class="dynamik-fe-css-builder-button-bgs dynamik-fe-css-builder-buttons" style="margin-top:10px;" type="button" value="Insert Top/Bottom Margin CSS" onclick="insertAtCaret(this.form.text, '\tmargin: '+this.form.margin_top_bottom.value+'px '+this.form.margin_left_right.value+'px;\n')"><br />
							</div>
							<div class="dynamik-fe-css-builder-options-box">
								<?php _e( 'Full', 'dynamik' ); ?>
								<input type="text" id="margin_full" name="margin_full" value="0" style="width:25px;margin-right:5px;" /><br />
								<input class="dynamik-fe-css-builder-button-bgs dynamik-fe-css-builder-buttons" style="margin-top:10px;" type="button" value="Insert Full Margin CSS" onclick="insertAtCaret(this.form.text, '\tmargin: '+this.form.margin_full.value+'px;\n')"><br />
							</div>
						</p>
					</div>
					
					<div id="dynamik-fe-css-builder-nav-padding-box" class="dynamik-fe-css-builder-all-css-builder">
						<p style="float:left;">
							<div class="dynamik-fe-css-builder-options-box">
								<?php _e( 'Top', 'dynamik' ); ?>
								<input type="text" id="padding_top" name="padding_top" value="0" style="width:25px;margin-right:5px;" />
								<?php _e( 'Right', 'dynamik' ); ?>
								<input type="text" id="padding_right" name="padding_right" value="0" style="width:25px;margin-right:5px;" />
								<?php _e( 'Bottom', 'dynamik' ); ?>
								<input type="text" id="padding_bottom" name="padding_bottom" value="0" style="width:25px;margin-right:5px;" />
								<?php _e( 'Left', 'dynamik' ); ?>
								<input type="text" id="padding_left" name="padding_left" value="0" style="width:25px;" /><br />
								<input class="dynamik-fe-css-builder-button-bgs dynamik-fe-css-builder-buttons" style="margin-top:10px;" type="button" value="Insert Padding CSS" onclick="insertAtCaret(this.form.text, '\tpadding: '+this.form.padding_top.value+'px '+this.form.padding_right.value+'px '+this.form.padding_bottom.value+'px '+this.form.padding_left.value+'px;\n')">
							</div>
							<div class="dynamik-fe-css-builder-options-box">
								<?php _e( 'Top/Bottom', 'dynamik' ); ?>
								<input type="text" id="padding_top_bottom" name="padding_top_bottom" value="0" style="width:25px;margin-right:5px;" />
								<?php _e( 'Left/Right', 'dynamik' ); ?>
								<input type="text" id="padding_left_right" name="padding_left_right" value="0" style="width:25px;margin-right:5px;" /><br />
								<input class="dynamik-fe-css-builder-button-bgs dynamik-fe-css-builder-buttons" style="margin-top:10px;" type="button" value="Insert Top/Bottom Padding CSS" onclick="insertAtCaret(this.form.text, '\tpadding: '+this.form.padding_top_bottom.value+'px '+this.form.padding_left_right.value+'px;\n')"><br />
							</div>
							<div class="dynamik-fe-css-builder-options-box">
								<?php _e( 'Full', 'dynamik' ); ?>
								<input type="text" id="padding_full" name="padding_full" value="0" style="width:25px;margin-right:5px;" /><br />
								<input class="dynamik-fe-css-builder-button-bgs dynamik-fe-css-builder-buttons" style="margin-top:10px;" type="button" value="Insert Full Padding CSS" onclick="insertAtCaret(this.form.text, '\tpadding: '+this.form.padding_full.value+'px;\n')"><br />
							</div>
						</p>
					</div>
	
					<div id="dynamik-fe-css-builder-nav-fonts-box" class="dynamik-fe-css-builder-all-css-builder">
						<p style="float:left;">
							<input id="font-type-button" class="dynamik-fe-css-builder-button dynamik-fe-css-builder-buttons" type="button" value="Insert Font Type" onclick="insertAtCaret(this.form.text, '\tfont-family: '+this.form.font_type.value+';\n')">
							<select id="font_type" class="dynamik-fe-css-builder-font-options-width-control" name="font_type" size="1">
								<optgroup label="Standard Fonts">
									<option value="Arial, sans-serif"><?php _e( 'Arial', 'dynamik' ); ?></option>
									<option value="'Arial Black', sans-serif"><?php _e( 'Arial Black', 'dynamik' ); ?></option>
									<option value="'Courier New', sans-serif"><?php _e( 'Courier New', 'dynamik' ); ?></option>
									<option value="Georgia, serif"><?php _e( 'Georgia', 'dynamik' ); ?></option>
									<option value="Helvetica, sans-serif"><?php _e( 'Helvetica', 'dynamik' ); ?></option>
									<option value="Impact, sans-serif"><?php _e( 'Impact', 'dynamik' ); ?></option>
									<option value="'Lucida Console', sans-serif"><?php _e( 'Lucida Console', 'dynamik' ); ?></option>
									<option value="'Lucida Sans Unicode', sans-serif"><?php _e( 'Lucida Sans Unicode', 'dynamik' ); ?></option>
									<option value="Tahoma, sans-serif"><?php _e( 'Tahoma', 'dynamik' ); ?></option>
									<option value="'Times New Roman', serif"><?php _e( 'Times New Roman', 'dynamik' ); ?></option>
									<option value="'Trebuchet MS', sans-serif"><?php _e( 'Trebuchet MS', 'dynamik' ); ?></option>
									<option value="Verdana, sans-serif"><?php _e( 'Verdana', 'dynamik' ); ?></option>
								</optgroup>
							</select><br />
							<input class="dynamik-fe-css-builder-button dynamik-fe-css-builder-buttons" type="button" value="Insert Font Size" onclick="insertAtCaret(this.form.text, '\tfont-size: '+this.form.font_size.value+this.form.font_unit.value+';\n')">
							<input type="text" id="font_size" name="font_size" value="12" style="width:35px;" />
							<select id="font_unit" name="font_unit" size="1" class="iewide" style="width:50px;">
								<option value="px"><?php _e( 'px', 'dynamik' ); ?></option>
								<option value="rem"><?php _e( 'rem', 'dynamik' ); ?></option>
							</select><br />
							<input class="dynamik-fe-css-builder-button dynamik-fe-css-builder-buttons" type="button" value="Insert Font Color" onclick="insertAtCaret(this.form.text, '\tcolor: #'+this.form.font_color.value+';\n')">
							<input type="text" class="color {pickerFaceColor:'#FFFFFF'} color-box-150" style="width:110px;" id="font_color" name="font_color" value="" /><br />
							<input class="dynamik-fe-css-builder-button dynamik-fe-css-builder-buttons" type="button" value="Insert Font Weight" onclick="insertAtCaret(this.form.text, '\tfont-weight: '+this.form.font_weight.value+';\n')">
							<select id="font_weight" name="font_weight" size="1" class="iewide dynamik-fe-css-builder-font-options-width-control">
								<option value="normal"><?php _e( 'Normal', 'dynamik' ); ?></option>
								<option value="bold"><?php _e( 'Bold', 'dynamik' ); ?></option>
								<option value="100"><?php _e( '100', 'dynamik' ); ?></option>
								<option value="200"><?php _e( '200', 'dynamik' ); ?></option>
								<option value="300"><?php _e( '300', 'dynamik' ); ?></option>
								<option value="400"><?php _e( '400', 'dynamik' ); ?></option>
								<option value="500"><?php _e( '500', 'dynamik' ); ?></option>
								<option value="600"><?php _e( '600', 'dynamik' ); ?></option>
								<option value="700"><?php _e( '700', 'dynamik' ); ?></option>
								<option value="800"><?php _e( '800', 'dynamik' ); ?></option>
								<option value="900"><?php _e( '900', 'dynamik' ); ?></option>
							</select><br />
							<input class="dynamik-fe-css-builder-button dynamik-fe-css-builder-buttons" type="button" value="Insert Font Style" onclick="insertAtCaret(this.form.text, '\tfont-style: '+this.form.font_style.value+';\n')">
							<select id="font_style" class="dynamik-fe-css-builder-font-options-width-control" name="font_style" size="1" class="iewide">
								<option value="normal"><?php _e( 'Normal', 'dynamik' ); ?></option>
								<option value="italic"><?php _e( 'Italic', 'dynamik' ); ?></option>
							</select><br />
							<input class="dynamik-fe-css-builder-button dynamik-fe-css-builder-buttons" type="button" value="Insert Text Align" onclick="insertAtCaret(this.form.text, '\ttext-align: '+this.form.text_align.value+';\n')">
							<select id="text_align" class="dynamik-fe-css-builder-font-options-width-control" name="text_align" size="1" class="iewide">
								<option value="left"><?php _e( 'Left', 'dynamik' ); ?></option>
								<option value="center"><?php _e( 'Center', 'dynamik' ); ?></option>
								<option value="right"><?php _e( 'Right', 'dynamik' ); ?></option>
								<option value="justify"><?php _e( 'Justify', 'dynamik' ); ?></option>
							</select><br />
							<input class="dynamik-fe-css-builder-button dynamik-fe-css-builder-buttons" type="button" value="Insert Transform" onclick="insertAtCaret(this.form.text, '\ttext-transform: '+this.form.font_caps.value+';\n')">
							<select id="font_caps" class="dynamik-fe-css-builder-font-options-width-control" name="font_caps" size="1" class="iewide">
								<option value="none"><?php _e( 'None', 'dynamik' ); ?></option>
								<option value="uppercase"><?php _e( 'Uppercase', 'dynamik' ); ?></option>
								<option value="lowercase"><?php _e( 'Lowercase', 'dynamik' ); ?></option>
								<option value="capitalize"><?php _e( 'Capitalize', 'dynamik' ); ?></option>
							</select><br />
							<input class="dynamik-fe-css-builder-button dynamik-fe-css-builder-buttons" type="button" value="Insert Letter Spacing" onclick="insertAtCaret(this.form.text, '\tletter-spacing: '+this.form.letter_spacing.value+';\n')">
							<select id="letter_spacing" class="dynamik-fe-css-builder-font-options-width-control" name="letter_spacing" size="1" class="iewide">
								<option value=".5px"><?php _e( '.5px', 'dynamik' ); ?></option>
								<option value="1px"><?php _e( '1px', 'dynamik' ); ?></option>
								<option value="1.5px"><?php _e( '1.5px', 'dynamik' ); ?></option>
								<option value="2px"><?php _e( '2px', 'dynamik' ); ?></option>
								<option value="2.5px"><?php _e( '2.5px', 'dynamik' ); ?></option>
								<option value="3px"><?php _e( '3px', 'dynamik' ); ?></option>
								<option value="3.5px"><?php _e( '3.5px', 'dynamik' ); ?></option>
								<option value="4px"><?php _e( '4px', 'dynamik' ); ?></option>
							</select><br />
							<input class="dynamik-fe-css-builder-button dynamik-fe-css-builder-buttons" type="button" value="Insert Line Height" onclick="insertAtCaret(this.form.text, '\tline-height: '+this.form.line_height.value+';\n')">
							<select id="line_height" class="dynamik-fe-css-builder-font-options-width-control" name="line_height" size="1" class="iewide">
								<option value="100%"><?php _e( '100%', 'dynamik' ); ?></option>
								<option value="110%"><?php _e( '110%', 'dynamik' ); ?></option>
								<option value="120%"><?php _e( '120%', 'dynamik' ); ?></option>
								<option value="130%"><?php _e( '130%', 'dynamik' ); ?></option>
								<option value="140%"><?php _e( '140%', 'dynamik' ); ?></option>
								<option value="150%"><?php _e( '150%', 'dynamik' ); ?></option>
								<option value="160%"><?php _e( '160%', 'dynamik' ); ?></option>
								<option value="170%"><?php _e( '170%', 'dynamik' ); ?></option>
								<option value="180%"><?php _e( '180%', 'dynamik' ); ?></option>
								<option value="190%"><?php _e( '190%', 'dynamik' ); ?></option>
								<option value="200%"><?php _e( '200%', 'dynamik' ); ?></option>
							</select><br />
							<input class="dynamik-fe-css-builder-button dynamik-fe-css-builder-buttons" type="button" value="Insert Txt Decoration" onclick="insertAtCaret(this.form.text, '\ttext-decoration: '+this.form.text_decoration.value+';\n')">
							<select id="text_decoration" class="dynamik-fe-css-builder-font-options-width-control" name="text_decoration" size="1" class="iewide">
								<option value="none"><?php _e( 'none', 'dynamik' ); ?></option>
								<option value="underline"><?php _e( 'underline', 'dynamik' ); ?></option>
								<option value="overline"><?php _e( 'overline', 'dynamik' ); ?></option>
								<option value="line-through"><?php _e( 'line-through', 'dynamik' ); ?></option>
								<option value="blink"><?php _e( 'blink', 'dynamik' ); ?></option>
								<option value="inherit"><?php _e( 'inherit', 'dynamik' ); ?></option>
							</select><br />
						</p>
					</div>
					
					<div id="dynamik-fe-css-builder-nav-width-float-box" class="dynamik-fe-css-builder-all-css-builder">
						<p style="float:left;">		
							<input class="dynamik-fe-css-builder-button dynamik-fe-css-builder-buttons" type="button" value="Insert px Width CSS" onclick="insertAtCaret(this.form.text, '\twidth: '+this.form.width_px.value+'px;\n')">
							<input type="text" id="width_px" name="width_px" value="" style="width:40px;" /><?php _e( 'px', 'dynamik' ); ?><br />
							<input class="dynamik-fe-css-builder-button dynamik-fe-css-builder-buttons" type="button" value="Insert % Width CSS" onclick="insertAtCaret(this.form.text, '\twidth: '+this.form.width_percent.value+'%;\n')">
							<input type="text" id="width_percent" name="width_percent" value="" style="width:40px;" /><?php _e( '%', 'dynamik' ); ?><br />
							<input class="dynamik-fe-css-builder-button dynamik-fe-css-builder-buttons" type="button" value="Insert px Max Width CSS" onclick="insertAtCaret(this.form.text, '\tmax-width: '+this.form.max_width_px.value+'px;\n')">
							<input type="text" id="max_width_px" name="max_width_px" value="" style="width:40px;" /><?php _e( 'px', 'dynamik' ); ?><br />
							<input class="dynamik-fe-css-builder-button dynamik-fe-css-builder-buttons" type="button" value="Insert % Max Width CSS" onclick="insertAtCaret(this.form.text, '\tmax-width: '+this.form.max_width_percent.value+'%;\n')">
							<input type="text" id="max_width_percent" name="max_width_percent" value="" style="width:40px;" /><?php _e( '%', 'dynamik' ); ?><br />
							<input class="dynamik-fe-css-builder-button dynamik-fe-css-builder-buttons" type="button" value="Insert Height CSS" onclick="insertAtCaret(this.form.text, '\theight: '+this.form.height.value+'px;\n')">
							<input type="text" id="height" name="height" value="" style="width:40px;" /><?php _e( 'px', 'dynamik' ); ?><br />
							<input class="dynamik-fe-css-builder-button dynamik-fe-css-builder-buttons" type="button" value="Insert Float CSS" onclick="insertAtCaret(this.form.text, '\tfloat: '+this.form.float_direction.value+';\n')">
							<select id="float_direction" name="float_direction" size="1" class="iewide" style="width:110px;">
								<option value="none"><?php _e( 'None', 'dynamik' ); ?></option>
								<option value="left"><?php _e( 'Left', 'dynamik' ); ?></option>
								<option value="right"><?php _e( 'Right', 'dynamik' ); ?></option>
							</select><br />
							<input class="dynamik-fe-css-builder-button dynamik-fe-css-builder-buttons" type="button" value="Insert Position" onclick="insertAtCaret(this.form.text, '\tposition: '+this.form.position.value+';\n')">
							<select id="position" name="position" size="1" class="iewide" style="width:110px;">
								<option value="absolute"><?php _e( 'absolute', 'dynamik' ); ?></option>
								<option value="fixed"><?php _e( 'fixed', 'dynamik' ); ?></option>
								<option value="relative"><?php _e( 'relative', 'dynamik' ); ?></option>
								<option value="static"><?php _e( 'static', 'dynamik' ); ?></option>
								<option value="inherit"><?php _e( 'inherit', 'dynamik' ); ?></option>
							</select><br />
							<input class="dynamik-fe-css-builder-button dynamik-fe-css-builder-buttons" type="button" value="Insert Display" onclick="insertAtCaret(this.form.text, '\tdisplay: '+this.form.display.value+';\n')">
							<select id="display" name="display" size="1" class="iewide" style="width:110px;">
								<option value="none"><?php _e( 'none', 'dynamik' ); ?></option>
								<option value="block"><?php _e( 'block', 'dynamik' ); ?></option>
								<option value="inline"><?php _e( 'inline', 'dynamik' ); ?></option>
								<option value="inline-block"><?php _e( 'inline-block', 'dynamik' ); ?></option>
								<option value="inline-table"><?php _e( 'inline-table', 'dynamik' ); ?></option>
								<option value="list-item"><?php _e( 'list-item', 'dynamik' ); ?></option>
								<option value="run-in"><?php _e( 'run-in', 'dynamik' ); ?></option>
								<option value="table"><?php _e( 'table', 'dynamik' ); ?></option>
								<option value="table-caption"><?php _e( 'table-caption', 'dynamik' ); ?></option>
								<option value="table-cell"><?php _e( 'table-cell', 'dynamik' ); ?></option>
								<option value="table-column"><?php _e( 'table-column', 'dynamik' ); ?></option>
								<option value="table-column-group"><?php _e( 'table-column-group', 'dynamik' ); ?></option>
								<option value="table-footer-group"><?php _e( 'table-footer-group', 'dynamik' ); ?></option>
								<option value="table-header-group"><?php _e( 'table-header-group', 'dynamik' ); ?></option>
								<option value="table-row"><?php _e( 'table-row', 'dynamik' ); ?></option>
								<option value="table-row-group"><?php _e( 'table-row-group', 'dynamik' ); ?></option>
								<option value="inherit"><?php _e( 'inherit', 'dynamik' ); ?></option>
							</select>
						</p>
					</div>
					
					<div id="dynamik-fe-css-builder-nav-shadows-box" class="dynamik-fe-css-builder-all-css-builder">
						<p style="float:left;">
							<div class="dynamik-fe-css-builder-options-box">
								<?php _e( 'Lft-Rt', 'dynamik' ); ?>
								<input type="text" id="box_shadow_lr" name="box_shadow_lr" value="0" style="width:40px;" />
								<?php _e( 'Tp-Btm', 'dynamik' ); ?>
								<input type="text" id="box_shadow_tb" name="box_shadow_tb" value="0" style="width:40px;" /><br />
								<?php _e( 'Blur', 'dynamik' ); ?>
								<input type="text" id="box_shadow_blur" name="box_shadow_blur" value="0" style="width:30px; height:24px;" />
								<?php _e( 'Spread', 'dynamik' ); ?>
								<input type="text" id="box_shadow_spread" name="box_shadow_spread" value="0" style="width:30px; height:24px;" />
								<?php _e( 'Color', 'dynamik' ); ?>
								<input type="text" class="color {pickerFaceColor:'#FFFFFF'}" style="width:70px;" id="box_shadow_color" name="box_shadow_color" value="" style="margin-bottom:10px;"/><br />
								<input class="dynamik-fe-css-builder-button-bgs dynamik-fe-css-builder-buttons" style="margin-top:10px;" type="button" value="Insert Box Shadow CSS (in pixels)" onclick="insertAtCaret(this.form.text, '\t-webkit-box-shadow: '+this.form.box_shadow_lr.value+'px '+this.form.box_shadow_tb.value+'px '+this.form.box_shadow_blur.value+'px '+this.form.box_shadow_spread.value+'px #'+this.form.box_shadow_color.value+';\n\tbox-shadow: '+this.form.box_shadow_lr.value+'px '+this.form.box_shadow_tb.value+'px '+this.form.box_shadow_blur.value+'px '+this.form.box_shadow_spread.value+'px #'+this.form.box_shadow_color.value+';\n')"><br />
							</div>
							<div class="dynamik-fe-css-builder-options-box">
								<?php _e( 'Lft-Rt', 'dynamik' ); ?>
								<input type="text" id="text_shadow_lr" name="text_shadow_lr" value="0" style="width:40px;" />
								<?php _e( 'Tp-Btm', 'dynamik' ); ?>
								<input type="text" id="text_shadow_tb" name="text_shadow_tb" value="0" style="width:40px;" /><br />
								<?php _e( 'Blur', 'dynamik' ); ?>
								<input type="text" id="text_shadow_blur" name="text_shadow_blur" value="0" style="width:30px; height:24px;" />
								<?php _e( 'Color', 'dynamik' ); ?>
								<input type="text" class="color {pickerFaceColor:'#FFFFFF'}" style="width:70px;" id="text_shadow_color" name="text_shadow_color" value="" style="margin-bottom:10px;"/><br />
								<input class="dynamik-fe-css-builder-button-bgs dynamik-fe-css-builder-buttons" style="margin-top:10px;" type="button" value="Insert Text Shadow CSS (in pixels)" onclick="insertAtCaret(this.form.text, '\ttext-shadow: '+this.form.text_shadow_lr.value+'px '+this.form.text_shadow_tb.value+'px '+this.form.text_shadow_blur.value+'px #'+this.form.text_shadow_color.value+';\n')">
							</div>
						</p>
					</div>
					
				</div><!-- END .dynamik-fe-css-builder-col-left -->
				
				<div class="dynamik-fe-css-builder-col dynamik-fe-css-builder-col-right">
					
					<textarea wrap="off" id="dynamik-fe-css-builder-output" class="code-builder-output" name="text"></textarea>					
					
				</div><!-- END .dynamik-fe-css-builder-col-right -->
			
			</form><!-- END #dynamik-fe-css-builder-form -->
	
		</div><!-- END .dynamik-fe-css-builder-col-container -->
		
		<button id="dynamik-fe-css-builder-output-cut-button" class="code-builder-output-cut" data-clipboard-action="cut" data-clipboard-target="#dynamik-fe-css-builder-output">Copy To Clipboard</button>
		<button style="display:none;" id="dynamik-fe-css-builder-output-copied-button" class="code-builder-output-cut">Copied!</button>
	
	</div><!-- END .dynamik-fe-css-builder-container -->
<?php
	
}

add_action( 'wp_head', 'dynamik_fe_css_builder_dynamik_fe_css_builder', 15 );
/**
 * Add the Dynamik FE CSS Builder HTML to the <head> area.
 *
 * @since 2.0
 */
function dynamik_fe_css_builder_dynamik_fe_css_builder() {

	echo '<span id="dynamik-fe-css-builder-css" style="display:none;"><span class="dashicons dashicons-sos"></span></span>' . "\n";
	echo '<span id="dynamik-fe-css-builder-highlight-css"></span>' . "\n";
	
	if ( PHP_VERSION >= 5.3 )
		echo '<span id="css-builder-hooks-map"><span class="dashicons dashicons-location-alt"></span></span>' . "\n";
	
}
