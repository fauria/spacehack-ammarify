<?php

/**
 * Press Meta Box Options
 * @param array $args
 * @return array
 * @since 1.0.0
 */
function themify_theme_press_meta_box( $args = array() ) {
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
		// Post Image
		array(
			'name' 		=> 'post_image',
			'title' 	=> __('Featured Image', 'themify'),
			'description' => __( 'If Featured Image is not assigned, it will be auto generated from the press URL', 'themify' ),
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
 * Press Class - Shortcode
 **************************************************************************************************/

if ( ! class_exists( 'Themify_Press' ) ) {

	class Themify_Press {

		var $instance = 0;
		var $atts = array();
		var $post_type = 'press';
		var $tax = 'press-category';
		var $tag = 'press-tag';
		var $taxonomies;
		var $slideLoader = '<div class="slideshow-slider-loader"><div class="themify-loader"><div class="themify-loader_1 themify-loader_blockG"></div><div class="themify-loader_2 themify-loader_blockG"></div><div class="themify-loader_3 themify-loader_blockG"></div></div></div>';
		/**
		 * Set during press loop execution to store the featured image.
		 * Used to extract the URL to the image for the press slider pagination.
		 * @var string
		 */
		var $press_image = '';
		/**
		 * Collect images markup to create the thumbnails carousel
		 * @var string
		 */
		var $thumbnails = '';

		function __construct( $args = array() ) {
			add_filter( 'themify_post_types', array($this, 'extend_post_types' ) );
			add_filter( 'post_class', array($this, 'remove_cpt_post_class' ), 12 );
			add_filter( 'themify_types_excluded_in_search', array( $this, 'exclude_in_search' ) );

			add_action( 'init', array( $this, 'register' ) );
			add_action( 'admin_init', array( $this, 'manage_and_filter' ) );
			add_action( "save_post_{$this->post_type}", array($this, 'save_post'), 100, 2 );

			add_shortcode( 'themify_' . $this->post_type . '_posts', array( $this, 'init_shortcode' ) );
		}

		/**
		 * Register post type and taxonomy
		 */
		function register() {
			register_post_type( $this->post_type, array(
				'labels' => array(
					'name' => __('Press', 'themify'),
					'singular_name' => __('Press', 'themify'),
					'add_new' => __( 'Add New', 'themify' ),
					'add_new_item' => __( 'Add New Press', 'themify' ),
					'edit_item' => __( 'Edit Press', 'themify' ),
					'new_item' => __( 'New Press', 'themify' ),
					'view_item' => __( 'View Press', 'themify' ),
					'search_items' => __( 'Search Press', 'themify' ),
					'not_found' => __( 'No Press found', 'themify' ),
					'not_found_in_trash' => __( 'No Press found in Trash', 'themify' ),
					'menu_name' => __( 'Press', 'themify' ),
				),
				'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'excerpt', 'comments'),
				'hierarchical' => false,
				'public' => true,
				'exclude_from_search' => false,
				'query_var' => true,
				'can_export' => true,
				'capability_type' => 'post',
				'has_archive' => 'press-archive',
				'menu_icon' => 'dashicons-megaphone',
			));
			register_taxonomy( $this->tax, array( $this->post_type ), array(
				'labels' => array(
					'name' => __( 'Press Categories', 'themify' ),
					'singular_name' => __( 'Press Categories', 'themify' ),
				),
				'public' => true,
				'show_in_nav_menus' => true,
				'show_ui' => true,
				'show_tagcloud' => true,
				'hierarchical' => true,
				'rewrite' => true,
				'query_var' => true,
			));
			register_taxonomy( $this->tag, array( $this->post_type ), array(
				'labels' => array(
					'name' => __( 'Press Tags', 'themify' ),
					'singular_name' => __( 'Press Tags', 'themify' ),
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
				add_filter('manage_edit-'.$this->tax.'_columns', array( $this, 'taxonomy_header' ), 10, 2);
				add_filter('manage_'.$this->tax.'_custom_column', array( $this, 'taxonomy_column_id' ), 10, 3);

				add_filter('manage_edit-'.$this->tag.'_columns', array( $this, 'taxonomy_header' ), 10, 2);
				add_filter('manage_'.$this->tag.'_custom_column', array( $this, 'taxonomy_column_id' ), 10, 3);
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
		 * Run on post saving.
		 * Set default taxonomy term.
		 * @param number
		 * @param object
		 */
		function save_post( $post_id, $post ) {
			if ( 'publish' === $post->post_status ) {
				// Set default term for custom taxonomy and assign to post
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
		 * Trigger at the end of __construct of this shortcode
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
				'offset' => 0,
				'category' => 'all', // integer category ID
				'order' => 'DESC', // ASC
				'orderby' => 'date', // title, rand
				'style' => 'grid3', // grid4, grid2, list-post
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
				'suppress_filters' => false,
				'offset' => $offset
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

			if ($posts) {
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
				$themify->col_class = $this->column_class($style);
				$themify->media_position = themify_check('setting-default_media_position')? themify_get('setting-default_media_position') : 'above';

				$themify->show_post_media = true;
				$themify->is_shortcode = true;

				// Clear var that stores markup for thumbnails carousel
				$this->thumbnails = '';

				// SHORTCODE RENDERING
				$loop = themify_get_shortcode_template($posts, 'includes/loop-' . $post_type, 'index');

				$is_slider = false !== stripos( $style, 'slider' );

				if ( $is_slider ) {
					$loop = sprintf('%s<div class="slideshow-wrap"><div class="slideshow" data-id="%s-slider-%s" data-autoplay="%s" data-effect="%s" data-speed="%s" data-wrap="%s" data-slidernav="%s" data-pager="%s" data-thumbsid="%s">',
						$this->slideLoader,
						$post_type,
						$this->instance,
						is_numeric( $auto ) ? $auto * 1000 : $auto,
						$effect,
						$speed,
						$wrap,
						$slider_nav,
						$pager,
						$post_type . '-slider-' . $this->instance . '-thumbs'
					) . $loop . '</div></div>';
				}
				$press_loop_id = $is_slider ? "$post_type-slider-$this->instance" : "$post_type-loop-$this->instance";
				$out = "<div id='$press_loop_id' class='loops-wrapper shortcode $post_type $style $cpt_layout_class'>$loop</div>";

				if ( '' != $this->thumbnails && $is_slider ) {
					$out .= '<div id="' . $press_loop_id . '-thumbs" class="press-pager"><div class="slideshow-wrap"><div class="slideshow"  data-wrap="yes" data-pager="no" data-slidernav="no" >'.$this->thumbnails.'</div></div></div>';
				}

				$out .=  $this->section_link( $more_link, $more_text, $post_type );

				// END SHORTCODE RENDERING

				$themify = clone $themify_save; // revert to original $themify state
			}
			return $out;
		}

		/**
		 * Extract image URL and return it in a data attribute.
		 * @param $post_image
		 * @return string
		 */
		function data_thumb ( $post_image ) {
			$src = array();
			preg_match( '/<img(.*)src="(.*?)"(.*)>/i', $post_image, $src );
			return isset( $src[2] ) ? 'data-thumb="' . $src[2] . '"' : '';
		}

		function get_featured_image_link( $args = array() ) {
			$defaults = array(
				'no_permalink' => false
				// if there is no lightbox link, don't return a link
			);
			$args = wp_parse_args( $args, $defaults );
			extract( $args, EXTR_SKIP );

			if ( '' != themify_get( 'press_url' ) ) {
				$link = esc_url( themify_get( 'press_url' ) );
				$do_iframe = '?iframe=true&width=100%&height=100%';
				$link = $link . $do_iframe . '" class="lightbox';
			} elseif ( themify_get( 'external_link' ) != '' ) {
				$link = esc_url( themify_get( 'external_link' ) );
			} elseif ( themify_get( 'lightbox_link' ) != '' ) {
				$link = esc_url( themify_get( 'lightbox_link' ) );
				if ( themify_check( 'iframe_url' ) ) {
					$do_iframe = '?iframe=true&width=100%&height=100%';
				} else {
					$do_iframe = '';
				}
				$link = $link . $do_iframe . '" class="lightbox';
			} elseif ( themify_check( 'link_url' ) ) {
				$link = themify_get( 'link_url' );
			} elseif ( $no_permalink ) {
				$link = '';
			} else {
				$link = get_permalink();
				if ( current_theme_supports( 'themify-post-in-lightbox' ) ) {
					if ( ! is_single() && '' != themify_get( 'setting-open_inline' ) ) {
						$link = add_query_arg( array( 'post_in_lightbox' => 1 ), get_permalink() ) . '" class="themify-lightbox';
					}
					if ( themify_is_query_page() ) {
						if ( 'no' == themify_get( 'post_in_lightbox' ) ) {
							$link = get_permalink();
						} else {
							$link = add_query_arg( array( 'post_in_lightbox' => 1 ), get_permalink() ) . '" class="themify-lightbox';
						}
					}
				}
			}
			return apply_filters( 'themify_get_featured_image_link', $link );
		}

		/**
		 * Returns press type.
		 * @param $post_id
		 * @return string
		 */
		function get_press_type( $post_id ) {
			if ( $type = get_post_meta( $post_id, 'press_type', true ) ) {
				return $type;
			}
			return 'embed';
		}
	}
}

/**************************************************************************************************
 * Initialize Type Class
 **************************************************************************************************/
$GLOBALS['themify_press'] = new Themify_Press();