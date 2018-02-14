<?php
/*
 * The base class from the modules
 * Author: Markus Froehlich
 */
if(!defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if(!class_exists('wpcf7_post_fields_module') )
{
    class wpcf7_post_fields_module
    {
        /*
         * Data Fields
         */
        protected $label_tags = array('%title%', '%date%', '%time%', '%excerpt%', '%slug%', '%author%', '%permalink%','%id%');
        protected $meta_tags  = array('title', 'date', 'time', 'slug', 'author', 'permalink', 'id');
        protected $post_status = array('publish', 'pending', 'draft', 'future');

        /*
         * Get Post Values
         */
        protected function get_post_values($tag)
        {
            /*
             * Post Variables from the Field
             */
            $args = array(
                'label'             => (string) reset( $tag->values ),
                'post_type'         => $tag->get_option('post-type', '', true),
                'tax_relation'      => $tag->get_option('category-relation', '', true),
                'value_field'       => $tag->get_option('value-field', '', true),
                'orderby'           => $tag->get_option('orderby', '', true),
                'order'             => $tag->get_option('order', '', true),
                'posts_per_page'    => $tag->get_option('posts-number', 'int', true)
            );

            $field_post_data = array(
                'ids'       => array(),
                'labels'    => array(),
                'values'    => array()
            );

            // Arguments to retrieve posts
            $post_args = array();

            // Set the post type
            $post_args['post_type'] = post_type_exists($args['post_type']) ? $args['post_type'] : 'post';

            // Set the number of posts
            $post_args['posts_per_page'] = is_numeric($args['posts_per_page']) ? absint($args['posts_per_page']) : -1;

            // Set post_status to WP Query
            foreach($this->post_status as $status) {
                if($tag->has_option($status)) {
                    $post_args['post_status'][] = $status;
                }
            }

            // Get taxonomies from post type
            $taxonomie_names = get_object_taxonomies($args['post_type'], 'names');

            if(count($taxonomie_names) > 0)
            {
                $tax_queries = array();
                foreach($taxonomie_names as $taxonomy)
                {
                    // Term slugs from the field
                    $term_slugs = $tag->get_option($taxonomy, '', true);

                    // Term slugs found
                    if($term_slugs !== false)
                    {
                        $term_slug_array = explode('|', $term_slugs);

                        $tax_queries[] = array(
                            'taxonomy' => $taxonomy,
                            'field'    => 'slug',
                            'terms'    => array_map('trim', $term_slug_array)
                        );
                    }
                }

                // Set tax_query to WP Query
                if(count($tax_queries) > 0)
                {
                    $post_args['tax_query']['relation'] = ($args['tax_relation'] === 'AND') ? 'AND' : 'OR';
                    $post_args['tax_query'] = $tax_queries;
                }
            }

            // Set orderby to WP Query
            if($args['orderby'] !== false)
            {
                $post_args['orderby'] = $args['orderby'];
                $post_args['order'] = ($args['order'] === 'DESC') ? 'DESC' : 'ASC';
            }

            // WPML Integration
            if(defined( 'ICL_SITEPRESS_VERSION' )) {
                $post_args['suppress_filters'] = false;
            }

            // Field-Filter for custom WP Query
            $post_args = apply_filters('wpcf7_'.$tag->name.'_get_posts', $post_args, $tag, $args);

            // Get all posts from Post Type
            $select_posts = get_posts($post_args);

            foreach ($select_posts as $post)
            {
                $field_post_data['ids'][] = $post->ID;
                $field_post_data['labels'][]   = $args['label'] ? $this->replace_label_tags($args['label'], $post) : $post->post_title;

                // Set the value Field
                switch ($args['value_field'])
                {
                    case 'title':
                        $field_post_data['values'][] = $post->post_title;
                        break;
                    case 'slug':
                        $field_post_data['values'][] = $post->post_name;
                        break;
                    case 'permalink':
                        $field_post_data['values'][] = sprintf('[permalink-%s]', $post->ID);
                        break;
                    case 'id':
                        $field_post_data['values'][] = $post->ID;
                        break;
                    default:
                        $field_post_data['values'][] = $post->post_title;
                        break;
                }
            }

            wp_reset_query();

            return $field_post_data;
        }

        /*
         * Replace post attributes and meta_key  tags from the label string
         */
        private function replace_label_tags($label, $post)
        {
            $author_display_name = get_the_author_meta('display_name', $post->post_author);
            $permalink = get_the_permalink($post->ID);

            // Get the default post attributes
            $default_post_atts = array(
                $post->post_title,              // %title%
                get_the_date('',  $post),       // %date%
                get_the_time('',  $post),       // %time%
                $post->post_excerpt,            // %excerpt%
                $post->post_name,               // %slug%
                $author_display_name,           // %author%
                $permalink,                     // %permalink%
                $post->ID                       // %id%
            );

            // Replace all default post tags in the field label
            $new_label = str_replace($this->label_tags, $default_post_atts, $label);

            // There are still label tags available
            if(substr_count($new_label, '%') >= 2)
            {
                // Get all meta keys from the current post
                $all_meta_keys = get_post_custom_keys($post->ID);

                // Loop all post meta keys
                foreach($all_meta_keys as $meta_key)
                {
                    $meta_key_tag = '%'.$meta_key.'%';

                    // Search for a post meta keys in the field label
                    if(strpos($new_label, $meta_key_tag) !== false)
                    {
                        $meta_value = get_post_meta($post->ID, $meta_key, true);

                        // Check if meta value is sequential array
                        if(is_array($meta_value) && count($meta_value) > 0)
                        {
                            // Check if the array is assoc
                            $is_assoc_array = array_keys($meta_value) !== range(0, count($meta_value) - 1);

                            // Change the array meta value in a string list
                            $meta_value = !$is_assoc_array ? implode(', ', $meta_value) : '';
                        }

                        // Replace the post meta keys in the field label
                        $new_label = str_replace($meta_key_tag, $meta_value, $new_label);
                    }
                }
            }

            return $new_label;
        }

        /*
         * Replace post attributes and meta_key  tags from the label string
         */
        protected function get_replace_meta_tags($meta_string, $post)
        {
            $meta_data_array = array();

            if(!is_string($meta_string) && !empty($meta_string)) {
                return $meta_data_array;
            }

            $i = 0;
            foreach(explode('|', $meta_string) as $meta_data)
            {
                switch($meta_data)
                {
                    case 'title':
                       $meta_data_array[$i] = $post->post_title;
                        break;
                    case 'date':
                        $meta_data_array[$i] = get_the_date('',  $post);
                        break;
                    case 'time':
                        $meta_data_array[$i] = get_the_time('',  $post);
                        break;
                    case 'slug':
                        $meta_data_array[$i] = $post->post_name;
                        break;
                    case 'author':
                        $meta_data_array[$i] = get_the_author_meta('display_name', $post->post_author);
                        break;
                    case 'permalink':
                        $meta_data_array[$i] = get_the_permalink($post->ID);
                        break;
                    case 'id':
                        $meta_data_array[$i] = $post->ID;
                        break;
                    default:
                        // Loop all post meta keys
                        foreach(get_post_custom_keys($post->ID) as $meta_key)
                        {
                            // Search for a post meta keys in the field label
                            if(strpos($meta_data, $meta_key) !== false)
                            {
                                $meta_value = get_post_meta($post->ID, $meta_key, true);

                                // Check if meta value is sequential array
                                if(is_array($meta_value) && count($meta_value) > 0)
                                {
                                    // Check if the array is assoc
                                    $is_assoc_array = array_keys($meta_value) !== range(0, count($meta_value) - 1);

                                    // Change the array meta value in a string list
                                    $meta_value = !$is_assoc_array ? implode(', ', $meta_value) : '';
                                }

                                if(!empty($meta_value)) {
                                    $meta_data_array[$i] = $meta_value;
                                }
                            }
                        }
                        break;
                }

                $i++;
            }

            return $meta_data_array;
        }

        /*
         * Template for the Post Field Selection in the Table
         */
        public function get_post_generator_template($args)
        {
            ?>
            <tr>
                <th scope="row"><?php echo esc_html( __( 'Post type', 'cf7-post-fields' ) ); ?></th>
                <td id="<?php echo esc_attr( $args['content'] . '-post-type' ); ?>">
                    <?php
                        $first_post_type = '';
                        foreach(get_post_types(array('public' => true), 'objects') as $post_type)
                        {
                            if(empty($first_post_type)) {
                                $first_post_type = $post_type->name;
                            }

                            $count_posts = wp_count_posts($post_type->name);
                            $label = '<b>'.$post_type->label.'</b> ('.__('Published').': '.$count_posts->publish.')';

                            echo '
                                <label>
                                    <input type="radio" name="post-type" class="option" value="'.$post_type->name.'" '.checked('post', $post_type->name, false).'>'.$label.'
                                </label>
                                <br>';
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <th scope="row"><?php echo esc_html( _x( 'Post', 'post type singular name' ).' '.__( 'Categories' ) ); ?></th>
                <td>
                    <fieldset id="<?php echo esc_attr( $args['content'] . '-post-taxonomies' ); ?>">
                        <?php
                        if(!empty($first_post_type))
                        {
                            $object_taxonomies = get_object_taxonomies($first_post_type, 'object');

                            if(count($object_taxonomies) > 0)
                            {
                                foreach($object_taxonomies as $taxonomy) {
                                    echo '<input type="text" value="" class="oneline option" name="'.$taxonomy->name.'" placeholder="'.$taxonomy->label.'"><br>';
                                }

                                _e('Relationship').':';
                                ?>
                                <label><input type="radio" name="category-relation" class="option" value="OR" checked /><?php echo esc_html( __('OR') ); ?></label>
                                <label><input type="radio" name="category-relation" class="option" value="AND" /><?php echo esc_html( __('AND') ); ?></label>
                                <?php
                            }
                            else
                            {
                                _e('No categories found.');
                            }
                        }
                        ?>
                    </fieldset>
                    <span class="description">
                        <?php _e('Use pipe-separated term slugs (e.g. united-states|germany|austria) per field.', 'cf7-post-fields'); ?>
                    </span>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-label' ); ?>"><?php echo esc_html( __( 'Label format', 'cf7-post-fields' ) ); ?></label></th>
                <td>
                    <input type="text" name="values" value="%title%" class="oneline" id="<?php echo esc_attr( $args['content'] . '-label' ); ?>" />
                    <br>
                    <span class="description">
                        <?php echo __('Attributes').': <code>'.implode('</code> <code>', $this->label_tags).'</code> <code>%meta_key%</code>'; ?>
                    </span>
                </td>
            </tr>

            <tr>
                <th scope="row"><?php echo esc_html( __( 'Value field', 'cf7-post-fields' ) ); ?></th>
                <td>
                    <label><input type="radio" name="value-field" class="option" value="title" checked /><?php echo esc_html( __('Title') ); ?></label>
                    <label><input type="radio" name="value-field" class="option" value="slug" /><?php echo esc_html( __('Slug') ); ?></label>
                    <label><input type="radio" name="value-field" class="option" value="permalink" /><?php echo esc_html( __('Permalink', 'cf7-post-fields') ); ?></label>
                    <label><input type="radio" name="value-field" class="option" value="id" /><?php echo esc_html( __('ID') ); ?></label>
                </td>
            </tr>

            <tr>
                <th scope="row"><?php echo esc_html( __( 'Status' ) ); ?></th>
                <td>
                    <label><input type="checkbox" name="publish" class="option" checked /><?php echo esc_html( _x( 'Published', 'post status' ) ); ?></label>
                    <label><input type="checkbox" name="pending" class="option" /><?php echo esc_html( _x( 'Pending', 'post status' ) ); ?></label>
                    <label><input type="checkbox" name="draft" class="option" /><?php echo esc_html( _x( 'Draft', 'post status' ) ); ?></label>
                    <label><input type="checkbox" name="future" class="option" /><?php echo esc_html( _x( 'Scheduled', 'post status' ) ); ?></label>
                </td>
            </tr>

            <tr>
                <th scope="row"><?php echo esc_html( __( 'Sort order', 'cf7-post-fields' ) ); ?></th>
                <td>
                    <label><input type="radio" name="orderby" class="option" value="title" checked /><?php echo esc_html( __('Title') ); ?></label><br>
                    <label><input type="radio" name="orderby" class="option" value="date" /><?php echo esc_html( __('Date/Time') ); ?></label><br>
                    <label><input type="radio" name="orderby" class="option" value="author" /><?php echo esc_html(__('Author') ); ?></label><br>
                    <label><input type="radio" name="orderby" class="option" value="rand" /><?php echo esc_html( __('Random') ); ?></label><br>
                    <label><input type="radio" name="orderby" class="option" value="menu_order" /><?php echo esc_html( __('Menu order') ); ?></label><br>
                    <label><input type="radio" name="orderby" class="option" value="none" /><?php echo esc_html( __('None') ); ?></label>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-order' ); ?>"><?php echo esc_html( __( 'Order' ) ); ?></label></th>
                <td>
                    <label><input type="radio" name="order" class="option" value="DESC" checked /><?php echo esc_html( __('Descending') ); ?></label>
                    <label><input type="radio" name="order" class="option" value="ASC" /><?php echo esc_html(__('Ascending') ); ?></label>
                </td>
            </tr>

            <tr>
                <th scope="row"><label for="<?php echo esc_attr( $args['content'] . '-posts-number' ); ?>"><?php echo esc_html( __( 'Number of posts', 'cf7-post-fields' ) ); ?></label></th>
                <td>
                    <input type="number" name="posts-number" value="-1" step="1" min="-1" max="500" class="oneline option" id="<?php echo esc_attr( $args['content'] . '-posts-number' ); ?>" />
                    <br>
                    <span class="description">
                        <?php echo _e('The number of posts to show in the field. Use -1 to show all posts.', 'cf7-post-fields'); ?>
                    </span>
                </td>
            </tr>
            <?php
        }

        /*
         * Javascript for the Post Field Selection in the Table
         */
        protected function enqueue_post_field_javascript($args)
        {
            ?>
            <script type="text/javascript">
                jQuery(function($) {

                    $('#<?php echo esc_attr( $args['content'] . '-post-type' ); ?> input[type=radio][name=post-type]').change(function() {

                        var post_type = $(this).val();

                        var tg_name_field = $('#<?php echo esc_attr( $args['content'] . '-name' ); ?>');
                        var tg_tax_fieldset = $('#<?php echo esc_attr( $args['content'] . '-post-taxonomies' ); ?>');

                        // Empty taxonomy fieldset
                        tg_tax_fieldset.empty();

                        // Trigger the change event
                        tg_name_field.trigger('change');

                        // Show loader
                        tg_tax_fieldset.html('<span class="spinner is-active" style="float:none;"></span>');

                        // Ajax request to get all taxonomies from a post type
                        $.ajax({
                            url: '<?php echo admin_url('admin-ajax.php'); ?>',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                action: 'wpcf7_post_fields_get_taxonomies',
                                security : '<?php echo wp_create_nonce('wpcf7-post-field-tax-nonce'); ?>',
                                post_type: post_type
                            },
                            success: function(result) {
                                tg_tax_fieldset.empty();

                                if(result.success == true) {
                                    var count_tax = 0;
                                    $.each( result.data, function( key, value ) {

                                        var tax_field = $("<input type='text' value=''>").attr("class", "oneline option").attr("name", key).attr("placeholder", value);

                                        // Append the text field to the taxonomy fieldset
                                        tg_tax_fieldset.append(tax_field).append('<br />');

                                        // Hack to trigger the change event from the contact form 7 base
                                        tax_field.change(function() {
                                            tg_name_field.trigger('change');
                                        });

                                        count_tax++;
                                    });

                                    // Categories found
                                    if(count_tax > 0) {
                                        // Add Relationship radios
                                        tg_tax_fieldset.append('<?php echo __('Relationship').': '; ?>');
                                        tg_tax_fieldset.append($('<label>').append($("<input type='radio'>").attr("name", "category-relation").attr("class", "option").attr("value", 'OR').attr("checked", 'checked')).append('OR'));
                                        tg_tax_fieldset.append('&nbsp;');
                                        tg_tax_fieldset.append($('<label>').append($("<input type='radio'>").attr("name", "category-relation").attr("class", "option").attr("value", 'AND')).append('AND'));

                                        // Register the change event
                                        tg_tax_fieldset.find("input[name='category-relation']").change(function() {
                                            tg_name_field.trigger('change');
                                        });

                                        // Trigger the change event now to set the category-relation
                                        tg_name_field.trigger('change');
                                    }
                                    else {
                                        tg_tax_fieldset.html('<?php  _e('No categories found.'); ?>');
                                    }
                                } else {
                                    alert(response.data);
                                }
                            },
                            error: function() {
                                tg_tax_fieldset.html('<?php  _e('An unknown error occurred'); ?>');
                            }
                        });
                    });
                });
            </script>
            <?php
        }

        /*
         * Sanitize the image size and return the correct value
         */
        protected function sanitize_image_size($image_size, $default = 'wpcf7-post-image')
        {
            if($image_size === false) {
                return $default;
            }

            // Check if the size is valid
            if(in_array($image_size, get_intermediate_image_sizes())) {
                return $image_size;
            }

            // Check if the size has a width and height
            if(strpos($image_size, 'x') !== false)
            {
                $sizes = explode('x', $image_size, 2);
                $width = absint($sizes[0]);
                $height = absint($sizes[1]);

                if(is_numeric($width) && $width > 0 && is_numeric($height) && $height > 0) {
                     return array($width, $height);
                }
            }

            return $default;
        }

        /*
         * Get the image width from the given image size
         */
        protected function get_image_width($size, $default = 80)
        {
            if(is_array($size) && is_numeric($size[0])) {
                return $size[0];
            }

            $size = $this->get_image_size( $size );

            if (is_array($size) && isset( $size['width'] ) ) {
                return $size['width'];
            }

            return $default;
        }

        /**
         * Get size information for all currently-registered image sizes.
         *
         * @global $_wp_additional_image_sizes
         * @uses   get_intermediate_image_sizes()
         * @return array $sizes Data for all currently-registered image sizes.
         */
        protected function get_image_sizes()
        {
            global $_wp_additional_image_sizes;

            $sizes = array();

            foreach ( get_intermediate_image_sizes() as $_size ) {
                if ( in_array( $_size, array('thumbnail', 'medium', 'medium_large', 'large') ) ) {
                    $sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
                    $sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
                    $sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
                } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
                    $sizes[ $_size ] = array(
                        'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
                        'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                        'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
                    );
                }
            }

            return $sizes;
        }

        /**
         * Get size information for a specific image size.
         *
         * @uses   get_image_sizes()
         * @param  string $size The image size for which to retrieve data.
         * @return bool|array $size Size data about an image size or false if the size doesn't exist.
         */
        protected function get_image_size( $size )
        {
            $sizes = $this->get_image_sizes();

            if ( isset( $sizes[ $size ] ) ) {
                return $sizes[ $size ];
            }

            return false;
        }
    }
}