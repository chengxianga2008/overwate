<?php

// UPLOAD ENGINE
function be_load_wp_media_files() {
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'be_load_wp_media_files' );

?>