<?php

/**
 * This file should be used to render each module instance.
 * You have access to two variables in this file:
 *
 * $module An instance of your module class.
 * $settings The module's settings.
 *
 */

$photo    = $module->get_data();
$classes  = $module->get_classes();
$src      = '';
if ( '' != $settings->member_image ) {
$src      = $module->get_src();
}
$link     = $module->get_link();
$alt      = $module->get_alt();
$attrs    = $module->get_attributes();
$filetype = pathinfo($src, PATHINFO_EXTENSION);

?>
<div class="pp-member-wrapper">
    <?php if( '' != $src ) { ?>
        <div class="pp-member-image pp-image-crop-<?php echo $settings->member_image_crop; ?>">
            <?php if( $settings->link_url && $settings->link_target ) { ?>
            <a href="<?php echo $settings->link_url; ?>" target="<?php echo $settings->link_target; ?>">
            <?php } ?>
            <img class="<?php echo $classes; ?>" src="<?php echo $src; ?>" alt="<?php echo $alt; ?>" itemprop="image" <?php echo $attrs; ?> />
            <?php if( $settings->link_url && $settings->link_target ) { ?>
            </a>
            <?php } ?>
        </div>
    <?php } ?>
    <div class="pp-member-content">
        <?php if( $settings->link_url && $settings->link_target ) { ?>
        <a href="<?php echo $settings->link_url; ?>" target="<?php echo $settings->link_target; ?>">
        <?php } ?>
            <<?php echo $settings->title_tag; ?> class="pp-member-name"><?php echo $settings->member_name; ?></<?php echo $settings->title_tag; ?>>
        <?php if( $settings->link_url && $settings->link_target ) { ?>
        </a>
        <?php } ?>
        <?php if( $settings->separator_position == 'below_title' && $settings->separator_display == 'yes' ) { ?>
            <div class="pp-member-separator"></div>
        <?php } ?>
        <div class="pp-member-designation"><?php echo $settings->member_designation; ?></div>
        <?php if( $settings->separator_position == 'below_designation' && $settings->separator_display == 'yes' ) { ?>
            <div class="pp-member-separator"></div>
        <?php } ?>
        <div class="pp-member-description"><?php echo $settings->member_description; ?></div>
        <div class="pp-member-social-icons">
            <ul>
                <?php if ($settings->facebook_url) { ?>
                    <li class="pp-social-fb"><a href="<?php echo $settings->facebook_url; ?>" target="_blank"></a></li>
                <?php } ?>
                <?php if($settings->twiiter_url) { ?>
                    <li class="pp-social-twitter"><a href="<?php echo  $settings->twiiter_url; ?>" target="_blank"></a></li>
                <?php } ?>
                <?php if($settings->googleplus_url) { ?>
                    <li class="pp-social-gplus"><a href="<?php echo $settings->googleplus_url; ?>" target="_blank"></a></li>
                <?php } ?>
                <?php if ($settings->pinterest_url) { ?>
                    <li class="pp-social-pinterest"><a href="<?php echo $settings->pinterest_url; ?>" target="_blank"></a></li>
                <?php } ?>
                <?php if($settings->linkedin_url) { ?>
                    <li class="pp-social-linkedin"><a href="<?php echo $settings->linkedin_url; ?>" target="_blank"></a></li>
                <?php } ?>
                <?php if($settings->youtube_url) { ?>
                    <li class="pp-social-youtube"><a href="<?php echo $settings->youtube_url; ?>" target="_blank"></a></li>
                <?php } ?>
                <?php if($settings->instagram_url) { ?>
                    <li class="pp-social-instagram"><a href="<?php echo $settings->instagram_url; ?>" target="_blank"></a></li>
                <?php } ?>
                <?php if($settings->vimeo_url) { ?>
                    <li class="pp-social-vimeo"><a href="<?php echo $settings->vimeo_url; ?>" target="_blank"></a></li>
                <?php } ?>
                <?php if($settings->github_url) { ?>
                    <li class="pp-social-github"><a href="<?php echo $settings->github_url; ?>" target="_blank"></a></li>
                <?php } ?>
                <?php if($settings->dribbble_url) { ?>
                    <li class="pp-social-dribbble"><a href="<?php echo $settings->dribbble_url; ?>" target="_blank"></a></li>
                <?php } ?>
                <?php if($settings->tumblr_url) { ?>
                    <li class="pp-social-tumblr"><a href="<?php echo $settings->tumblr_url; ?>" target="_blank"></a></li>
                <?php } ?>
                <?php if( $settings->flickr_url) { ?>
                    <li class="pp-social-flickr"><a href="<?php echo $settings->flickr_url; ?>" target="_blank"></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
