<?php

/**
 * Gallery Meta Box Options
 * @param array $args
 * @return array
 * @since 1.0.0
 */
function themify_theme_gallery_meta_box( $args = array() ) {
	extract( $args );
	return array(
		// Layout
		array(
			'name' 		=> 'layout',
			'title' 	=> __('Sidebar Option', 'themify'),
			'description' => '',
			'type' 		=> 'layout',
			'show_title' => true,
			'meta'		=> array(
				array('value' => 'default', 'img' => 'images/layout-icons/default.png', 'title' => __('Default', 'themify')),
				array('value' => 'sidebar1', 'img' => 'images/layout-icons/sidebar1.png', 'title' => __('Sidebar Right', 'themify')),
				array('value' => 'sidebar1 sidebar-left', 'img' => 'images/layout-icons/sidebar1-left.png', 'title' => __('Sidebar Left', 'themify')),
				array('value' => 'sidebar-none', 'img' => 'images/layout-icons/sidebar-none.png', 'selected' => true, 'title' => __('No Sidebar ', 'themify'))
			)
		),
		// Content Width
		array(
			'name'=> 'content_width',
			'title' => __('Content Width', 'themify'),
			'description' => '',
			'type' => 'layout',
			'show_title' => true,
			'meta' => array(
				array(
					'value' => 'default_width',
					'img' => 'themify/img/default.png',
					'selected' => true,
					'title' => __( 'Default', 'themify' )
				),
				array(
					'value' => 'full_width',
					'img' => 'themify/img/fullwidth.png',
					'title' => __( 'Fullwidth', 'themify' )
				)
			)
		),
		// Gallery Shortcode
		array(
			'name' 		=> 'gallery_shortcode',
			'title' 	=> __('Gallery', 'themify'),
			'description' => '',
			'type' 		=> 'gallery_shortcode',
		),
		// Post Image
		array(
			'name' 		=> 'post_image',
			'title' 	=> __('Featured Image', 'themify'),
			'description' => __( 'If Featured Image is not assigned, it will be auto generated from the video URL', 'themify' ),
			'type' 		=> 'image',
			'meta'		=> array(),
		),
		// Featured Image Size
		array(
			'name'	=>	'feature_size',
			'title'	=>	__('Image Size', 'themify'),
			'description' => sprintf(__('Image sizes can be set at <a href="%s">Media Settings</a> and <a href="%s" target="_blank">Regenerated</a>', 'themify'), 'options-media.php', 'https://wordpress.org/plugins/regenerate-thumbnails/'),
			'type'		=>	'featimgdropdown',
			'meta'		=> array(),
		),
		// Multi field: Image Dimension
		themify_image_dimensions_field(),
		// Video URL
		array(
			'name' 		=> 'video_url',
			'title' 	=> __('Video URL', 'themify'),
			'description' => __('Replace Featured Image with a video embed URL such as YouTube or Vimeo video url (<a href="http://themify.me/docs/video-embeds">details</a>).', 'themify'),
			'type' 		=> 'textbox',
			'meta'		=> array(),
		),
		// External Link
		array(
			'name' 		=> 'external_link',
			'title' 		=> __('External Link', 'themify'),
			'description' => __('Link Featured Image and Post Title to external URL', 'themify'),
			'type' 		=> 'textbox',
			'meta'		=> array(),
		),
		// Lightbox Link
		themify_lightbox_link_field(),
		// Custom menu for page
		array(
			'name'        => 'custom_menu',
			'title'       => __( 'Custom Menu', 'themify' ),
			'description' => '',
			'type'        => 'dropdown',
			// extracted from $args
			'meta'        => $args['nav_menus'],
		),
		// Separator
		array(
			'name'        => '_separator_background',
			'title'       => '',
			'description' => '',
			'type'        => 'separator',
			'meta'        => array(
				'html' => '<h4>' . __( 'Header Wrap Background', 'themify' ) . '</h4><hr class="meta_fields_separator"/>'
			),
		),
		// Header Wrap
		array(
			'name'          => 'header_wrap',
			'title'         => __( 'Header Wrap', 'themify' ),
			'description'   => '',
			'type'          => 'radio',
			'show_title'    => true,
			'meta'          => array(
				array(
					'value'    => 'solid',
					'name'     => __( 'Solid Background', 'themify' ),
					'selected' => true
				),
				array(
					'value' => 'transparent',
					'name'  => __( 'Transparent Background', 'themify' )
				),
			),
			'enable_toggle' => true,
		),
		// Background Color
		array(
			'name'        => 'background_color',
			'title'       => __( 'Background', 'themify' ),
			'description' => '',
			'type'        => 'color',
			'meta'        => array( 'default' => null ),
			'toggle'      => 'solid-toggle',
		),
		// Background image
		array(
			'name'        => 'background_image',
			'title'       => '',
			'type'        => 'image',
			'description' => '',
			'meta'        => array(),
			'before'      => '',
			'after'       => '',
			'toggle'      => 'solid-toggle',
		),
		// Background repeat
		array(
			'name'        => 'background_repeat',
			'title'       => __( 'Background Repeat', 'themify' ),
			'description' => '',
			'type'        => 'dropdown',
			'meta'        => array(
				array(
					'value' => 'fullcover',
					'name'  => __( 'Fullcover', 'themify' )
				),
				array(
					'value' => 'repeat',
					'name'  => __( 'Repeat', 'themify' )
				),
				array(
					'value' => 'repeat-x',
					'name'  => __( 'Repeat horizontally', 'themify' )
				),
				array(
					'value' => 'repeat-y',
					'name'  => __( 'Repeat vertically', 'themify' )
				),
			),
			'toggle'      => 'solid-toggle',
		),
	);
}

/**************************************************************************************************
 * Highlight Class - Shortcode
 **************************************************************************************************/

if ( ! class_exists( 'Themify_Gallery' ) ) {

	class Themify_Gallery {

		var $instance = 0;
		var $atts = array();
		var $post_type = 'gallery';
		var $tax = 'gallery-category';
		var $tag = 'gallery-tag';
		var $slideLoader = '<div class="slideshow-slider-loader"><div class="themify-loader"><div class="themify-loader_1 themify-loader_blockG"></div><div class="themify-loader_2 themify-loader_blockG"></div><div class="themify-loader_3 themify-loader_blockG"></div></div></div>';
		var $taxonomies;

		function __construct( $args = array() ) {
			add_filter( 'themify_post_types', array($this, 'extend_post_types' ) );
			add_filter( 'themify_gallery_plugins_args', array($this, 'enable_gallery_area' ) );
			add_filter( 'post_class', array($this, 'remove_cpt_post_class' ), 12 );
			add_filter( 'themify_types_excluded_in_search', array( $this, 'exclude_in_search' ) );

			add_action( 'init', array( $this, 'register' ) );
			add_action( 'admin_init', array( $this, 'manage_and_filter' ) );
			add_action( 'save_post', array($this, 'save_post'), 100, 2 );
			add_action( 'wp_ajax_themify_get_gallery_entry', array($this, 'themify_get_gallery_entry') );
			add_action( 'wp_ajax_nopriv_themify_get_gallery_entry', array($this, 'themify_get_gallery_entry') );

			add_shortcode( 'themify_' . $this->post_type . '_posts', array( $this, 'init_shortcode' ) );
		}

		/**
		 * Initialize gallery content area for fullscreen gallery
		 * @param $args
		 * @return mixed
		 */
		function enable_gallery_area( $args ) {
			$args['contentImagesAreas'] .= ', .type-gallery';
			return $args;
		}

		/**
		 * AJAX hook to return gallery entry
		 */
		function themify_get_gallery_entry() {
			check_ajax_referer( 'ajax_nonce', 'nonce' );

			if ( ! isset( $_POST['entry_id'] ) ) {
				echo json_encode( array(
					'error' => __( 'Entry ID not set', 'themify' ),
				));
				die();
			}

			$entry = get_post( $_POST['entry_id'] );
			setup_postdata( $entry );

			$tax = 'gallery-category';

			$terms = array();

			$raw_terms = get_the_terms( $entry->ID, $tax );

			if ( $raw_terms && ! is_wp_error( $raw_terms ) ) {
				foreach ( $raw_terms as $term ) {
					$terms[] = array(
						'name' => $term->name,
						'link' => get_term_link( $term, $tax )
					);
				}
			}

			echo json_encode( array(
				'title' => apply_filters( 'the_title', $entry->post_title ),
				'date' => apply_filters( 'the_date', mysql2date( 'M j, Y', $entry->post_date ) ),
				'content' => apply_filters( 'the_content', $entry->post_content ),
				'excerpt' => apply_filters( 'the_excerpt', get_the_excerpt() ),
				'link' => get_permalink( $entry->ID ),
				'terms' => $terms,
			));

			die();
		}

		/**
		 * Register post type and taxonomy
		 */
		function register() {
			$cpt = array(
				'plural' => __('Galleries', 'themify'),
				'singular' => __('Gallery', 'themify'),
			);
			register_post_type( $this->post_type, array(
				'labels' => array(
					'name' => $cpt['plural'],
					'singular_name' => $cpt['singular'],
					'add_new' => __( 'Add New', 'themify' ),
					'add_new_item' => __( 'Add New Gallery', 'themify' ),
					'edit_item' => __( 'Edit Gallery', 'themify' ),
					'new_item' => __( 'New Gallery', 'themify' ),
					'view_item' => __( 'View Gallery', 'themify' ),
					'search_items' => __( 'Search Galleries', 'themify' ),
					'not_found' => __( 'No Galleries found', 'themify' ),
					'not_found_in_trash' => __( 'No Galleries found in Trash', 'themify' ),
					'menu_name' => __( 'Galleries', 'themify' ),
				),
				'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'comments'),
				'hierarchical' => false,
				'public' => true,
				'exclude_from_search' => false,
				'query_var' => true,
				'can_export' => true,
				'capability_type' => 'post',
				'menu_icon' => 'dashicons-format-gallery',
			));
			register_taxonomy( $this->tax, array( $this->post_type ), array(
				'labels' => array(
					'name' => sprintf(__( '%s Categories', 'themify' ), $cpt['singular']),
					'singular_name' => sprintf(__( '%s Category', 'themify' ), $cpt['singular'])
				),
				'public' => true,
				'show_in_nav_menus' => true,
				'show_ui' => true,
				'show_tagcloud' => true,
				'hierarchical' => true,
				'rewrite' => true,
				'query_var' => true
			));
			register_taxonomy( $this->tag, array( $this->post_type ), array(
				'labels' => array(
					'name' => __( 'Gallery Tags', 'themify' ),
					'singular_name' => __( 'Gallery Tags', 'themify' ),
				),
				'public' => true,
				'show_in_nav_menus' => true,
				'show_ui' => true,
				'show_tagcloud' => true,
				'hierarchical' => false,
				'rewrite' => true,
				'query_var' => true,
			));
			if ( is_admin() ) {
				add_filter('manage_edit-'.$this->tax.'_columns', array(&$this, 'taxonomy_header'), 10, 2);
				add_filter('manage_'.$this->tax.'_custom_column', array(&$this, 'taxonomy_column_id'), 10, 3);

				add_filter('manage_edit-'.$this->tag.'_columns', array( $this, 'taxonomy_header' ), 10, 2);
				add_filter('manage_'.$this->tag.'_custom_column', array( $this, 'taxonomy_column_id' ), 10, 3);

				add_filter( 'attachment_fields_to_edit', array($this, 'attachment_fields_to_edit'), 10, 2 );
				add_action( 'edit_attachment', array($this, 'attachment_fields_to_save'), 10, 2 );

			}
		}

		function attachment_fields_to_edit( $form_fields, $post ) {

			if ( ! preg_match( '!^image/!', get_post_mime_type( $post->ID ) ) ) {
				return $form_fields;
			}

			$include = get_post_meta( $post->ID, 'themify_gallery_featured', true );

			$name = 'attachments[' . $post->ID . '][themify_gallery_featured]';

			$form_fields['themify_gallery_featured'] = array(
				'label' => __( 'Larger', 'themify' ),
				'input' => 'html',
				'helps' => __('Show larger image in the gallery.', 'themify'),
				'html'  => '<span class="setting"><label for="' . $name . '" class="setting"><input type="checkbox" name="' . $name . '" id="' . $name . '" value="featured" ' . checked( $include, 'featured', false ) . ' />' . '</label></span>',
			);

			return $form_fields;
		}

		function attachment_fields_to_save( $attachment_id ) {
			if( isset( $_REQUEST['attachments'][$attachment_id]['themify_gallery_featured'] ) && preg_match( '!^image/!', get_post_mime_type( $attachment_id ) ) ) {
				update_post_meta($attachment_id, 'themify_gallery_featured', 'featured');
			} else {
				update_post_meta($attachment_id, 'themify_gallery_featured', '');
			}
		}


		/**
		 * Remove custom post type class.
		 * @param $classes
		 * @return mixed
		 */
		function remove_cpt_post_class( $classes ) {
			$classes = array_diff( $classes, array( $this->post_type ) );
			return $classes;
		}

		/**
		 * Show in Themify Settings module to exclude this post type in search results.
		 * @param $types
		 * @return mixed
		 */
		function exclude_in_search( $types ) {
			$types[$this->post_type] = $this->post_type;
			return $types;
		}

		/**
		 * Set default term for custom taxonomy and assign to post
		 * @param number
		 * @param object
		 */
		function save_post( $post_id, $post ) {
			if ( 'publish' === $post->post_status ) {
				$terms = wp_get_post_terms( $post_id, $this->tax );
				if ( empty( $terms ) ) {
					wp_set_object_terms( $post_id, __( 'Uncategorized', 'themify' ), $this->tax );
				}
			}
		}

		/**
		 * Display an additional column in categories list
		 * @since 1.0.0
		 */
		function taxonomy_header($cat_columns) {
			$cat_columns['cat_id'] = 'ID';
			return $cat_columns;
		}
		/**
		 * Display ID in additional column in categories list
		 * @since 1.0.0
		 */
		function taxonomy_column_id($null, $column, $termid) {
			return $termid;
		}

		/**
		 * Includes new post types registered in theme to array of post types managed by Themify
		 * @param array
		 * @return array
		 */
		function extend_post_types( $types ) {
			return array_merge( $types, array( $this->post_type ) );
		}

		/**
		 * Trigger at the end of __construct
		 */
		function manage_and_filter() {
			add_filter( "manage_edit-{$this->post_type}_columns", array( $this, 'type_column_header' ), 10, 2 );
			add_action( "manage_{$this->post_type}_posts_custom_column", array( $this, 'type_column' ), 10, 3 );
			add_action( 'load-edit.php', array( $this, 'filter_load' ) );
			add_filter( 'post_row_actions', array( $this, 'remove_quick_edit' ), 10, 1 );
		}

		/**
		 * Remove quick edit action from entries list in admin
		 * @param $actions
		 * @return mixed
		 */
		function remove_quick_edit( $actions ) {
			global $post;
			if( $post->post_type == $this->post_type )
				unset($actions['inline hide-if-no-js']);
			return $actions;
		}

		/**
		 * Display an additional column in list
		 * @param array
		 * @return array
		 */
		function type_column_header( $columns ) {
			unset( $columns['date'] );
			$columns['icon'] = __('Icon', 'themify');
			return $columns;
		}

		/**
		 * Display shortcode, type, size and color in columns in tiles list
		 * @param string $column key
		 * @param number $post_id
		 * @return string
		 */
		function type_column( $column, $post_id ) {
			switch( $column ) {

				case 'icon' :
					if ( has_post_thumbnail( $post_id ) ) {
						$img = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'thumbnail' );
						if ( isset( $img[0] ) ) {
							$image = '<img src="' . $img[0] . '" width="50" height="50" />';
						}
					} else {
						$image = '';
					}
					if ( ! empty( $image ) ) {
						echo $image;
					}
					break;
			}
		}

		/**
		 * Filter request to sort
		 */
		function filter_load() {
			global $typenow;
			if ( $typenow == $this->post_type ) {
				add_action( current_filter(), array( $this, 'setup_vars' ), 20 );
				add_action( 'restrict_manage_posts', array( $this, 'get_select' ) );
				add_filter( "manage_taxonomies_for_{$this->post_type}_columns", array( $this, 'add_columns' ) );
			}
		}

		/**
		 * Add columns when filtering posts in edit.php
		 */
		public function add_columns( $taxonomies ) {
			return array_merge( $taxonomies, $this->taxonomies );
		}

		/**
		 * Checks if the string begins with - like "-excluded"
		 *
		 * @param string $string String to check
		 *
		 * @return bool
		 */
		function is_negative_string( $string ) {
			return '-' === $string[0];
		}

		/**
		 * Checks if the string does not being with - like "included"
		 *
		 * @param string $string String to check
		 *
		 * @return bool
		 */
		function is_positive_string( $string ) {
			return '-' !== $string[0];
		}

		/**
		 * Parses the arguments given as category to see if they are category IDs or slugs and returns a proper tax_query
		 * @param $category
		 * @param $post_type
		 * @return array
		 */
		function parse_category_args( $category, $post_type ) {
			$tax_query = array();
			if ( 'all' != $category ) {
				$terms = explode(',', $category);
				if( preg_match( '#[a-z]#', $category ) ) {
					$include = array_filter( $terms, array( $this, 'is_positive_string' ) );
					$exclude = array_filter( $terms, array( $this, 'is_negative_string' ) );
					$field = 'slug';
				} else {
					$include = array_filter( $terms, 'themify_is_positive_number' );
					$exclude = array_map( 'themify_make_absolute_number', array_filter( $terms, 'themify_is_negative_number' ) );
					$field = 'id';
				}

				if ( !empty( $include ) && !empty( $exclude ) ) {
					$tax_query = array(
						'relation' => 'AND'
					);
				}
				if ( !empty( $include ) ) {
					$tax_query[] = array(
						'taxonomy' => $post_type . '-category',
						'field'    => $field,
						'terms'    => $include,
					);
				}
				if ( !empty( $exclude ) ) {
					$tax_query[] = array(
						'taxonomy' => $post_type . '-category',
						'field'    => $field,
						'terms'    => $exclude,
						'operator' => 'NOT IN',
					);
				}
			}
			return $tax_query;
		}

		/**
		 * Select form element to filter the post list
		 * @return string HTML
		 */
		public function get_select() {
			$html = '';
			foreach ($this->taxonomies as $tax) {
				$options = sprintf('<option value="">%s %s</option>', __('View All', 'themify'),
				get_taxonomy($tax)->label);
				$class = is_taxonomy_hierarchical($tax) ? ' class="level-0"' : '';
				foreach (get_terms( $tax ) as $taxon) {
					$options .= sprintf('<option %s%s value="%s">%s%s</option>', isset($_GET[$tax]) ? selected($taxon->slug, $_GET[$tax], false) : '', '0' !== $taxon->parent ? ' class="level-1"' : $class, $taxon->slug, '0' !== $taxon->parent ? str_repeat('&nbsp;', 3) : '', "{$taxon->name} ({$taxon->count})");
				}
				$html .= sprintf('<select name="%s" id="%s" class="postform">%s</select>', $tax, $tax, $options);
			}
			return print $html;
		}

		/**
		 * Setup vars when filtering posts in edit.php
		 */
		function setup_vars() {
			$this->post_type =  get_current_screen()->post_type;
			$this->taxonomies = array_diff(get_object_taxonomies($this->post_type), get_taxonomies(array('show_admin_column' => 'false')));
		}

		/**
		 * Returns link wrapped in paragraph either to the post type archive page or a custom location
		 * @param bool|string False does nothing, true goes to archive page, custom string sets custom location
		 * @param string Text to link
		 * @return string
		 */
		function section_link( $more_link = false, $more_text, $post_type ) {
			if ( $more_link ) {
				if ( 'true' == $more_link ) {
					$more_link = get_post_type_archive_link( $post_type );
				}
				return '<p class="more-link-wrap"><a href="' . esc_url( $more_link ) . '" class="more-link">' . $more_text . '</a></p>';
			}
			return '';
		}

		/**
		 * Returns class to add in columns when querying multiple entries
		 * @param string $style Entries layout
		 * @return string $col_class CSS class for column
		 */
		function column_class( $style ) {
			$col_class = '';
			switch ( $style ) {
				case 'grid4':
					$col_class = 'col4-1';
					break;
				case 'grid3':
					$col_class = 'col3-1';
					break;
				case 'grid2':
					$col_class = 'col2-1';
					break;
				default:
					$col_class = '';
					break;
			}
			return $col_class;
		}

		/**
		 * Add shortcode to WP
		 * @param $atts Array shortcode attributes
		 * @return String
		 * @since 1.0.0
		 */
		function init_shortcode( $atts ) {
			$this->instance++;
			$this->atts = array(
				'id' => '',
				'title' => 'yes', // no
				'image' => 'yes', // no
				'post_meta' => 'yes', // no
				'post_date' => 'yes', // no
				'image_w' => '',
				'image_h' => '',
				'display' => 'none', // excerpt, none
				'more_link' => false, // true goes to post type archive, and admits custom link
				'more_text' => __('More &rarr;', 'themify'),
				'limit' => 3,
				'category' => 'all', // integer category ID
				'order' => 'DESC', // ASC
				'orderby' => 'date', // title, rand
				'style' => 'grid3', // grid4, grid2, list-post, slider
				'use_original_dimensions' => 'no', // yes
				'auto' => 4, // autoplay pause length
				'effect' => 'scroll', // transition effect
				'speed' => 500, // transition speed
				'wrap' => 'yes',
				'slider_nav' => 'yes',
				'pager' => 'yes',
			);
			if ( ! isset( $atts['image_w'] ) || '' == $atts['image_w'] ) {
				if ( ! isset( $atts['style'] ) ) {
					$atts['style'] = 'grid3';
				}
				switch ( $atts['style'] ) {
					case 'list-post':
						$this->atts['image_w'] = 1160;
						$this->atts['image_h'] = 665;
						break;
					case 'grid4':
						$this->atts['image_w'] = 260;
						$this->atts['image_h'] = 150;
						break;
					case 'grid3':
					case '':
						$this->atts['image_w'] = 360;
						$this->atts['image_h'] = 205;
						break;
					case 'grid2':
						$this->atts['image_w'] = 560;
						$this->atts['image_h'] = 320;
						break;
					case 'list-large-image':
						$this->atts['image_w'] = 800;
						$this->atts['image_h'] = 460;
						break;
					case 'list-thumb-image':
						$this->atts['image_w'] = 260;
						$this->atts['image_h'] = 150;
						break;
					case 'grid2-thumb':
						$this->atts['image_w'] = 160;
						$this->atts['image_h'] = 95;
						break;
					case 'slider':
						$this->atts['image_w'] = 1280;
						$this->atts['image_h'] = 500;
						break;
				}
			}
			$shortcode_atts = shortcode_atts( $this->atts, $atts );
			return do_shortcode( $this->shortcode( $shortcode_atts, $this->post_type ) );
		}

		/**
		 * Main shortcode rendering
		 * @param array $atts
		 * @param $post_type
		 * @return string|void
		 */
		function shortcode($atts = array(), $post_type) {
			extract($atts);
			// Parameters to get posts
			$args = array(
				'post_type' => $post_type,
				'posts_per_page' => $limit,
				'order' => $order,
				'orderby' => $orderby,
				'suppress_filters' => false
			);
			$args['tax_query'] = $this->parse_category_args($category, $post_type);

			// Defines layout type
			$cpt_layout_class = $this->post_type.'-multiple clearfix type-multiple';
			$multiple = true;

			// Single post type or many single post types
			if( '' != $id ) {
				if(strpos($id, ',')) {
					$ids = explode(',', str_replace(' ', '', $id));
					foreach ($ids as $string_id) {
						$int_ids[] = intval($string_id);
					}
					$args['post__in'] = $int_ids;
					$args['orderby'] = 'post__in';
				} else {
					$args['p'] = intval($id);
					$cpt_layout_class = $this->post_type.'-single';
					$multiple = false;
				}
			}

			// Get posts according to parameters
			$posts = get_posts( apply_filters('themify_'.$post_type.'_shortcode_args', $args) );

			// Collect markup to be returned
			$out = '';

			if ( $posts ) {
				global $themify;
				$themify_save = clone $themify; // save a copy

				// override $themify object
				$themify->hide_title = 'yes' == $title? 'no': 'yes';
				$themify->hide_image = 'yes' == $image? 'no': 'yes';
				$themify->hide_meta = 'yes' == $post_meta? 'no': 'yes';
				$themify->hide_date = 'yes' == $post_date? 'no': 'yes';
				$themify->hide_meta_category = 'no';
				$themify->hide_meta_tag = 'no';
				$themify->hide_meta_author = 'yes';
				if ( ! $multiple ) {
					if( '' == $image_w || get_post_meta($args['p'], 'image_width', true ) ) {
						$themify->width = get_post_meta($args['p'], 'image_width', true );
					}
					if( '' == $image_h || get_post_meta($args['p'], 'image_height', true ) ) {
						$themify->height = get_post_meta($args['p'], 'image_height', true );
					}
				} else {
					$themify->width = $image_w;
					$themify->height = $image_h;
				}
				$themify->use_original_dimensions = 'yes' == $use_original_dimensions? 'yes': 'no';
				$themify->display_content = $display;
				$themify->more_link = $more_link;
				$themify->more_text = $more_text;
				$themify->post_layout = $style;
				$themify->col_class = $this->column_class( $style );
				$themify->media_position = themify_check( 'setting-default_media_position' )? themify_get( 'setting-default_media_position' ) : 'above';

				$themify->show_post_media = true;
				$themify->is_shortcode = true;

				// SHORTCODE RENDERING

				$loop = themify_get_shortcode_template($posts, 'includes/loop-' . $post_type, 'index');

				if ( false !== stripos( $style, 'slider' ) ) {
					$loop = sprintf('%s<div class="slideshow-wrap"><div class="slideshow" data-id="%s-slider-%s" data-autoplay="%s" data-effect="%s" data-speed="%s" data-wrap="%s" data-slidernav="yes" data-pager="yes">',
						$this->slideLoader,
						$post_type,
						$this->instance,
						is_numeric( $auto ) ? $auto * 1000 : $auto,
						$effect,
						$speed,
						$wrap,
						$slider_nav,
						$pager
					) . $loop . '</div></div>';
				}

				$out = "<div id='$post_type-slider-$this->instance' class='loops-wrapper shortcode $post_type $style $cpt_layout_class'>$loop</div>" . $this->section_link( $more_link, $more_text, $post_type );

				// END SHORTCODE RENDERING

				$themify = clone $themify_save; // revert to original $themify state
			}
			return $out;
		}

		/**
		 * Extract image IDs from gallery shortcode and try to return them as entries list
		 * @param string $field
		 * @return array|bool
		 * @since 1.0.0
		 */
		function get_gallery_images( $field = 'gallery_shortcode' ) {
			$gallery_shortcode = themify_get( $field );
			$image_ids = preg_replace( '#\[gallery(.*)ids="([0-9|,]*)"(.*)\]#i', '$2', $gallery_shortcode );

			$query_args = array(
				'post__in' => explode( ',', str_replace( ' ', '', $image_ids ) ),
				'post_type' => 'attachment',
				'post_mime_type' => 'image',
				'numberposts' => -1,
				'orderby' => stripos( $gallery_shortcode, 'rand' ) ? 'rand': 'post__in',
				'order' => 'ASC'
			);
			$entries = get_posts( apply_filters( 'themify_theme_get_gallery_images', $query_args ) );

			if ( $entries ) {
				return $entries;
			}

			return false;
		}

		/**
		 * Extract number of columns from gallery shortcode
		 * @param string $field
		 * @return array|bool
		 * @since 1.0.0
		 */
		function get_gallery_columns( $field = 'gallery_shortcode' ) {
			$columns = preg_replace( '#\[gallery(.*)columns="([1-9]*)"(.*)\]#i', '$2', themify_get( $field ) );
			if ( ctype_digit($columns) ) {
				return $columns;
			}
			return 3;
		}

		/**
		 * Return gallery post type entries
		 * @param string $field
		 * @return array|bool
		 * @since 1.0.0
		 */
		function get_gallery_posts( $field = 'gallery_posts' ) {
			$query_term = themify_get( $field );
			$query_args = array(
				'post_type' => 'gallery',
				'posts_per_page' => 15,
			);
			if ( '0' != $query_term ) {
				$query_args['tax_query'] = array(
					array(
						'taxonomy' => 'gallery-category',
						'field' => 'slug',
						'terms' => $query_term
					)
				);
			}
			$entries = get_posts( apply_filters( 'themify_theme_get_gallery_posts', $query_args ) );

			if ( $entries ) {
				return $entries;
			}

			return false;
		}

		/**
		 * Returns an image for a slider
		 * @param int $attachment_id Image attachment ID
		 * @param int $width Width of the returned image
		 * @param int $height Height of the returned image
		 * @param string $size Size of the returned image
		 * @return string
		 * @since 1.0.0
		 */
		function get_gallery_image($attachment_id, $width, $height, $size = 'large') {
			$size = apply_filters( 'themify_gallery_slider_image_size', $size );
			if ( themify_check( 'setting-img_settings_use' ) ) {
				// Image Script is disabled, use WP image
				$html = wp_get_attachment_image( $attachment_id, $size, array( 'class' => 'post-image' ) );
			} else {
				// Image Script is enabled, use it to process image
				$img = wp_get_attachment_image_src($attachment_id, $size);
				$html = themify_get_image('ignore=true&src='.$img[0].'&w='.$width.'&h='.$height.'&class=post-image');
			}
			return apply_filters( 'themify_gallery_slider_image_html', $html, $attachment_id, $width, $height, $size );
		}

		/**
		 * Checks if there's a description and returns it, otherwise returns caption
		 * @param $image
		 * @return mixed
		 */
		function get_description( $image ) {
			if ( '' != $image->post_content ) {
				return $image->post_content;
			}
			return $image->post_excerpt;
		}

		/**
		 * Checks if there's a caption and returns it, otherwise returns description
		 * @param $image
		 * @return mixed
		 */
		function get_caption( $image ) {
			if ( '' != $image->post_excerpt ) {
				return $image->post_excerpt;
			}
			return $image->post_content;
		}

		/**
		 * Return slider parameters
		 * @param $post_id
		 * @return mixed
		 */
		function get_slider_params( $post_id ) {
			if ( $temp = get_post_meta( get_the_ID(), 'gallery_autoplay', true ) ) {
				$params['autoplay'] = $temp;
			} else {
				$params['autoplay'] = '4000';
			}
			if ( $temp = get_post_meta( get_the_ID(), 'gallery_transition', true ) ) {
				$params['transition'] = $temp;
			} else {
				$params['transition'] = '300';
			}
			if ( 'best-fit' == get_post_meta( $post_id, 'gallery_stretch', true ) ) {
				$params['bgmode'] = 'best-fit';
			} else {
				$params['bgmode'] = 'cover';
			}
			return $params;
		}
	}
}

/**************************************************************************************************
 * Initialize Type Class
 **************************************************************************************************/
$GLOBALS['themify_gallery'] = new Themify_Gallery();