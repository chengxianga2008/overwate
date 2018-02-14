<?php
/**
 * Builds the Custom PHP Builder admin content.
 *
 * @package Dynamik
 */
?>

<div style="display:none;" id="dynamik-custom-php-builder" class="dynamik-optionbox-outer-1col">
	<div class="dynamik-optionbox-inner-1col">
		<h3 style="width:805px; border-bottom:0;"><?php _e( 'Custom PHP Builder', 'coder' ); ?> <a href="http://dynamikdocs.cobaltapps.com/article/98-custom-php-builder" class="tooltip-mark" target="_blank">[?]</a></h3>

		<div id="dynamik-custom-php-builder-wrap">
		<form name="form">
			<div id="dynamik-custom-php-builder-wrap-inner" class="bg-box">
				<div id="dynamik-custom-php-builder-options">
					<p>
						<select id="php_action_or_filter" name="php_action_or_filter" size="1" class="iewide" style="width:125px;">
							<option value="remove_action"><?php _e( 'remove_action', 'coder' ); ?></option>
							<option value="add_action"><?php _e( 'add_action', 'coder' ); ?></option>
							<option value="replace_action"><?php _e( '"replace"_action', 'coder' ); ?></option>
							<option value="add_filter"><?php _e( 'add_filter', 'coder' ); ?></option>
						</select>
						<span id="php_remove_actions_wrap" class="php-builder-hidden-option">
						<select id="php_remove_actions" class="php-builder-elements-select" name="php_remove_actions" size="1">
						<?php dynamik_build_php_actions_menu(); ?>
						</select>
						</span>
						<span id="php_add_actions_wrap" class="php-builder-hidden-option">
						<select id="php_add_actions" class="php-builder-elements-select" name="php_add_actions" size="1">
						<?php dynamik_build_php_actions_menu(); ?>
						</select>
						</span>
						<span id="php_filters_wrap" class="php-builder-hidden-option">
						<select id="php_filters" class="php-builder-elements-select" name="php_filters" size="1">
						<?php dynamik_build_php_filters_menu(); ?>
						</select>
						</span>
						<span id="add_action_hooks_wrap" class="php-builder-hidden-option">
						<select id="php_hooks" class="php-builder-elements-select" name="php_hooks" size="1">
						<?php dynamik_list_hooks(); ?>
						</select>
						</span>
						<span id="custom_function_name_wrap" class="php-builder-hidden-option">
						<input type="text" class="forbid-chars default-text" id="custom_function_name" name="custom_function_name" value="" title="<?php _e( 'Your Custom Function Name', 'coder' ); ?>" style="width:200px;" />
						</span>
						<input id="build_remove_action_php" class="custom-php-builder-button button" style="display:none;" type="button" value="Build Actions" onclick="insertAtCaret(this.form.text, 'remove_action'+this.form.php_remove_actions.value+'\n')">
						<input id="build_add_action_php" class="custom-php-builder-button button" type="button" value="Build Actions" onclick="insertAtCaret(this.form.text, 'add_action'+this.form.php_add_actions.value+'\n')">
						<input id="build_replace_action_php" class="custom-php-builder-button button" style="display:none;" type="button" value="Build Actions" onclick="insertAtCaret(this.form.text, 'remove_action'+this.form.php_add_actions.value+'\nadd_action( \''+this.form.php_add_actions.value.match(/'(.*?)'/)[1]+'\', \''+this.form.custom_function_name.value+'\' );\nfunction '+this.form.custom_function_name.value+'() {\n\t// YOUR PHP CODE GOES HERE\n}\n')">
						<input id="build_add_filter_php" class="custom-php-builder-button button" style="display:none;" type="button" value="Build Filters" onclick="insertAtCaret(this.form.text, 'add_filter( \''+this.form.php_filters.value+'\', \''+this.form.custom_function_name.value+'\' );\nfunction '+this.form.custom_function_name.value+'() {\n\t// YOUR PHP CODE GOES HERE\n}\n')">
					</p>
					<p>
						<?php _e( 'Hooks', 'coder' ); ?>
						<select id="php_hooks_two" class="php-builder-elements-select" name="php_hooks_two" size="1">
						<?php dynamik_list_hooks(); ?>
						</select>
						<span id="custom_function_name_wrap">
						<input type="text" class="forbid-chars default-text" id="custom_function_name_two" name="custom_function_name_two" value="" title="<?php _e( 'Your Custom Function Name', 'coder' ); ?>" style="width:200px;" />
						</span>
						<input id="build_custom_function_php" class="button" type="button" value="add_action Custom Function" onclick="insertAtCaret(this.form.text, 'add_action( \''+this.form.php_hooks_two.value+'\', \''+this.form.custom_function_name_two.value+'\' );\nfunction '+this.form.custom_function_name_two.value+'() {\n\t// YOUR PHP CODE GOES HERE\n}\n')">
					</p>
					<p style="width:48%; margin-top:0; float:left;">
						<?php _e( 'Layouts', 'coder' ); ?>
						<select id="forced_layouts" class="php-builder-elements-select" name="forced_layouts" size="1">
						<?php dynamik_list_forced_layout_options(); ?>
						</select>
						<input id="build_forced_layout_php" class="button" type="button" value="Insert Forced Layout" onclick="insertAtCaret(this.form.text, this.form.forced_layouts.value+'\n')">
					</p>
					<p style="width:48%; margin-top:0; float:right;">
						<?php _e( 'Label Widths', 'dynamik' ); ?>
						<select id="label_widths" class="php-builder-elements-select" name="label_widths" size="1" style="width:150px;">
						<?php dynamik_list_label_width_options(); ?>
						</select>
						<input id="build_defined_label_width_php" class="button" type="button" value="Define Label Width" onclick="insertAtCaret(this.form.text, 'define( \'DYNAMIK_LABEL_WIDTH\', \''+this.form.label_widths.value+'\' );\n')">
					</p>
					<p style="width:48%; margin-top:0; float:left;">
						<select id="wa_shortcodes" class="php-builder-elements-select" name="wa_shortcodes" size="1" style="width:150px;">
						<?php dynamik_list_wa_shortcode_options(); ?>
						</select>
						<input id="build_defined_wa_shortcode_php" class="button" type="button" value="Create Widget Area Shortcode" onclick="insertAtCaret(this.form.text, '['+this.form.wa_shortcodes.value+']\n')">
					</p>
					<p style="width:46%; margin-top:0; float:right;">
						<select id="hb_shortcodes" class="php-builder-elements-select" name="hb_shortcodes" size="1" style="width:150px;">
						<?php dynamik_list_hb_shortcode_options(); ?>
						</select>
						<input id="build_defined_hb_shortcode_php" class="button" type="button" value="Create Hook Box Shortcode" onclick="insertAtCaret(this.form.text, '['+this.form.hb_shortcodes.value+']\n')">
					</p>
					<p style="margin-top:0; float:left;">
						<span style="float:left;">
							<?php _e( 'Code Snippets', 'coder' ); ?>
							<select id="code_snippets" class="php-builder-elements-select" name="code_snippets" size="1">
							<?php dynamik_list_code_snippets(); ?>
							</select>
						</span>
						<input id="build_code_snippets_php" class="button" style="margin-left:5px !important; float:left !important;" type="button" value="Insert Code Snippet" onclick="insertAtCaret(this.form.text, this.form.code_snippets.value+'\n')">
					</p>
					<p style="width:40%; margin-top:0; float:right;">
						<input id="wrap_in_php_tags" class="button" type="button" value="&#60;?php Wrap Code ?&#62;">
						<input id="build_new_line_php" class="button" type="button" value="Add New Line (\n)" title="New Line" onclick="insertAtCaret(this.form.text, '\n')">
					</p>
					<?php if( defined( 'FL_BUILDER_VERSION' ) ) { ?>
					<p style="width:100%; margin-top:0; float:left;">
						<?php _e( 'Beaver Builder Templates', 'coder' ); ?>
						<select id="bb_templates_shortcodes" class="php-builder-elements-select" name="bb_templates_shortcode" size="1" style="width:200px;">
						<?php dynamik_list_bb_templates_shortcode_options(); ?>
						</select>
						<input id="build_defined_bb_templates_shortcode_php" class="button" type="button" value="Create BB Templates Shortcode" onclick="insertAtCaret(this.form.text, '[fl_builder_insert_layout slug=&#34;'+this.form.bb_templates_shortcode.value+'&#34; type=&#34;fl-builder-template&#34;]\n')">
					</p>
					<?php } ?>
				</div>

				<div id="php-builder-output-wrap">
					<textarea wrap="off" id="php-builder-output" class="dynamik-tabby-textarea code-builder-output" name="text"></textarea>
				</div>
			</div>
		</form>
		<button id="php-builder-output-cut-button" class="code-builder-output-cut" data-clipboard-action="cut" data-clipboard-target="#php-builder-output">Copy To Clipboard</button>
		<button style="display:none;" id="php-builder-output-copied-button" class="code-builder-output-cut">Copied!</button>
		</div>
	</div>
</div>