<?php
/**
 * Builds the Settings Theme Info admin content.
 *
 * @package Dynamik
 */
?>

<div id="dynamik-theme-settings-nav-info-box" class="dynamik-optionbox-outer-1col dynamik-all-options dynamik-options-display">
	<div class="dynamik-optionbox-2col-left-wrap">
<?php	if( !empty( $_GET['notice'] ) )
		{
			if( $_GET['notice'] == 'dynamik-unwritable' )
			{
?>				<div id="notice-box" style="background:#FFFBCC;border:1px solid #E6DB55;color:#555555;text-align:center;margin:0 0 15px;padding:15px;"><strong><?php _e( 'It appears that some of your files/folders are unwritable to Dynamik. Please refer to', 'dynamik' ); ?> <a href="http://dynamikdocs.cobaltapps.com/article/110-does-dynamik-have-any-special-file-permissions-requirements-or-recommendations" target="_blank"><?php _e( 'THIS KNOWLEDGEABLE ARTICLE', 'dynamik' ); ?></a> <?php _e( 'for a possible solution.', 'dynamik' ); ?></strong></div>
<?php		}
		}
?>		
		<div class="dynamik-optionbox-outer-2col">
			<div class="dynamik-optionbox-inner-2col">
				<h4><?php _e( 'Dynamik General Information', 'dynamik' ); ?></h4>
				<div id="readme-box">
					<h5><?php _e( 'Using The Dynamik [?]Tooltips', 'dynamik' ); ?></h5>
					
					<p style="margin-top:-15px;">
						<?php _e( 'Throughout the entire Dynamik admin interface are [?]Tooltips that link to appropriate knowledge base articles to help clarify and explain how the various options and features work. So if you find an option or setting to be unclear, chances are the nearest Tooltip will provide explanation.', 'dynamik' ); ?>
					</p>
				</div>
			</div>
		</div>

		<div class="dynamik-optionbox-outer-2col">
			<div class="dynamik-optionbox-inner-2col">
				<h4><?php _e( 'Version Information', 'dynamik' ); ?></h4>
				<div class="bg-box">
					<p>
						<?php _e( 'PHP Version:', 'dynamik' ); ?> <b><code><?php echo PHP_VERSION ?></code></b>
					</p>
					
					<p>
						<?php _e( 'WordPress Version:', 'dynamik' ); ?> <b><code><?php echo bloginfo('version') ?></code></b>
					</p>

					<p>
						<?php _e( 'Genesis Version:', 'dynamik' ); ?> <b><code><?php echo esc_attr( PARENT_THEME_VERSION ) ?></code></b>
					</p>
					
					<p>
						<?php _e( 'Dynamik Version:', 'dynamik' ); ?> <b><code><?php echo esc_attr( CHILD_THEME_VERSION ) ?></code></b>
					</p>
					<?php if( dynamik_get_design( 'font_awesome_css' ) ) { ?>
						<p>
							<?php _e( 'Font Awesome Version:', 'dynamik' ); ?> <b><code><?php echo esc_attr( DYN_FONT_AWESOME_VERSION ) ?></code></b>
						</p>
					<?php } ?>
				</div>
			</div>
		</div>
	
	</div>

	<div class="dynamik-optionbox-2col-right-wrap">
	
		<div class="dynamik-optionbox-outer-2col">
			<div class="dynamik-optionbox-inner-2col">
				<h4><?php _e( 'Dynamik Links & Resources', 'dynamik' ); ?></h4>
				<div id="resource-box">
					<h5><?php _e( 'Dynamik Docs & Support', 'dynamik' ); ?></h5>
					
					<p style="margin-top:-15px;">
						<?php _e( '1. Check out the knowledge base:', 'dynamik' ); ?>
					</p>
					<p style="margin-top:-5px;">
						<a href="http://dynamikdocs.cobaltapps.com/" target="_blank">http://dynamikdocs.cobaltapps.com/</a>
					</p>

					<p>
						<?php _e( '2. Use the form to email support on the "My Account" page:', 'dynamik' ); ?>
					</p>
					<p style="margin-top:-5px;">
						<a href="http://cobaltapps.com/my-account/" target="_blank">http://cobaltapps.com/my-account/</a>
					</p>
					
					<h5><?php _e( 'Make Money Promoting Dynamik', 'dynamik' ); ?></h5>
					
					<p style="margin-top:-15px;">
						<?php _e( 'Help promote Dynamik and turn a profit by joining our affiliate program:', 'dynamik' ); ?>
					</p>
					<p style="margin-top:-5px;">
						<a href="http://cobaltapps.com/affiliates/" target="_blank">http://cobaltapps.com/affiliates/</a>
					</p>
				</div>
			</div>
		</div>
		
		<?php
		$user = wp_get_current_user();
		if( !get_the_author_meta( 'hide_dynamik_gen_license_key', $user->ID ) )
		{
			?>
			<div class="dynamik-optionbox-outer-2col">
				<div class="dynamik-optionbox-inner-2col">
					<h4><?php _e( 'Dynamik License Activation', 'dynamik' ); ?></h4>
					<div class="bg-box">
						<p>
							<?php _e( 'Manage your Dynamik license in ', 'dynamik' ); ?><b><a href="<?php echo admin_url( 'themes.php?page=dynamik_gen-license' ); ?>"><?php _e( '(Appearance > Dynamik License)', 'dynamik' ); ?></a></b>
						</p>
					</div>
				</div>
			</div>
			<?php
		}
		?>

	</div>
</div>