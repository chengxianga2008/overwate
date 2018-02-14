<?php
/*
 * Plugin Name: Contact Form 7 - Post Fields
 * Description: Provides a dynamic post select, radio and checkbox field to your CF7 forms.
 * Version:     2.0
 * Author:      Markus Froehlich
 * Author URI:  mailto:markusfroehlich01@gmail.com
 * Requires at least: 4.0
 * Tested up to: 4.9.2
 * Text Domain: cf7-post-fields
 * Domain Path: /languages/
 * License:     GPL v2 or later
 */

/**
 * Contact Form 7 - Post Fields provides a dynamic post select, radio and checkbox field to your CF7 forms.
 *
 * LICENSE
 * This file is part of Contact Form 7 - Post Fields.
 *
 * Contact Form 7 - Post Fields is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * @package    Contact Form 7 - Post Fields
 * @author     Markus Fröhlich <markusfroehlich01@gmail.com>
 * @copyright  Copyright 2016 Markus Fröhlich
 * @license    http://www.gnu.org/licenses/gpl.txt GPL 2.0
 * @link       https://wordpress.org/plugins/cf7-post-fields/
 * @since      0.2
 */

if(!defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if(!class_exists('wpcf7_post_fields') )
{
    class wpcf7_post_fields
    {
        /*
         *  Constructor
         */
        public function __construct()
        {
            $this->includes();

            // Hooks
            add_action('plugins_loaded', array($this, 'load_plugin_textdomain'));
            add_action('wpcf7_init', array($this, 'wpcf7_add_post_image_size'));

            $required_plugin = new wpcf7_required_plugin_checker(__FILE__, 'contact-form-7/wp-contact-form-7.php');

            // Check if Contact Form 7 is activated
            if($required_plugin->is_active())
            {
                // Ajax Requests
                add_action('wp_ajax_wpcf7_post_fields_get_taxonomies', array($this, 'get_ajax_post_taxonomies'));

                // Load Post Field modules
                add_action('plugins_loaded', array($this, 'load_wpcf7_post_field_modules'), 50);

                add_filter('wpcf7_mail_components', array($this, 'wpcf7_post_field_components'), 10, 3);
            }
        }

        /**
         * Include external modules
         */
        private function includes()
        {
            require_once dirname(__FILE__).'/includes/class-required-plugin-checker.php';
            require_once dirname(__FILE__).'/modules/module.php';
            require_once dirname(__FILE__).'/modules/select.php';
            require_once dirname(__FILE__).'/modules/image-select.php';
            require_once dirname(__FILE__).'/modules/checkbox.php';
            require_once dirname(__FILE__).'/modules/image-checkbox.php';
        }

        /*
         * HOOK
         * Initialize the textdomain
         */
        public function load_plugin_textdomain()
        {
            load_plugin_textdomain('cf7-post-fields', false, plugin_basename( dirname(__FILE__) ) . '/languages' );
        }

        /**
         * Register the post image field size.
         */
        public function wpcf7_add_post_image_size()
        {
            add_image_size('wpcf7-post-image', 80, 80, true);
        }

        /*
         * HOOK
         * Load the post field modules
         */
        public function load_wpcf7_post_field_modules()
        {
            new wpcf7_post_fields_select();
            new wpcf7_post_fields_checkbox();
            new wpcf7_post_fields_image_select(__FILE__);
            new wpcf7_post_fields_image_checkbox(__FILE__);
        }

        /*
         * Ajax Request
         * Get the taxonomies from a specific post type
         */
        public function get_ajax_post_taxonomies()
        {
            if(!wp_verify_nonce($_POST['security'], 'wpcf7-post-field-tax-nonce')) {
                wp_send_json_error(__('An error has occurred. Please reload the page and try again.'));
            }

            $post_type = sanitize_text_field($_POST['post_type']);
            $object_taxonomies = get_object_taxonomies($post_type, 'object');
            $taxonomies = wp_list_pluck($object_taxonomies, 'label', 'name');

            wp_send_json_success($taxonomies);
        }

        /*
         * Filter the body mail content
         */
        public function wpcf7_post_field_components($components, $form, $instance)
        {
            $properties = $form->get_properties();
            $email_name = $instance->name();

            $components['body'] = $this->replace_permalink_tags($components['body'], $properties[$email_name]['use_html']);

            return $components;
        }

        /*
         * Replace all permalink tags with (pretty) links
         */
        private function replace_permalink_tags($content, $pretty)
        {
            if(strpos($content, '[permalink') === false) {
                return $content;
            }

            // Find all registered tag names in $content.
            preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches);

            foreach($matches[1] as $match)
            {
                if(strpos($match, 'permalink') !== false)
                {
                    $post_id = absint(filter_var($match, FILTER_SANITIZE_NUMBER_INT));

                    if(get_post_status($post_id) !== false)
                    {
                        $permalink = $pretty ? sprintf('<a href="%1$s" target="_blank" title="%2$s">%2$s</a>', get_permalink($post_id), get_the_title($post_id)) : get_permalink($post_id);
                        $replace_tag = '[permalink-'.$post_id.']';

                        $content = str_replace($replace_tag, $permalink, $content);
                    }
                }
            }

            return $content;
        }
    }

    new wpcf7_post_fields;
}