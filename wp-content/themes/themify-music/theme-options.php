<?php
/**
 * Main Themify class
 *
 * @package themify
 * @since 1.0.0
 */

class Themify {
	/** Default sidebar layout
	 *
	 * @var string
	 */
	public $layout;
	/** Default posts layout
	 *
	 * @var string
	 */
	public $post_layout;

	public $hide_title;
	public $hide_meta;
	public $hide_meta_author;
	public $hide_meta_category;
	public $hide_meta_comment;
	public $hide_meta_tag;
	public $hide_date;
	public $hide_image;
	public $media_position;

	public $unlink_title;
	public $unlink_image;

	public $display_content = '';
	public $auto_featured_image;

	public $post_image_width = '';
	public $post_image_height = '';

	public $width = '';
	public $height = '';

	public $avatar_size = 80;
	public $avatar_size_loop = 50;
	public $page_navigation;
	public $posts_per_page;

	public $image_align = '';
	public $image_setting = '';

	public $page_id = '';
	public $page_image_width = 978;
	public $query_category = '';
	public $query_post_type = '';
	public $query_taxonomy = '';
	public $paged = '';

	/////////////////////////////////////////////
	// Set Default Image Sizes 					
	/////////////////////////////////////////////

	// Default Index Layout
	static $content_width = 978;
	static $sidebar1_content_width = 714;

	// Default Single Post Layout
	static $single_content_width = 978;
	static $single_sidebar1_content_width = 670;

	// Default Single Image Size
	static $single_image_width = 1024;
	static $single_image_height = 585;

	// List Post
	static $list_post_width = 1160;
	static $list_post_height = 665;

	// Grid4
	static $grid4_width = 260;
	static $grid4_height = 150;

	// Grid3
	static $grid3_width = 360;
	static $grid3_height = 205;

	// Grid2
	static $grid2_width = 560;
	static $grid2_height = 320;

	// List Large
	static $list_large_image_width = 800;
	static $list_large_image_height = 460;

	// List Thumb
	static $list_thumb_image_width = 260;
	static $list_thumb_image_height = 150;

	// List Grid2 Thumb
	static $grid2_thumb_width = 160;
	static $grid2_thumb_height = 95;

	// Use dimensions defined in custom post type panel
	public $use_original_dimensions = 'no';

	// Sorting Parameters
	public $order = 'DESC';
	public $orderby = 'date';

	function __construct() {

		///////////////////////////////////////////
		//Global options setup
		///////////////////////////////////////////
		$this->layout = themify_get( 'setting-default_layout' );
		if ( $this->layout == '' ) {
			$this->layout = 'sidebar1';
		}

		$this->post_layout = themify_get( 'setting-default_post_layout' );
		if ( $this->post_layout == '' ) {
			$this->post_layout = 'list-post';
		}

		$this->page_title = themify_get( 'setting-hide_page_title' );
		$this->hide_title = themify_get( 'setting-default_post_title' );
		$this->unlink_title = themify_get( 'setting-default_unlink_post_title' );
		$this->media_position = themify_check( 'setting-default_media_position' ) ? themify_get( 'setting-default_media_position' ) : 'above';
		$this->hide_image = themify_get( 'setting-default_post_image' );
		$this->unlink_image = themify_get( 'setting-default_unlink_post_image' );
		$this->auto_featured_image = ! themify_check( 'setting-auto_featured_image' ) ? 'field_name=post_image, image, wp_thumb&' : '';
		$this->hide_page_image = themify_get( 'setting-hide_page_image' ) == 'yes' ? 'yes' : 'no';

		$this->hide_meta = themify_get( 'setting-default_post_meta' );
		$this->hide_meta_author = themify_get( 'setting-default_post_meta_author' );
		$this->hide_meta_category = themify_get( 'setting-default_post_meta_category' );
		$this->hide_meta_comment = themify_get( 'setting-default_post_meta_comment' );
		$this->hide_meta_tag = themify_get( 'setting-default_post_meta_tag' );

		$this->hide_date = themify_get( 'setting-default_post_date' );

		// Set Order & Order By parameters for post sorting
		$this->order = themify_check( 'setting-index_order' ) ? themify_get( 'setting-index_order' ) : 'DESC';
		$this->orderby = themify_check( 'setting-index_orderby' ) ? themify_get( 'setting-index_orderby' ) : 'date';

		$this->display_content = themify_get( 'setting-default_layout_display' );
		$this->avatar_size = apply_filters( 'themify_author_box_avatar_size', 96 );

		$this->posts_per_page = get_option( 'posts_per_page' );

		add_action( 'template_redirect', array( $this, 'template_redirect' ) );
	}

	function template_redirect() {

		$post_image_width = themify_get( 'image_width' );
		$post_image_height = themify_get( 'image_height' );

		if( is_singular() ) {
			$this->display_content = 'content';
		}

		if ( is_page() ) {
                        if(post_password_required()){
                            return;
                        }
			// Set Post Layout
			if ( themify_get( 'layout' ) != 'default' && themify_check( 'layout' ) ) {
				$this->post_layout = themify_get( 'layout' );
			} elseif ( themify_check( 'setting-default_post_layout' ) ) {
				$this->post_layout = themify_get( 'setting-default_post_layout' );
			} else {
				$this->post_layout = 'list-post';
			}

			// Save page ID in case we need it later
			$this->page_id = get_the_ID();
		}

		///////////////////////////////////////////
		// Setting image width, height
		///////////////////////////////////////////
		switch ( $this->post_layout ) {
			case 'grid4':
				$this->width = self::$grid4_width;
				$this->height = self::$grid4_height;
				break;
			case 'grid3':
				$this->width = self::$grid3_width;
				$this->height = self::$grid3_height;
				break;
			case 'grid2':
				$this->width = self::$grid2_width;
				$this->height = self::$grid2_height;
				break;
			case 'list-large-image':
				$this->width = self::$list_large_image_width;
				$this->height = self::$list_large_image_height;
				break;
			case 'list-thumb-image':
				$this->width = self::$list_thumb_image_width;
				$this->height = self::$list_thumb_image_height;
				break;
			case 'grid2-thumb':
				$this->width = self::$grid2_thumb_width;
				$this->height = self::$grid2_thumb_height;
				break;
			case 'list-post':
				$this->width = self::$list_post_width;
				$this->height = self::$list_post_height;
				break;
			default:
				$this->width = self::$list_post_width;
				$this->height = self::$list_post_height;
				break;
		}

		if ( '' != $post_image_height && '' != $post_image_width ) {
			$this->width = $post_image_width;
			$this->height = $post_image_height;
		}

		if ( is_page() ) {
			// Set Page Number for Pagination
			if ( get_query_var( 'paged' ) ) {
				$this->paged = get_query_var( 'paged' );
			} elseif ( get_query_var( 'page' ) ) {
				$this->paged = get_query_var( 'page' );
			} else {
				$this->paged = 1;
			}
			global $paged;
			$paged = $this->paged;

			// Set Sidebar Layout
			if ( themify_get( 'page_layout' ) != 'default' && themify_check( 'page_layout' ) ) {
				$this->layout = themify_get( 'page_layout' );
			} elseif ( themify_check( 'setting-default_page_layout' ) ) {
				$this->layout = themify_get( 'setting-default_page_layout' );
			} else {
				$this->layout = 'sidebar1';
			}

			// Set Page Title
			if ( themify_get( 'hide_page_title' ) != 'default' && themify_check( 'hide_page_title' ) ) {
				$this->page_title = themify_get( 'hide_page_title' );
			} elseif ( themify_check( 'setting-hide_page_title' ) ) {
				$this->page_title = themify_get( 'setting-hide_page_title' );
			} else {
				$this->page_title = 'no';
			}

			// Post Meta Values ///////////////////////
			$post_meta_keys = array(
				'_author'   => 'post_meta_author',
				'_category' => 'post_meta_category',
				'_comment'  => 'post_meta_comment',
				'_tag'      => 'post_meta_tag'
			);
			$post_meta_key = 'setting-default_';
			$this->hide_meta = themify_check( 'hide_meta_all' ) ? themify_get( 'hide_meta_all' ) : themify_get( $post_meta_key . 'post_meta' );
			foreach ( $post_meta_keys as $k => $v ) {
				$this->{'hide_meta' . $k} = themify_check( 'hide_meta' . $k ) ? themify_get( 'hide_meta' . $k ) : themify_get( $post_meta_key . $v );
			}

			// Post query or event query ///////////////////
			$post_query_category = themify_get( 'query_category' );
			$event_query_category = themify_get( 'event_query_category' );
			$video_query_category = themify_get( 'video_query_category' );
			$gallery_query_category = themify_get( 'gallery_query_category' );
			$album_query_category = themify_get( 'album_query_category' );
			$press_query_category = themify_get( 'press_query_category' );

			if ( '' != $event_query_category || '' != $video_query_category || '' != $gallery_query_category || '' != $album_query_category || '' != $press_query_category ) {

				// GENERAL QUERY POST TYPES OTHER THAN SECTION
				if ( '' != $event_query_category ) {
					$this->query_category = $event_query_category;
					$this->query_post_type = 'event';
				} elseif ( '' != $video_query_category ) {
					$this->query_category = $video_query_category;
					$this->query_post_type = 'video';
				} elseif ( '' != $gallery_query_category ) {
					$this->query_category = $gallery_query_category;
					$this->query_post_type = 'gallery';
				} elseif ( '' != $album_query_category ) {
					$this->query_category = $album_query_category;
					$this->query_post_type = 'album';
				} elseif ( '' != $press_query_category ) {
					$this->query_category = $press_query_category;
					$this->query_post_type = 'press';
				}
				$this->query_taxonomy = $this->query_post_type . '-category';

				$this->post_layout = themify_get( $this->query_post_type . '_layout' ) ? themify_get( $this->query_post_type . '_layout' ) : 'list-post';

				$this->hide_title = 'default' != themify_get( $this->query_post_type . '_hide_title' ) ? themify_get( $this->query_post_type . '_hide_title' ) : 'no';

				$this->unlink_title = 'default' != themify_get( $this->query_post_type . '_unlink_title' ) ? themify_get( $this->query_post_type . '_unlink_title' ) : 'no';

				$this->hide_image = 'default' != themify_get( $this->query_post_type . '_hide_image' ) ? themify_get( $this->query_post_type . '_hide_image' ) : 'no';

				$this->hide_meta = 'default' != themify_get( $this->query_post_type . '_hide_meta_all' ) ? themify_get( $this->query_post_type . '_hide_meta_all' ) : 'no';

				$this->hide_date = 'default' != themify_get( $this->query_post_type . '_hide_date' ) ? themify_get( $this->query_post_type . '_hide_date' ) : 'no';

				$this->unlink_image = 'default' != themify_get( $this->query_post_type . '_unlink_image' ) ? themify_get( $this->query_post_type . '_unlink_image' ) : 'no';

				$this->page_navigation = 'default' != themify_get( $this->query_post_type . '_hide_navigation' ) ? themify_get( $this->query_post_type . '_hide_navigation' ) : 'no';

				if ( 'event' == $this->query_post_type ) {
					$this->hide_event_date = 'default' != themify_get( $this->query_post_type . '_hide_event_date' ) ? themify_get( $this->query_post_type . '_hide_event_date' ) : 'no';

					$this->hide_event_location = 'default' != themify_get( $this->query_post_type . '_hide_event_location' ) ? themify_get( $this->query_post_type . '_hide_event_location' ) : 'no';
				}

				$this->display_content = themify_get( $this->query_post_type . '_display_content' );
				$this->posts_per_page = themify_get( $this->query_post_type . '_posts_per_page' );
				$this->order = themify_get( $this->query_post_type . '_order' );
				$this->orderby = themify_get( $this->query_post_type . '_orderby' );
				$this->use_original_dimensions = 'no';

				if ( '' != themify_get( $this->query_post_type . '_image_width' ) ) {
					$this->width = themify_get( $this->query_post_type . '_image_width' );
				}
				if ( '' != themify_get( $this->query_post_type . '_image_height' ) ) {
					$this->height = themify_get( $this->query_post_type . '_image_height' );
				}

			} else {

				// GENERAL QUERY POSTS
				$this->query_category = $post_query_category;
				$this->query_taxonomy = 'category';
				$this->query_post_type = 'post';

				$this->hide_title = themify_get( 'hide_title' );
				$this->unlink_title = themify_get( 'unlink_title' );
				$this->media_position = themify_check( 'media_position' ) ? themify_get( 'media_position' ) : 'above';
				$this->hide_image = themify_get( 'hide_image' );
				$this->unlink_image = themify_get( 'unlink_image' );
				if ( 'default' != themify_get( 'hide_date' ) ) {
					$this->hide_date = themify_get( 'hide_date' );
				} else {
					$this->hide_date = themify_check( 'setting-default_post_date' ) ?
						themify_get( 'setting-default_post_date' ) : 'no';
				}
				$this->display_content = themify_check( 'display_content' ) ? themify_get( 'display_content' ) : 'excerpt';
				$this->post_image_width = themify_get( 'image_width' );
				$this->post_image_height = themify_get( 'image_height' );
				$this->page_navigation = themify_get( 'hide_navigation' );
				$this->posts_per_page = themify_get( 'posts_per_page' );

				$this->order = ( themify_get( 'order' ) && '' != themify_get( 'order' ) ) ? themify_get( 'order' ) : ( themify_check( 'setting-index_order' ) ? themify_get( 'setting-index_order' ) : 'DESC' );
				$this->orderby = ( themify_get( 'orderby' ) && '' != themify_get( 'orderby' ) ) ? themify_get( 'orderby' ) : ( themify_check( 'setting-index_orderby' ) ? themify_get( 'setting-index_orderby' ) : 'date' );

			}
		}

		if ( is_single() ) {
			$this->hide_title = ( themify_get( 'hide_post_title' ) != 'default' && themify_check( 'hide_post_title' ) ) ? themify_get( 'hide_post_title' ) : themify_get( 'setting-default_page_post_title' );
			$this->unlink_title = ( themify_get( 'unlink_post_title' ) != 'default' && themify_check( 'unlink_post_title' ) ) ? themify_get( 'unlink_post_title' ) : themify_get( 'setting-default_page_unlink_post_title' );
			$this->hide_date = ( themify_get( 'hide_post_date' ) != 'default' && themify_check( 'hide_post_date' ) ) ? themify_get( 'hide_post_date' ) : themify_get( 'setting-default_page_post_date' );
			$this->hide_image = ( themify_get( 'hide_post_image' ) != 'default' && themify_check( 'hide_post_image' ) ) ? themify_get( 'hide_post_image' ) : themify_get( 'setting-default_page_post_image' );
			$this->unlink_image = ( themify_get( 'unlink_post_image' ) != 'default' && themify_check( 'unlink_post_image' ) ) ? themify_get( 'unlink_post_image' ) : themify_get( 'setting-default_page_unlink_post_image' );
			$this->media_position = 'above';

			// Post Meta Values ///////////////////////
			$post_meta_keys = array(
				'_author'   => 'post_meta_author',
				'_category' => 'post_meta_category',
				'_comment'  => 'post_meta_comment',
				'_tag'      => 'post_meta_tag'
			);

			$post_meta_key = 'setting-default_page_';
			$this->hide_meta = themify_check( 'hide_meta_all' ) ? themify_get( 'hide_meta_all' ) : themify_get( $post_meta_key . 'post_meta' );
			foreach ( $post_meta_keys as $k => $v ) {
				$this->{'hide_meta' . $k} = themify_check( 'hide_meta' . $k ) ? themify_get( 'hide_meta' . $k ) : themify_get( $post_meta_key . $v );
			}

			$this->layout = ( themify_get( 'layout' ) == 'sidebar-none' || themify_get( 'layout' ) == 'sidebar1' || themify_get( 'layout' ) == 'sidebar1 sidebar-left' || themify_get( 'layout' ) == 'sidebar2' ) ? themify_get( 'layout' ) : themify_get( 'setting-default_page_post_layout' );
			// set default layout
			if ( $this->layout == '' )
				$this->layout = 'sidebar1';

			$this->display_content = '';

			$this->post_image_width = themify_get( 'image_width' );
			$this->post_image_height = themify_get( 'image_height' );

			// Set Default Image Sizes for Single
			self::$content_width = self::$single_content_width;
			self::$sidebar1_content_width = self::$single_sidebar1_content_width;

			if ( is_singular( 'album' ) ) {
				$this->width = 350;
				$this->height = 200;
			} else {
				if ( '' == $post_image_height && '' == $post_image_width ) {
					$this->width = self::$single_image_width;
					$this->height = self::$single_image_height;
				} else {
					$this->width = $post_image_width;
					$this->height = $post_image_height;
				}
			}
		}

		if ( is_tax() || ( '' == $this->width && '' == $this->height ) ) {
			$this->width = self::$list_post_width;
			$this->height = self::$list_post_height;
		}

		if ( $this->layout == 'sidebar1' || $this->layout == 'sidebar1 sidebar-left' ) {
			$ratio = $this->width / self::$content_width;
			$aspect = $this->height / $this->width;
			$this->width = round( $ratio * self::$sidebar1_content_width );
			if ( $this->height != '' && $this->height != 0 )
				$this->height = round( $this->width * $aspect );
		}

		if ( is_single() && $this->hide_image != 'yes' ) {
			$this->image_align = themify_get( 'setting-image_post_single_align' );
			$this->image_setting = 'setting=image_post_single&';
		} elseif ( $this->query_category != '' && $this->hide_image != 'yes' ) {
			$this->image_align = '';
			$this->image_setting = '';
		} else {
			$this->image_align = themify_get( 'setting-image_post_align' );
			$this->image_setting = 'setting=image_post&';
		}
	}
}

/**
 * Initializes Themify class
 *
 * @since 1.0.0
 */
function themify_global_options() {
	global $themify;
	$themify = new Themify();
}

add_action( 'after_setup_theme', 'themify_global_options' );

?>