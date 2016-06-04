<?php
/**
 * Track separator with title
 *
 * @param $suffix
 * @param $title
 * @return array
 */
function themify_theme_field_track_separator( $suffix, $title ) {
	return array(
		'name'        => '_separator_' . $suffix,
		'title'       => '',
		'description' => '',
		'type'        => 'separator',
		'meta'        => array(
			'html' => '<h4>' . $title . '</h4><hr class="meta_fields_separator"/>'
		),
	);
}

/**
 * Track name
 *
 * @param $suffix
 * @return array
 */
function themify_theme_field_track_name( $suffix ) {
	return array(
		'name'        => 'track_name_' . $suffix,
		'title'       => __( 'Name', 'themify' ),
		'description' => '',
		'type'        => 'textbox',
		'meta'        => array(),
	);
}

/**
 * Track file
 *
 * @param $suffix
 * @return array
 */
function themify_theme_field_track_file( $suffix ) {
	return array(
		'name'        => 'track_file_' . $suffix,
		'title'       => __( 'Song File', 'themify' ),
		'description' => sprintf( __( 'Supported audio formats: %s.', 'themify' ), implode( ', ', wp_get_audio_extensions() ) ),
		'type'        => 'audio',
		'meta'        => array(),
	);
}

/**
 * Album Meta Box Options
 *
 * @param array $args
 * @return array
 * @since 1.0.0
 */
function themify_theme_tracks_meta_box( $args = array() ) {
	extract( $args );
	$fields = array();
	for ( $track = 1; $track <= apply_filters( 'themify_theme_number_of_tracks', 18 ); $track++ ) {
		$fields[] = themify_theme_field_track_separator( $track, sprintf( __( 'Track %s', 'themify' ), $track ) );
		$fields[] = themify_theme_field_track_name( $track );
		$fields[] = themify_theme_field_track_file( $track );
	}
	return $fields;
}
/**
 * Album Meta Box Options
 * @param array $args
 * @return array
 * @since 1.0.0
 */
function themify_theme_album_meta_box( $args = array() ) {
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
		// Artist
		array(
			'name'        => 'artist',
			'title'       => __( 'Artist', 'themify' ),
			'description' => __( 'Enter the artist(s) featured in this album.', 'themify' ),
			'type'        => 'textbox',
			'meta'        => array(),
		),
		// Artist
		array(
			'name'        => 'released',
			'title'       => __( 'Released', 'themify' ),
			'description' => __( 'Enter the year of release of this album.', 'themify' ),
			'type'        => 'textbox',
			'meta'        => array(),
		),
		// Artist
		array(
			'name'        => 'genre',
			'title'       => __( 'Genre', 'themify' ),
			'description' => __( 'Enter the genre of the music in this album.', 'themify' ),
			'type'        => 'textbox',
			'meta'        => array(),
		),
		// Artist
		array(
			'name'        => 'buy_album',
			'title'       => __( 'Buy Album Link', 'themify' ),
			'description' => __( 'Enter link to album buying page.', 'themify' ),
			'type'        => 'textbox',
			'meta'        => array(),
		),
		// Post Image
		array(
			'name' 		=> 'post_image',
			'title' 	=> __('Featured Image', 'themify'),
			'description' => '',
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
		// Video URL
		array(
			'name' 		=> 'video_url',
			'title' 		=> __('Video URL', 'themify'),
			'description' => __('Replace Featured Image with a video embed URL such as YouTube or Vimeo video url (<a href="http://themify.me/docs/video-embeds">details</a>).', 'themify'),
			'type' 		=> 'textbox',
			'meta'		=> array()
		),
		// Multi field: Image Dimension
		themify_image_dimensions_field( array(
			 'meta' => array(
				 'fields' => array(
					 // Image Width
					 array(
						 'name' => 'image_width',
						 'label' => __('width', 'themify'),
						 'description' => '',
						 'type' => 'textbox',
						 'meta' => array('size' => 'small'),
						 'before' => '',
						 'after' => '',
					 ),
					 // Image Height
					 array(
						 'name' => 'image_height',
						 'label' => __('height', 'themify'),
						 'type' => 'textbox',
						 'meta' => array( 'size' => 'small'),
						 'before' => '',
						 'after' => '',
					 ),
				 ),
				 'description' => __( 'Enter height = 0 to disable vertical cropping with image script enabled.', 'themify' ) . '<br/><strong>' . __( 'In single album view, the width value is used for width and height to render a squared cover.' ) . '</strong>',
				 'before' => '',
				 'after' => '',
				 'separator' => ''
			 ),
		) ),
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
 * Album Class - Shortcode
 **************************************************************************************************/

if ( ! class_exists( 'Themify_Album' ) ) {

	class Themify_Album {

		var $instance = 0;
		var $atts = array();
		var $post_type = 'album';
		var $tax = 'album-category';
		var $tag = 'album-tag';
		var $taxonomies;
		var $slideLoader = '<div class="slideshow-slider-loader"><div class="themify-loader"><div class="themify-loader_1 themify-loader_blockG"></div><div class="themify-loader_2 themify-loader_blockG"></div><div class="themify-loader_3 themify-loader_blockG"></div></div></div>';
		/**
		 * Set during album loop execution to store the featured image.
		 * Used to extract the URL to the image for the album slider pagination.
		 * @var string
		 */
		var $album_image = '';
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
					'name' => __('Albums', 'themify'),
					'singular_name' => __('Album', 'themify'),
					'add_new' => __( 'Add New', 'themify' ),
					'add_new_item' => __( 'Add New Album', 'themify' ),
					'edit_item' => __( 'Edit Album', 'themify' ),
					'new_item' => __( 'New Album', 'themify' ),
					'view_item' => __( 'View Album', 'themify' ),
					'search_items' => __( 'Search Albums', 'themify' ),
					'not_found' => __( 'No Albums found', 'themify' ),
					'not_found_in_trash' => __( 'No Albums found in Trash', 'themify' ),
					'menu_name' => __( 'Albums', 'themify' ),
				),
				'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'excerpt', 'comments'),
				'hierarchical' => false,
				'public' => true,
				'exclude_from_search' => false,
				'query_var' => true,
				'can_export' => true,
				'capability_type' => 'post',
				'has_archive' => 'album-archive',
				'rewrite' => array(
					'slug' => themify_check( 'themify_album_slug' ) ? themify_get( 'themify_album_slug' ) : $this->post_type,
				),
				'menu_icon' => 'dashicons-playlist-audio',
			));
			register_taxonomy( $this->tax, array( $this->post_type ), array(
				'labels' => array(
					'name' => __( 'Album Categories', 'themify' ),
					'singular_name' => __( 'Album Categories', 'themify' ),
				),
				'public' => true,
				'show_in_nav_menus' => true,
				'show_ui' => true,
				'show_tagcloud' => true,
				'hierarchical' => true,
				'rewrite' => array(
					'slug' => themify_check( 'themify_album_category_slug' ) ? themify_get( 'themify_album_category_slug' ) : $this->tax,
				),
				'query_var' => true,
			));
			register_taxonomy( $this->tag, array( $this->post_type ), array(
				'labels' => array(
					'name' => __( 'Album Tags', 'themify' ),
					'singular_name' => __( 'Album Tags', 'themify' ),
				),
				'public' => true,
				'show_in_nav_menus' => true,
				'show_ui' => true,
				'show_tagcloud' => true,
				'hierarchical' => false,
				'rewrite' => array(
					'slug' => themify_check( 'themify_album_tag_slug' ) ? themify_get( 'themify_album_tag_slug' ) : $this->tag,
				),
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
				'category' => 'all', // integer category ID
				'order' => 'DESC', // ASC
				'orderby' => 'date', // title, rand, artist (meta_value)
				'style' => 'grid3', // grid4, grid2, list-post
				'use_original_dimensions' => 'no', // yes
				'auto' => 4, // autoplay pause length
				'effect' => 'scroll', // transition effect
				'speed' => 500, // transition speed
				'visible' => 3, // visible items
				'scroll' => 1, // items to scroll
				'wrap' => 'yes',
				'slider_nav' => 'yes',
				'pager' => 'yes',
				'meta_key' => '',
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
			if ( isset( $atts['orderby'] ) && 'artist' == $atts['orderby'] ) {
				$atts['orderby'] = 'meta_value';
				$atts['meta_key'] = 'artist';
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
				'meta_key' => $meta_key
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

					$loop = sprintf('%s<div class="slideshow-wrap"><div class="slideshow" data-id="%s-slider-%s" data-autoplay="%s" data-effect="%s" data-speed="%s" data-visible="%s" data-scroll="%s" data-wrap="%s" data-slidernav="%s" data-pager="%s" data-thumbsid="%s">',
						$this->slideLoader,
						$post_type,
						$this->instance,
						is_numeric( $auto ) ? $auto * 1000 : $auto,
						$effect,
						$speed,
						$visible,
						$scroll,
						$wrap,
						$slider_nav,
						$pager,
						$post_type . '-slider-' . $this->instance . '-thumbs'
					) . $loop . '</div></div>';
				}
				$album_loop_id = $is_slider ? "$post_type-slider-$this->instance" : "$post_type-loop-$this->instance";
				$out = "<div id='$album_loop_id' class='loops-wrapper shortcode $post_type $style $cpt_layout_class'>$loop</div>";

				if ( '' != $this->thumbnails && $is_slider ) {
					$out .= '<div id="' . $album_loop_id . '-thumbs" class="album-pager"><div class="slideshow-wrap"><div class="slideshow"  data-wrap="yes" data-pager="no" data-slidernav="no" >'.$this->thumbnails.'</div></div></div>';
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

			if ( '' != themify_get( 'album_url' ) ) {
				$link = esc_url( themify_get( 'album_url' ) );
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
			} elseif ( $args['no_permalink'] ) {
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
		 * Returns album type.
		 * @param $post_id
		 * @return string
		 */
		function get_album_type( $post_id ) {
			if ( $type = get_post_meta( $post_id, 'album_type', true ) ) {
				return $type;
			}
			return 'embed';
		}
	}
}

/**************************************************************************************************
 * Initialize Type Class
 **************************************************************************************************/
$GLOBALS['themify_album'] = new Themify_Album();

/**************************************************************************************************
 * Audio Player Class
 **************************************************************************************************/

/**
 * Class Themify_Playlist.
 * WP Playlist wrapper to play external files.
 * @author Birgir Erlendsson https://github.com/birgire
 */

class Themify_Playlist {
    protected $type     = '';
    protected $types    = array( 'audio', 'video' );
	protected $instance = 0;

	/**
	 * Init - Register shortcodes
	 */
    public function __construct() {
        add_shortcode( 'themify_playlist', array( $this, 'playlist_shortcode' ) );
        add_shortcode( 'themify_trac',     array( $this, 'trac_shortcode'     ) );
    }

	/**
	 * Callback for the [themify_playlist] shortcode
	 */
    public function playlist_shortcode( $atts = array(), $content = '' ) {
        $this->instance++;
        $atts = shortcode_atts(
            array(
                'type'          => 'audio',
                'style'         => 'light',
                'tracklist'     => 'true',
                'tracknumbers'  => 'true',
                'images'        => 'true',
                'artists'       => 'true',
                'current'       => 'true',
				'loop'          => 'false',
				'autoplay'      => 'false',
				'preload'       => 'metadata', // none, auto
				'id'            => '',
				'width'         => '',
				'height'        => '',
            ), $atts, 'themify_playlist_shortcode' );

        //----------
        // Input
	    //----------
        $atts['id']           = esc_attr( $atts['id'] );
        $atts['type']         = esc_attr( $atts['type'] );
        $atts['style']        = esc_attr( $atts['style'] );
        $atts['tracklist']    = filter_var( $atts['tracklist'], FILTER_VALIDATE_BOOLEAN );
        $atts['tracknumbers'] = filter_var( $atts['tracknumbers'], FILTER_VALIDATE_BOOLEAN );
        $atts['images']       = filter_var( $atts['images'], FILTER_VALIDATE_BOOLEAN );
        $atts['autoplay']     = filter_var( $atts['autoplay'], FILTER_VALIDATE_BOOLEAN );

        // Audio specific:
        $atts['artists']      = filter_var( $atts['artists'], FILTER_VALIDATE_BOOLEAN );
        $atts['current']      = filter_var( $atts['current'], FILTER_VALIDATE_BOOLEAN );

		// Video specific:
        $atts['loop']         = filter_var( $atts['loop'], FILTER_VALIDATE_BOOLEAN );

        // Nested shortcode support:
        $this->type           = ( in_array( $atts['type'], $this->types, TRUE ) ) ? $atts['type'] : 'audio';

		// Get tracs:
		$content              = strip_tags( nl2br( do_shortcode( $content ) ) );

		// Replace last comma:
	    if( false !== ( $pos = strrpos( $content, ',' ) ) ) {
			$content = substr_replace( $content, '', $pos, 1 );
		}

        // Enqueue default scripts and styles for the playlist.
        ( 1 === $this->instance ) && do_action( 'wp_playlist_scripts', $atts['type'], $atts['style'] );

	    //----------
        // Output
	    //----------
        $html = '';
        $html .= sprintf( '<div class="wp-playlist wp-%s-playlist wp-playlist-%s">', $this->type, $atts['style'] );

		// Current audio item:
		if( $atts['current'] && 'audio' === $this->type ) {
			$html .= '<div class="wp-playlist-current-item"></div>';
		}

        // Video player:
        if( 'video' === $this->type ):
            $html .= sprintf( '<video controls="controls" preload="none" width="%s" height="%s"></video>',
                $atts['style'],
                $atts['width'],
                $atts['height']
            );
        // Audio player:
        else:
            $html .= sprintf(
	            '<audio controls="controls" preload="%s" %s></audio>',
	            $atts['preload'],
	            $atts['autoplay'] ? 'autoplay' : ''
	            );
        endif;

	   // Next/Previous:
	    $html .= '<div class="wp-playlist-next"></div><div class="wp-playlist-prev"></div>';

        // JSON
        $html .= sprintf( '
            <script class="wp-playlist-script" type="application/json">{
                "type":"%s",
                "tracklist":%b,
                "tracknumbers":%b,
                "images":%b,
                "artists":%b,
                "tracks":[%s]
            }</script></div>',
            $atts['type'],
            $atts['tracklist'],
            $atts['tracknumbers'],
            $atts['images'],
            $atts['artists'],
            $content
        );
        return $html;
    }

	/**
	 * Callback for the [themify_trac] shortcode
	 */
	public function trac_shortcode( $atts = array(), $content = '' ) {
		$atts = shortcode_atts(
			array(
				 'src'                   => '',
				 'type'                  => ( 'video' === $this->type ) ? 'video/mp4' : 'audio/mpeg',
				 'title'                 => '',
				 'caption'               => '',
				 'description'           => '',
				 'image_src'             => sprintf( '%s/wp-includes/images/media/%s.png', get_site_url(), $this->type ),
				 'image_width'           => '48',
				 'image_height'          => '64',
				 'thumb_src'             => sprintf( '%s/wp-includes/images/media/%s.png', get_site_url(), $this->type ),
				 'thumb_width'           => '48',
				 'thumb_height'          => '64',
				 'meta_artist'           => '',
				 'meta_album'            => '',
				 'meta_genre'            => '',
				 'meta_length_formatted' => '',

				 'dimensions_original_width'  => '300',
				 'dimensions_original_height' => '200',
				 'dimensions_resized_width'   => '600',
				 'dimensions_resized_height'  => '400',
			), $atts, 'themify_trac_shortcode' );

		//----------
		// Input
		//----------
		$data['src']                      = esc_url( $atts['src'] );
		$data['title']                    = sanitize_text_field( $atts['title'] );
		$data['type']                     = sanitize_text_field( $atts['type'] );
		$data['caption']                  = sanitize_text_field( $atts['caption'] );
		$data['description']              = sanitize_text_field( $atts['description'] );
		$data['image']['src']             = esc_url( $atts['image_src'] );
		$data['image']['width']           = intval( $atts['image_width'] );
		$data['image']['height']          = intval( $atts['image_height'] );
		$data['thumb']['src']             = esc_url( $atts['thumb_src'] );
		$data['thumb']['width']           = intval( $atts['thumb_width'] );
		$data['thumb']['height']          = intval( $atts['thumb_height'] );
		$data['meta']['length_formatted'] = sanitize_text_field( $atts['meta_length_formatted'] );

		// Video related:
		if( 'video' === $this->type ) {
			$data['dimensions']['original']['width']  = sanitize_text_field( $atts['dimensions_original_width'] );
			$data['dimensions']['original']['height'] = sanitize_text_field( $atts['dimensions_original_height'] );
			$data['dimensions']['resized']['width']   = sanitize_text_field( $atts['dimensions_resized_width'] );
			$data['dimensions']['resized']['height']  = sanitize_text_field( $atts['dimensions_resized_height'] );

		// Audio related:
		} else {
			$data['meta']['artist'] = sanitize_text_field( $atts['meta_artist'] );
			$data['meta']['album']  = sanitize_text_field( $atts['meta_album'] );
			$data['meta']['genre']  = sanitize_text_field( $atts['meta_genre'] );
		}

		//----------
		// Output:
		//----------
		return json_encode( $data ) . ',';
	}

} // end class

/**************************************************************************************************
 * Initialize Playlist Class
 **************************************************************************************************/
$GLOBALS['themify_playlist'] = new Themify_Playlist();

if ( ! function_exists( 'themify_theme_get_albums' ) ) {
	/**
	 * Return terms from specified taxonomy
	 * @param array $prepend
	 * @return mixed|void
	 */
	function themify_theme_get_albums( $prepend = array() ) {
		$albums = get_posts( apply_filters( 'themify_theme_get_albums_query_args', array(
			'post_type'      => 'album',
			'posts_per_page' => -1,
		)));
		$album_list = array();
		if ( ! empty( $albums ) ) {
			foreach ( $albums as $album ) {
				$album_list[$album->ID] = array(
					'name' => $album->post_title,
					'value'	=> $album->post_name
				);
			}
		}
		return array_merge( $prepend, $album_list );
	}
}
if ( ! function_exists( 'themify_audio_player_module' ) ) {
	/**
	 * Markup for album category selection for audio player.
	 * @return string
	 */
	function themify_audio_player_module() {
		
		/**
		 * Category list
		 * @var array
		 */
		$categories = array_merge(
			array(
				'off' => array(
					'name' => __( 'Disable Audio Player', 'themify' ),
					'value'	=> ''
				),
			),
			themify_theme_get_albums()
		);

		/**
		 * Module markup
		 * @var string
		 */
                $key = 'setting-audio_player_type';
                $type = themify_get($key);
		$html = '<div><span class="label">' . __( 'Player Displays', 'themify' ) . '</span></div>';
		$html .= sprintf(
                            '<div class="themify_player_types">
                                <label for="themify_player_type_album">
                                    <input %5$s type="radio" name="%4$s" id="themify_player_type_album" value="album" /> 
                                    %1$s
                                </label>
                                <label for="themify_player_type_songs">
                                    <input %6$s type="radio" name="%4$s" id="themify_player_type_songs" value="songs" />
                                    %2$s
                                </label>
                                <label for="themify_player_type_code">
                                    <input %7$s type="radio" name="%4$s" id="themify_player_type_code" value="code" />
                                    %3$s
                                </label>
                            </div>
			',
                        __('Album','themify'),
                        __('Custom Songs','themify'),
                        __('Custom Code','themify'),
                        $key,
                        !$type || $type=='album'?'checked="checked"':'',
                        $type=='songs'?'checked="checked"':'',
                        $type=='code'?'checked="checked"':''
                        );
                $key = 'setting-audio_player';
                $html.=' <div class="pushlabel hide themify_album_tabs" id="themify_player_type_album_">';
                $html .= sprintf('
                            <select name="%s">%s</select>
                            <p><small>%s</small></p>
                            ',
			$key,
			themify_options_module( $categories, $key ),
			__( 'Select an album to display or disable it completely.', 'themify' )
		);

		$key = 'setting-audio_player_autoplay';
		/**
		 * Autoplay markup
		 * @var string
		 */
		$html .= sprintf('<p><span><label for="%1$s"><input type="checkbox" id="%1$s" name="%1$s" %2$s /> %3$s</label></span></p>',
			$key,
			checked( themify_get( $key ), 'on', false ),
			__( 'Auto play audio.', 'themify' )
		);
                $html.='</div>';
                
                /**
                * Custom Songs 
                */
                $key = 'setting-audio_player_songs';
                
             
                $html.='<div class="hide themify_album_tabs pushlabel" id="themify_player_type_songs_">';
                for($i=1;$i<=7;++$i){
                    $title = themify_get($key.'_title_'.$i);
                    $url = themify_get($key.'_url_'.$i);
                    $img = themify_get($key.'_img_'.$i);
                    $html .= sprintf('
                                <div class="row">
                                    <p>
                                        <label class="label" for="themify_player_type_songs_title_'.$i.'">%s</label>
                                        <input type="text" class="width10" id="themify_player_type_songs_title_'.$i.'" value="'.$title.'" name="%4$s_title_'.$i.'" />
                                    </p>
                                    <p>
                                        <label class="label" for="themify_player_type_songs_url_'.$i.'">%s</label>
                                        <input type="text" class="width10" id="themify_player_type_songs_url_'.$i.'" value="'.$url.'" name="%4$s_url_'.$i.'" />
                                    </p>
                                    <p>
                                        <label class="label" for="themify_player_type_songs__image_'.$i.'">%s</label>
                                        <input type="text" class="width10" id="themify_player_type_songs_image_'.$i.'" value="'.$img.'" name="%4$s_img_'.$i.'" />
                                    </p>
                                </div>
                                ',
                            sprintf(__( 'Song Title %s', 'themify' ),$i),
                            sprintf(__( 'Song File URL %s', 'themify' ),$i),
                            sprintf( __( 'Song Image %s', 'themify' ),$i),
                            $key
                    );
                }
                $html.='</div>';
                
                /**
                * Custom code 
                */
                $key = 'setting-audio_player_code';
                $value = themify_get($key);
                $html.='<div class="hide themify_album_tabs pushlabel" id="themify_player_type_code_">';
                $html.='<p><textarea class="widthfull" rows="4" name="'.$key.'">'.$value.'</textarea></p>';  
                $html.=sprintf('<p><small>%s</small></p>',__('Insert any code (e.g SoundCloud embed code)'));
                $html.='</div>';
		return $html;
	}
}
if ( ! function_exists( 'themify_footer_audio_player' ) ) {
	/**
	 * Load audio player on footer.
	 */
	function themify_footer_audio_player() {
		if ( '' != themify_get( 'setting-audio_player' ) ) {
			get_template_part( 'includes/audio-player', 'index' );
		}
	}
}
add_action( 'themify_body_end', 'themify_footer_audio_player' );

if ( ! function_exists( 'themify_album_slug' ) ) {
	/**
	 * Album Slug
	 * @param array $data
	 * @return string
	 */
	function themify_album_slug($data=array()){
		$data = themify_get_data();
		$album_slug = isset($data['themify_album_slug'])? $data['themify_album_slug']: apply_filters('themify_album_rewrite', 'album');
		$album_category_slug = isset($data['themify_album_category_slug'])? $data['themify_album_category_slug']: apply_filters('themify_album_category_rewrite', 'album-category');
		$album_tag_slug = isset($data['themify_album_tag_slug'])? $data['themify_album_tag_slug']: apply_filters('themify_album_tag_rewrite', 'album-tag');
		return '
			<p>
				<span class="label">' . __('Album Base Slug', 'themify') . '</span>
				<input type="text" name="themify_album_slug" value="'.$album_slug.'" class="slug-rewrite">
				<br />
				<span class="pushlabel"><small>' . __('Use only lowercase letters, numbers, underscores and dashes.', 'themify') . '</small></span>
			</p>
			<p>
				<span class="label">' . __('Album Category Slug', 'themify') . '</span>
				<input type="text" name="themify_album_category_slug" value="'.$album_category_slug.'" class="slug-rewrite">
				<br />
				<span class="pushlabel"><small>' . __('Use only lowercase letters, numbers, underscores and dashes.', 'themify') . '</small></span>
			</p>
			<p>
				<span class="label">' . __('Album Tag Slug', 'themify') . '</span>
				<input type="text" name="themify_album_tag_slug" value="'.$album_tag_slug.'" class="slug-rewrite">
				<br />
				<span class="pushlabel"><small>' . __('Use only lowercase letters, numbers, underscores and dashes.', 'themify') . '</small></span>
			</p>
			<p>
				<small>' . sprintf(__('After changing this, go to <a href="%s">permalinks</a> and click "Save changes" to refresh them.', 'themify'), admin_url('options-permalink.php#submit')) . '</small>
			</p>';
	}
}