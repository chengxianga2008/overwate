/**
 * This file should contain frontend styles that
 * will be applied to individual module instances.
 *
 * $module An instance of your module class.
 * $id The module's ID.
 * $settings The module's settings.
 */

.fl-node-<?php echo $id; ?> {
    postion: relative;
}
.fl-node-<?php echo $id; ?> .pp-dotnav {
    position: fixed;
    <?php echo $settings->dot_position; ?>: 40px;
    top: 50%;
    bottom: auto;
    -webkit-transform: translateY(-50%);
    -moz-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    -o-transform: translateY(-50%);
    transform: translateY(-50%);
    z-index: 10;
}
.fl-node-<?php echo $id; ?> .pp-dotnav pp-dots {
    margin: 0;
    padding: 0;
}
.fl-node-<?php echo $id; ?> .pp-dotnav .pp-dot {
    list-style-type: none;
    line-height: 0;
    margin: <?php echo $settings->dot_margin; ?>px 0;
    position: relative;
    text-align: <?php echo $settings->dot_position; ?>;
}
.fl-node-<?php echo $id; ?> .pp-dotnav .pp-dot a {
    display: inline-block;
    border: 0;
    outline: 0 !important;
    text-decoration: none;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
}
.fl-node-<?php echo $id; ?> .pp-dotnav .pp-dot a span {
    display: inline-block;
    float: right;
}
.fl-node-<?php echo $id; ?> .pp-dotnav .pp-dot a .pp-dot-circle {
    background-color: <?php echo $settings->dot_color ? '#' . $settings->dot_color : 'transparent'; ?>;
    border: 0;
    border-width: <?php echo $settings->dot_border_width; ?>px;
    border-color: <?php echo $settings->dot_border_color ? '#' . $settings->dot_border_color : 'transparent'; ?>;
    border-style: solid;
    border-radius: 100%;
    position: relative;
    top: 5px;
    height: <?php echo $settings->dot_size; ?>px;
    width: <?php echo $settings->dot_size; ?>px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
.fl-node-<?php echo $id; ?> .pp-dotnav .pp-dot a:hover .pp-dot-circle {
    background-color: <?php echo $settings->dot_color_hover ? '#' . $settings->dot_color_hover : 'transparent'; ?>;
    border-color: <?php echo $settings->dot_border_color_hover ? '#' . $settings->dot_border_color_hover : 'transparent'; ?>;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    -ms-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
.fl-node-<?php echo $id; ?> .pp-dotnav .pp-dot.active .pp-dot-circle {
    background-color: <?php echo $settings->dot_color_active ? '#' . $settings->dot_color_active : 'transparent'; ?>;
    border-color: <?php echo $settings->dot_border_color_active ? '#' . $settings->dot_border_color_active : 'transparent'; ?>;
}
.fl-node-<?php echo $id; ?> .pp-dotnav .pp-dot .pp-label {
    opacity: 0;
    background-color: <?php echo $settings->dot_label_color ? '#' . $settings->dot_label_color : 'transparent'; ?>;
    color: #<?php echo $settings->dot_label_text ? $settings->dot_label_text : 'ffffff'; ?>;
    border-radius: 2px;
    font-size: 13px;
    line-height: 1;
    margin-<?php echo $settings->dot_position; ?>: 10px;
    padding: .4em .5em;
    display: inline-block;
    position: relative;
    -webkit-transition: opacity 0.3s ease, visibility 0.3s ease;
    -moz-transition: opacity 0.3s ease, visibility 0.3s ease;
    -ms-transition: opacity 0.3s ease, visibility 0.3s ease;
    transition: opacity 0.3s ease, visibility 0.3s ease;
}
.fl-node-<?php echo $id; ?> .pp-dotnav .pp-dot .pp-label:after {
    content: "";
    display: block;
    border-top: 5px solid transparent;
    border-bottom: 5px solid transparent;
    border-<?php echo ('right' == $settings->dot_position) ? 'left' : 'right'; ?>: 5px solid <?php echo $settings->dot_label_color ? '#' . $settings->dot_label_color : 'transparent'; ?>;
    margin-top: -5px;
    position: absolute;
    top: 50%;
    <?php echo $settings->dot_position; ?>: -5px;
}
.fl-node-<?php echo $id; ?> .pp-dotnav .pp-dot a:hover .pp-label {
    opacity: 1;
    -webkit-transition: opacity 0.3s ease;
    -moz-transition: opacity 0.3s ease;
    -ms-transition: opacity 0.3s ease;
    transition: opacity 0.3s ease;
}

@media only screen and (max-width: <?php echo $settings->dot_hide_on; ?>px) {
    .fl-node-<?php echo $id; ?> .pp-dotnav {
        display: none;
    }
}
