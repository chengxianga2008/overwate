<?php

function pp_row_render_js( $extensions ) {

    if ( array_key_exists( 'expandable', $extensions['row'] ) || in_array( 'expandable', $extensions['row'] ) ) {
        add_filter( 'fl_builder_render_js', 'pp_row_expandable_js', 10, 3 );
    }
    if ( array_key_exists( 'downarrow', $extensions['row'] ) || in_array( 'downarrow', $extensions['row'] ) ) {
        add_filter( 'fl_builder_render_js', 'pp_row_downarrow_js', 10, 3 );
    }
}

/**
 * Expandable
 */
function pp_row_expandable_js( $js, $nodes, $global_settings ) {
    foreach ( $nodes['rows'] as $row ) {
        ob_start();

        if ( $row->settings->enable_expandable == 'yes' ) {
        ?>

            ;(function($) {
                var html = '<div class="pp-er pp-er-<?php echo $row->node; ?>"> <div class="pp-er-wrap"> <div class="pp-er-inner"> <div class="pp-er-title-wrap"> <?php if ( "" != $row->settings->er_title ) { ?> <span class="pp-er-title"><?php echo htmlspecialchars( $row->settings->er_title, ENT_QUOTES | ENT_HTML5 ); ?></span> <?php } ?> <span class="pp-er-arrow fa <?php echo $row->settings->er_arrow_weight == 'bold' ? 'fa-chevron-down' : 'fa-angle-down'; ?>"></span> </div> </div> </div> </div>';
                $('.fl-row.fl-node-<?php echo $row->node; ?>').prepend(html);
                <?php if ( ! FLBuilderModel::is_builder_active() ) { ?>
                $('.pp-er-<?php echo $row->node; ?> .pp-er-wrap').on('click', function() {
                    var $this = $(this);
                    $this.parent().addClass('pp-er-open');
                    $this.find('.pp-er-title').html('<?php echo htmlspecialchars( $row->settings->er_title_e, ENT_QUOTES | ENT_HTML5 ); ?>');
                    $(this).parents('.fl-row').find('.fl-row-content-wrap').slideToggle(<?php echo absint($row->settings->er_transition_speed); ?>, function() {
                        if(!$(this).is(':visible')) {
                            $this.parent().removeClass('pp-er-open');
                            $this.find('.pp-er-title').html('<?php echo htmlspecialchars( $row->settings->er_title, ENT_QUOTES | ENT_HTML5 ); ?>');
                        }
                    });
                });
                <?php } ?>
            })(jQuery);

        <?php
        }

        $js .= ob_get_clean();
    }

    return $js;
}

/**
 * Down Arrow
 */
function pp_row_downarrow_js( $js, $nodes, $global_settings ) {
    $count = 0;
    foreach ( $nodes['rows'] as $row ) {
        if ( $count > 0 ) {
            break;
        }
        if ( is_object($row) && isset($row->settings->enable_down_arrow) && 'yes' == $row->settings->enable_down_arrow ) {
            ob_start();
            ?>

            ;(function($) {
            	$('.pp-down-arrow').on('click', function() {
            		var rowSelector = '.fl-node-' + $(this).data('row-id');
            		var nextRow		= $(rowSelector).next();
            		var topOffset	= ( '' === $(this).data('top-offset') ) ? 0 : $(this).data('top-offset');
                    var adminBar    = $('body').hasClass('admin-bar') ? 32 : 0;
            		var trSpeed		= $(this).data('transition-speed');
            		$('html, body').animate({
            			scrollTop: nextRow.offset().top - (topOffset + adminBar)
            		}, trSpeed);
            	});
            })(jQuery);

            <?php

            $js .= ob_get_clean();
            $count++;
        }
    }

    return $js;
}
