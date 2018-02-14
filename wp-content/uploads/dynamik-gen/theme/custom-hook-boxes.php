<?php
/**
 * Build and Hook-In Custom Hook Boxes.
 */

/* Name: Header Top */

add_action( 'genesis_before_header', 'dynamik_header_top_hook_box', 10 );
function dynamik_header_top_hook_box() {
	dynamik_header_top_hook_box_content();
}

function dynamik_header_top_hook_box_content() { ?>
<div class="site-header-top">
	<div class="wrap"><?php echo do_shortcode( '[header_top_left][header_top_right]' ); ?></div>
</div>
<?php
}

/* Name: CTA */

add_action( 'genesis_before_footer', 'dynamik_cta_hook_box', 9 );
function dynamik_cta_hook_box() {
	dynamik_cta_hook_box_content();
}

function dynamik_cta_hook_box_content() {
	if ( is_singular('package') ) { ?>
<div class="cta-global">
<?php echo do_shortcode( '[fl_builder_insert_layout slug="cta"]' ); ?>
</div>
	<?php } else {
		return false;
	}
}
