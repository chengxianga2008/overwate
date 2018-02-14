<?php
/**
 * Builds the Dynamik Widths admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-design-options-nav-widths-box" class="dynamik-optionbox-outer-1col dynamik-not-universal dynamik-all-options">
	<div class="dynamik-optionbox-inner-1col">		
		<h3><?php _e( 'Layout Widths', 'dynamik' ); ?> <a href="http://dynamikdocs.cobaltapps.com/article/33-layout-widths" class="tooltip-mark" target="_blank">[?]</a></h3>
		
		<div id="dynamik-width-option-wrap-dbl-rt-sb" class="dynamik-width-option-wrap">
			<div class="dynamik-design-option-desc">
				<p><?php _e( 'Content-Sidebar-Sidebar Layout', 'dynamik' ); ?></p>
			</div>
			
			<div class="dynamik-design-option">
				<p>
					<?php _e( 'Content', 'dynamik' ); ?>
					<input type="text" id="dynamik-content-width-dbl-rt-sb" class="dynamik-width-option" name="dynamik[cc_width_dbl_rt_sb]" value="<?php echo dynamik_design_options_defaults( true, 'cc_width_dbl_rt_sb' ); ?>" style="width:40px;" /><code class="dynamik-px-unit">px</code>
					<?php _e( 'Prim. Sidebar', 'dynamik' ); ?>
					<input type="text" id="dynamik-sb1-width-dbl-rt-sb" class="dynamik-width-option" name="dynamik[sb1_width_dbl_rt_sb]" value="<?php echo dynamik_design_options_defaults( true, 'sb1_width_dbl_rt_sb' ); ?>" style="width:40px;" /><code class="dynamik-px-unit">px</code>
					<?php _e( 'Sec. Sidebar', 'dynamik' ); ?>
					<input type="text" id="dynamik-sb2-width-dbl-rt-sb" class="dynamik-width-option" name="dynamik[sb2_width_dbl_rt_sb]" value="<?php echo dynamik_design_options_defaults( true, 'sb2_width_dbl_rt_sb' ); ?>" style="width:40px;" /><code class="dynamik-px-unit">px</code>
					<?php _e( 'Wrap Width: ', 'dynamik' ); ?>
					<strong><span id="calculated-width-dbl-rt-sb" <?php if( genesis_site_layout() == 'content-sidebar-sidebar' ) { echo 'class="default-layout-wrap-width"'; } ?>>960</span></strong>px
				</p>
			</div>
		</div>
		
		<div id="dynamik-width-option-wrap-dbl-lft-sb" class="dynamik-width-option-wrap">
			<div class="dynamik-design-option-desc">
				<p><?php _e( 'Sidebar-Sidebar-Content Layout', 'dynamik' ); ?></p>
			</div>
			
			<div class="dynamik-design-option">
				<p>
					<?php _e( 'Content', 'dynamik' ); ?>
					<input type="text" id="dynamik-content-width-dbl-lft-sb" class="dynamik-width-option" name="dynamik[cc_width_dbl_lft_sb]" value="<?php echo dynamik_design_options_defaults( true, 'cc_width_dbl_lft_sb' ); ?>" style="width:40px;" /><code class="dynamik-px-unit">px</code>
					<?php _e( 'Prim. Sidebar', 'dynamik' ); ?>
					<input type="text" id="dynamik-sb1-width-dbl-lft-sb" class="dynamik-width-option" name="dynamik[sb1_width_dbl_lft_sb]" value="<?php echo dynamik_design_options_defaults( true, 'sb1_width_dbl_lft_sb' ); ?>" style="width:40px;" /><code class="dynamik-px-unit">px</code>
					<?php _e( 'Sec. Sidebar', 'dynamik' ); ?>
					<input type="text" id="dynamik-sb2-width-dbl-lft-sb" class="dynamik-width-option" name="dynamik[sb2_width_dbl_lft_sb]" value="<?php echo dynamik_design_options_defaults( true, 'sb2_width_dbl_lft_sb' ); ?>" style="width:40px;" /><code class="dynamik-px-unit">px</code>
					<?php _e( 'Wrap Width: ', 'dynamik' ); ?>
					<strong><span id="calculated-width-dbl-lft-sb" <?php if( genesis_site_layout() == 'sidebar-sidebar-content' ) { echo 'class="default-layout-wrap-width"'; } ?>>960</span></strong>px
				</p>
			</div>
		</div>
		
		<div id="dynamik-width-option-wrap-dbl-sb" class="dynamik-width-option-wrap">
			<div class="dynamik-design-option-desc">
				<p><?php _e( 'Sidebar-Content-Sidebar Layout', 'dynamik' ); ?></p>
			</div>
			
			<div class="dynamik-design-option">
				<p>
					<?php _e( 'Content', 'dynamik' ); ?>
					<input type="text" id="dynamik-content-width-dbl-sb" class="dynamik-width-option" name="dynamik[cc_width_dbl_sb]" value="<?php echo dynamik_design_options_defaults( true, 'cc_width_dbl_sb' ); ?>" style="width:40px;" /><code class="dynamik-px-unit">px</code>
					<?php _e( 'Prim. Sidebar', 'dynamik' ); ?>
					<input type="text" id="dynamik-sb1-width-dbl-sb" class="dynamik-width-option" name="dynamik[sb1_width_dbl_sb]" value="<?php echo dynamik_design_options_defaults( true, 'sb1_width_dbl_sb' ); ?>" style="width:40px;" /><code class="dynamik-px-unit">px</code>
					<?php _e( 'Sec. Sidebar', 'dynamik' ); ?>
					<input type="text" id="dynamik-sb2-width-dbl-sb" class="dynamik-width-option" name="dynamik[sb2_width_dbl_sb]" value="<?php echo dynamik_design_options_defaults( true, 'sb2_width_dbl_sb' ); ?>" style="width:40px;" /><code class="dynamik-px-unit">px</code>
					<?php _e( 'Wrap Width: ', 'dynamik' ); ?>
					<strong><span id="calculated-width-dbl-sb" <?php if( genesis_site_layout() == 'sidebar-content-sidebar' ) { echo 'class="default-layout-wrap-width"'; } ?>>960</span></strong>px
				</p>
			</div>
		</div>
		
		<div id="dynamik-width-option-wrap-rt-sb" class="dynamik-width-option-wrap">
			<div class="dynamik-design-option-desc">
				<p><?php _e( 'Content-Sidebar Layout', 'dynamik' ); ?></p>
			</div>
			
			<div class="dynamik-design-option">
				<p>
					<?php _e( 'Content', 'dynamik' ); ?>
					<input type="text" id="dynamik-content-width-rt-sb" class="dynamik-width-option" name="dynamik[cc_width_rt_sb]" value="<?php echo dynamik_design_options_defaults( true, 'cc_width_rt_sb' ); ?>" style="width:40px;" /><code class="dynamik-px-unit">px</code>
					<?php _e( 'Prim. Sidebar', 'dynamik' ); ?>
					<input type="text" id="dynamik-sb1-width-rt-sb" class="dynamik-width-option" name="dynamik[sb1_width_rt_sb]" value="<?php echo dynamik_design_options_defaults( true, 'sb1_width_rt_sb' ); ?>" style="width:40px;" /><code class="dynamik-px-unit">px</code>
					<?php _e( 'Wrap Width: ', 'dynamik' ); ?>
					<strong><span id="calculated-width-rt-sb" <?php if( genesis_site_layout() == 'content-sidebar' ) { echo 'class="default-layout-wrap-width"'; } ?>>960</span></strong>px
				</p>
			</div>
		</div>
		
		<div id="dynamik-width-option-wrap-lft-sb" class="dynamik-width-option-wrap">
			<div class="dynamik-design-option-desc">
				<p><?php _e( 'Sidebar-Content Layout', 'dynamik' ); ?></p>
			</div>
			
			<div class="dynamik-design-option">
				<p>
					<?php _e( 'Content', 'dynamik' ); ?>
					<input type="text" id="dynamik-content-width-lft-sb" class="dynamik-width-option" name="dynamik[cc_width_lft_sb]" value="<?php echo dynamik_design_options_defaults( true, 'cc_width_lft_sb' ); ?>" style="width:40px;" /><code class="dynamik-px-unit">px</code>
					<?php _e( 'Prim. Sidebar', 'dynamik' ); ?>
					<input type="text" id="dynamik-sb1-width-lft-sb" class="dynamik-width-option" name="dynamik[sb1_width_lft_sb]" value="<?php echo dynamik_design_options_defaults( true, 'sb1_width_lft_sb' ); ?>" style="width:40px;" /><code class="dynamik-px-unit">px</code>
					<?php _e( 'Wrap Width: ', 'dynamik' ); ?>
					<strong><span id="calculated-width-lft-sb" <?php if( genesis_site_layout() == 'sidebar-content' ) { echo 'class="default-layout-wrap-width"'; } ?>>960</span></strong>px
				</p>
			</div>
		</div>
		
		<div id="dynamik-width-option-wrap-no-sb" class="dynamik-width-option-wrap">
			<div class="dynamik-design-option-desc">
				<p><?php _e( 'Full Width Content Layout', 'dynamik' ); ?></p>
			</div>
			
			<div class="dynamik-design-option">
				<p>
					<?php _e( 'Content', 'dynamik' ); ?>
					<input type="text" id="dynamik-content-width-no-sb" class="dynamik-width-option" name="dynamik[cc_width_no_sb]" value="<?php echo dynamik_design_options_defaults( true, 'cc_width_no_sb' ); ?>" style="width:40px;" /><code class="dynamik-px-unit">px</code>
					<?php _e( 'Wrap Width: ', 'dynamik' ); ?>
					<strong><span id="calculated-width-no-sb" <?php if( genesis_site_layout() == 'full-width-content' ) { echo 'class="default-layout-wrap-width"'; } ?>>960</span></strong>px
				</p>
			</div>
		</div>
	</div>
</div>