<?php
/**
 * Page Meta Box Options
 * @param array $args
 * @return array
 * @since 1.0.0
 */
function themify_theme_page_meta_box( $args = array() ){
	extract( $args );
	return array(
		// Page Layout
		array(
			'name' 		=> 'page_layout',
			'title'		=> __('Sidebar Option', 'themify'),
			'description'	=> '',
			'type'		=> 'layout',
			'show_title' => true,
			'meta'		=> array(
				array('value' => 'default', 'img' => 'images/layout-icons/default.png', 'selected' => true, 'title' => __('Default', 'themify')),
				array('value' => 'sidebar1', 'img' => 'images/layout-icons/sidebar1.png', 'title' => __('Sidebar Right', 'themify')),
				array('value' => 'sidebar1 sidebar-left', 'img' => 'images/layout-icons/sidebar1-left.png', 'title' => __('Sidebar Left', 'themify')),
				array('value' => 'sidebar-none', 'img' => 'images/layout-icons/sidebar-none.png', 'title' => __('No Sidebar ', 'themify'))
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
		// Hide page title
		array(
			'name' 		=> 'hide_page_title',
			'title'		=> __('Hide Page Title', 'themify'),
			'description'	=> '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
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

/**
 * Query Posts Options
 * @param array $args
 * @return array
 * @since 1.0.0
 */
function themify_theme_query_post_meta_box($args = array()) {
	extract( $args );
	return array(
		// Notice
		array(
			'name' => '_query_posts_notice',
			'title' => '',
			'description' => '',
			'type' => 'separator',
			'meta' => array(
				'html' => '<div class="themify-info-link">' . sprintf( __( '<a href="%s">Query Posts</a> allows you to query WordPress posts from any category on the page. To use it, select a Query Category.', 'themify' ), 'http://themify.me/docs/query-posts' ) . '</div>'
			),
		),
		// Query Category
		array(
			'name' 		=> 'query_category',
			'title'		=> __('Query Category', 'themify'),
			'description'	=> __('Select a category or enter multiple category IDs (eg. 2,5,6). Enter 0 to display all category.', 'themify'),
			'type'		=> 'query_category',
			'meta'		=> array()
		),
		// Descending or Ascending Order for Posts
		array(
			'name' 		=> 'order',
			'title'		=> __('Order', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array('name' => __('Descending', 'themify'), 'value' => 'desc', 'selected' => true),
				array('name' => __('Ascending', 'themify'), 'value' => 'asc')
			)
		),
		// Criteria to Order By
		array(
			'name' 		=> 'orderby',
			'title'		=> __('Order By', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array('name' => __('Date', 'themify'), 'value' => 'content', 'selected' => true),
				array('name' => __('Random', 'themify'), 'value' => 'rand'),
				array('name' => __('Author', 'themify'), 'value' => 'author'),
				array('name' => __('Post Title', 'themify'), 'value' => 'title'),
				array('name' => __('Comments Number', 'themify'), 'value' => 'comment_count'),
				array('name' => __('Modified Date', 'themify'), 'value' => 'modified'),
				array('name' => __('Post Slug', 'themify'), 'value' => 'name'),
				array('name' => __('Post ID', 'themify'), 'value' => 'ID')
			)
		),
		// Post Layout
		array(
			'name' 		=> 'layout',
			'title'		=> __('Query Post Layout', 'themify'),
			'description'	=> '',
			'type'		=> 'layout',
			'show_title' => true,
			'meta'		=> array(
				array(
					'value' => 'list-post',
					'img' => 'images/layout-icons/list-post.png',
					'selected' => true
				),
				array(
					'value' => 'grid4',
					'img'   => 'images/layout-icons/grid4.png',
					'title' => __( 'Grid 4', 'themify' )
				),
				array(
					'value' => 'grid3',
					'img'   => 'images/layout-icons/grid3.png',
					'title' => __( 'Grid 3', 'themify' )
				),
				array(
					'value' => 'grid2',
					'img'   => 'images/layout-icons/grid2.png',
					'title' => __( 'Grid 2', 'themify' )
				),
				array(
					'value' => 'list-large-image',
					'img'   => 'images/layout-icons/list-large-image.png',
					'title' => __( 'List Large Image', 'themify' )
				),
				array(
					'value' => 'list-thumb-image',
					'img'   => 'images/layout-icons/list-thumb-image.png',
					'title' => __( 'List Thumb Image', 'themify' )
				),
				array(
					'value' => 'grid2-thumb',
					'img'   => 'images/layout-icons/grid2-thumb.png',
					'title' => __( 'Grid 2 Thumb', 'themify' )
				)
			)
		),
		// Posts Per Page
		array(
			'name' 		=> 'posts_per_page',
			'title'		=> __('Posts Per Page', 'themify'),
			'description'	=> '',
			'type'		=> 'textbox',
			'meta'		=> array('size' => 'small')
		),
		// Display Content
		array(
			'name' 		=> 'display_content',
			'title'		=> __('Display Content', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array('name' => __('Full Content', 'themify'),'value'=>'content','selected'=>true),
				array('name' => __('Excerpt', 'themify'),'value'=>'excerpt'),
				array('name' => __('None', 'themify'),'value'=>'none')
			)
		),
		// Featured Image Size
		array(
			'name'	=>	'feature_size_page',
			'title'	=>	__('Image Size', 'themify'),
			'description' => sprintf(__('Image sizes can be set at <a href="%s">Media Settings</a> and <a href="%s" target="_blank">Regenerated</a>', 'themify'), 'options-media.php', 'https://wordpress.org/plugins/regenerate-thumbnails/'),
			'type'		 =>	'featimgdropdown'
		),
		// Multi field: Image Dimension
		themify_image_dimensions_field(),
		// Hide Title
		array(
			'name' 		=> 'hide_title',
			'title'		=> __('Hide Post Title', 'themify'),
			'description'	=> '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Unlink Post Title
		array(
			'name' 		=> 'unlink_title',
			'title' 		=> __('Unlink Post Title', 'themify'),
			'description' => __('Unlink post title (it will display the post title without link)', 'themify'),
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Hide Post Date
		array(
			'name' 		=> 'hide_date',
			'title'		=> __('Hide Post Date', 'themify'),
			'description'	=> '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Hide Post Meta
		themify_multi_meta_field(),
		// Hide Post Image
		array(
			'name' 		=> 'hide_image',
			'title' 		=> __('Hide Featured Image', 'themify'),
			'description' => '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Unlink Post Image
		array(
			'name' 		=> 'unlink_image',
			'title' 		=> __('Unlink Featured Image', 'themify'),
			'description' => __('Display the Featured Image without link', 'themify'),
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Page Navigation Visibility
		array(
			'name' 		=> 'hide_navigation',
			'title'		=> __('Hide Page Navigation', 'themify'),
			'description'	=> '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
	);
}

/**
 * Query Sections Meta Box Options
 * @param array $args
 * @return array
 * @since 1.0.0
 */
function themify_theme_query_section_meta_box($args = array()) {
	extract( $args );
	return array(
		// Query Category
		array(
			'name' 		=> 'section_query_category',
			'title'		=> __('Section Category', 'themify'),
			'description'	=> __('Select a section category or enter multiple section category IDs (eg. 2,5,6). Enter 0 to display all section categories.', 'themify'),
			'type'		=> 'query_category',
			'meta'		=> array('taxonomy' => 'section-category')
		),
		// Descending or Ascending Order for Sections
		array(
			'name' 		=> 'section_order',
			'title'		=> __('Order', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array('name' => __('Descending', 'themify'), 'value' => 'desc', 'selected' => true),
				array('name' => __('Ascending', 'themify'), 'value' => 'asc')
			)
		),
		// Criteria to Order By
		array(
			'name' 		=> 'section_orderby',
			'title'		=> __('Order By', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array('name' => __('Date', 'themify'), 'value' => 'content', 'selected' => true),
				array('name' => __('Random', 'themify'), 'value' => 'rand'),
				array('name' => __('Author', 'themify'), 'value' => 'author'),
				array('name' => __('Post Title', 'themify'), 'value' => 'title'),
				array('name' => __('Comments Number', 'themify'), 'value' => 'comment_count'),
				array('name' => __('Modified Date', 'themify'), 'value' => 'modified'),
				array('name' => __('Post Slug', 'themify'), 'value' => 'name'),
				array('name' => __('Post ID', 'themify'), 'value' => 'ID')
			)
		),
		// Posts Per Page
		array(
			  'name' 		=> 'section_posts_per_page',
			  'title'		=> __('Sections Per Page', 'themify'),
			  'description'	=> '',
			  'type'		=> 'textbox',
			  'meta'		=> array('size' => 'small')
			),
		// Featured Image Size
		array(
			'name'	=>	'section_feature_size_page',
			'title'	=>	__('Image Size', 'themify'),
			'description' => __('Image sizes can be set at <a href="options-media.php">Media Settings</a> and <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerated</a>', 'themify'),
			'type'		 =>	'featimgdropdown'
		),
		// Hide Title
		array(
			  'name' 		=> 'section_hide_title',
			  'title'		=> __('Hide Section Title', 'themify'),
			  'description'	=> '',
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
					array('value' => 'default', 'name' => '', 'selected' => true),
					array('value' => 'yes', 'name' => __('Yes', 'themify')),
					array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
	);
}

/**
 * Event Meta Box Options
 * @param array $args
 * @return array
 * @since 1.0.7
 */
function themify_theme_query_event_meta_box($args = array()){
	extract( $args );
	return array(
		// Query Category
		array(
			'name' 		=> 'event_query_category',
			'title'		=> __('Event Category', 'themify'),
			'description'	=> __('Select a event category or enter multiple event category IDs (eg. 2,5,6). Enter 0 to display all event categories.', 'themify'),
			'type'		=> 'query_category',
			'meta'		=> array('taxonomy' => 'event-category')
		),
		// Descending or Ascending Order for Events
		array(
			'name' 		=> 'event_order',
			'title'		=> __('Order', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array('name' => __('Descending', 'themify'), 'value' => 'desc', 'selected' => true),
				array('name' => __('Ascending', 'themify'), 'value' => 'asc')
			)
		),
		// Criteria to Order By
		array(
			'name' 		=> 'event_orderby',
			'title'		=> __('Order By', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array('name' => __('Event Date', 'themify'), 'value' => 'meta_value', 'selected' => true),
				array('name' => __('Date', 'themify'), 'value' => 'content'),
				array('name' => __('Random', 'themify'), 'value' => 'rand'),
				array('name' => __('Author', 'themify'), 'value' => 'author'),
				array('name' => __('Post Title', 'themify'), 'value' => 'title'),
				array('name' => __('Comments Number', 'themify'), 'value' => 'comment_count'),
				array('name' => __('Modified Date', 'themify'), 'value' => 'modified'),
				array('name' => __('Post Slug', 'themify'), 'value' => 'name'),
				array('name' => __('Post ID', 'themify'), 'value' => 'ID')
			)
		),
		// Post Layout
		array(
			'name' 		=> 'event_layout',
			'title'		=> __('Event Layout', 'themify'),
			'description'	=> '',
			'type'		=> 'layout',
			'show_title' => true,
			'meta'		=> array(
				array(
					'value' => 'list-post',
					'img' => 'images/layout-icons/list-post.png',
					'selected' => true
				),
				array(
					'value' => 'grid4',
					'img'   => 'images/layout-icons/grid4.png',
					'title' => __( 'Grid 4', 'themify' )
				),
				array(
					'value' => 'grid3',
					'img'   => 'images/layout-icons/grid3.png',
					'title' => __( 'Grid 3', 'themify' )
				),
				array(
					'value' => 'grid2',
					'img'   => 'images/layout-icons/grid2.png',
					'title' => __( 'Grid 2', 'themify' )
				),
				array(
					'value' => 'list-large-image',
					'img'   => 'images/layout-icons/list-large-image.png',
					'title' => __( 'List Large Image', 'themify' )
				),
				array(
					'value' => 'list-thumb-image',
					'img'   => 'images/layout-icons/list-thumb-image.png',
					'title' => __( 'List Thumb Image', 'themify' )
				),
				array(
					'value' => 'grid2-thumb',
					'img'   => 'images/layout-icons/grid2-thumb.png',
					'title' => __( 'Grid 2 Thumb', 'themify' )
				)
			)
		),
		// Display Content
		array(
			  'name' 		=> 'event_hide_past_events',
			  'title'		=> __('Display Events', 'themify'),
			  'description'	=> '',
			  'type'		=> 'dropdown',
			  'meta'		=> array(
									array('name' => __('All Events', 'themify'),'value'=>'both','selected'=>true),
									array('name' => __('Past Events', 'themify'),'value'=>'no'),
									array('name' => __('Upcoming Events', 'themify'),'value'=>'yes')
								)
			),
		// Posts Per Page
		array(
			  'name' 		=> 'event_posts_per_page',
			  'title'		=> __('Events Per Page', 'themify'),
			  'description'	=> '',
			  'type'		=> 'textbox',
			  'meta'		=> array('size' => 'small')
			),

		// Display Content
		array(
			  'name' 		=> 'event_display_content',
			  'title'		=> __('Display Content', 'themify'),
			  'description'	=> '',
			  'type'		=> 'dropdown',
			  'meta'		=> array(
									array('name' => __('Full Content', 'themify'),'value'=>'content','selected'=>true),
									array('name' => __('Excerpt', 'themify'),'value'=>'excerpt'),
									array('name' => __('None', 'themify'),'value'=>'none')
								)
			),
		// Featured Image Size
		array(
			'name'	=>	'event_feature_size_page',
			'title'	=>	__('Image Size', 'themify'),
			'description' => __('Image sizes can be set at <a href="options-media.php">Media Settings</a> and <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerated</a>', 'themify'),
			'type'		 =>	'featimgdropdown'
			),

		// Multi field: Image Dimension
		array(
			'type' => 'multi',
			'name' => '_event_image_dimensions',
			'title' => __('Image Dimensions', 'themify'),
			'meta' => array(
				'fields' => array(
					// Image Width
					array(
					  'name' 		=> 'event_image_width',
					  'label' => __('width', 'themify'),
					  'description' => '',
					  'type' 		=> 'textbox',
					  'meta'		=> array('size'=>'small')
					),
					// Image Height
					array(
					  'name' 		=> 'event_image_height',
					  'label' => __('height', 'themify'),
					  'description' => '',
					  'type' 		=> 'textbox',
					  'meta'		=> array('size'=>'small')
					),
				),
				'description' => __('Enter height = 0 to disable vertical cropping with img.php enabled', 'themify'),
				'before' => '',
				'after' => '',
				'separator' => ''
			)
		),
		// Hide Title
		array(
			  'name' 		=> 'event_hide_title',
			  'title'		=> __('Hide Event Title', 'themify'),
			  'description'	=> '',
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
									array('value' => 'default', 'name' => '', 'selected' => true),
									array('value' => 'yes', 'name' => __('Yes', 'themify')),
									array('value' => 'no',	'name' => __('No', 'themify'))
								)
			),
		// Unlink Post Title
		array(
			  'name' 		=> 'event_unlink_title',
			  'title' 		=> __('Unlink Event Title', 'themify'),
			  'description' => __('Unlink event title (it will display the post title without link)', 'themify'),
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
									array('value' => 'default', 'name' => '', 'selected' => true),
									array('value' => 'yes', 'name' => __('Yes', 'themify')),
									array('value' => 'no',	'name' => __('No', 'themify'))
								)
			),
		// Hide Post Date
		array(
			  'name' 		=> 'event_hide_date',
			  'title'		=> __('Hide Event Publish Date', 'themify'),
			  'description'	=> '',
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
									array('value' => 'default', 'name' => '', 'selected' => true),
									array('value' => 'yes', 'name' => __('Yes', 'themify')),
									array('value' => 'no',	'name' => __('No', 'themify'))
								)
			),
		// Hide Post Meta
		array(
			'name' 		=> 'event_hide_meta_all',
			'title' 	=> __('Hide Event Meta', 'themify'),
			'description' => '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Hide Post Image
		array(
			  'name' 		=> 'event_hide_image',
			  'title' 		=> __('Hide Featured Image', 'themify'),
			  'description' => '',
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Unlink Post Image
		array(
			  'name' 		=> 'event_unlink_image',
			  'title' 		=> __('Unlink Featured Image', 'themify'),
			  'description' => __('Display the Featured Image Without Link', 'themify'),
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Page Navigation Visibility
		array(
			  'name' 		=> 'event_hide_navigation',
			  'title'		=> __('Hide Page Navigation', 'themify'),
			  'description'	=> '',
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Event Location
		array(
			'name' 		=> 'event_hide_event_location',
			'title'		=> __('Hide Event Location', 'themify'),
			'description'	=> '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Event Date
		array(
			'name' 		=> 'event_hide_event_date',
			'title'		=> __('Hide Event Date', 'themify'),
			'description'	=> '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
	);
}

/**
 * Video Meta Box Options
 * @param array $args
 * @return array
 * @since 1.0.7
 */
function themify_theme_query_video_meta_box($args = array()){
	extract( $args );
	return array(
		// Query Category
		array(
			'name' 		=> 'video_query_category',
			'title'		=> __('Video Category', 'themify'),
			'description'	=> __('Select a video category or enter multiple video category IDs (eg. 2,5,6). Enter 0 to display all video categories.', 'themify'),
			'type'		=> 'query_category',
			'meta'		=> array('taxonomy' => 'video-category')
		),
		// Descending or Ascending Order for Videos
		array(
			'name' 		=> 'video_order',
			'title'		=> __('Order', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array('name' => __('Descending', 'themify'), 'value' => 'desc', 'selected' => true),
				array('name' => __('Ascending', 'themify'), 'value' => 'asc')
			)
		),
		// Criteria to Order By
		array(
			'name' 		=> 'video_orderby',
			'title'		=> __('Order By', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array('name' => __('Date', 'themify'), 'value' => 'content', 'selected' => true),
				array('name' => __('Random', 'themify'), 'value' => 'rand'),
				array('name' => __('Author', 'themify'), 'value' => 'author'),
				array('name' => __('Post Title', 'themify'), 'value' => 'title'),
				array('name' => __('Comments Number', 'themify'), 'value' => 'comment_count'),
				array('name' => __('Modified Date', 'themify'), 'value' => 'modified'),
				array('name' => __('Post Slug', 'themify'), 'value' => 'name'),
				array('name' => __('Post ID', 'themify'), 'value' => 'ID')
			)
		),
		// Post Layout
		array(
			'name' 		=> 'video_layout',
			'title'		=> __('Video Layout', 'themify'),
			'description'	=> '',
			'type'		=> 'layout',
			'show_title' => true,
			'meta'		=> array(
				array(
					'value' => 'list-post',
					'img' => 'images/layout-icons/list-post.png',
					'selected' => true
				),
				array(
					'value' => 'grid4',
					'img'   => 'images/layout-icons/grid4.png',
					'title' => __( 'Grid 4', 'themify' )
				),
				array(
					'value' => 'grid3',
					'img'   => 'images/layout-icons/grid3.png',
					'title' => __( 'Grid 3', 'themify' )
				),
				array(
					'value' => 'grid2',
					'img'   => 'images/layout-icons/grid2.png',
					'title' => __( 'Grid 2', 'themify' )
				),
				array(
					'value' => 'list-large-image',
					'img'   => 'images/layout-icons/list-large-image.png',
					'title' => __( 'List Large Image', 'themify' )
				),
				array(
					'value' => 'list-thumb-image',
					'img'   => 'images/layout-icons/list-thumb-image.png',
					'title' => __( 'List Thumb Image', 'themify' )
				),
				array(
					'value' => 'grid2-thumb',
					'img'   => 'images/layout-icons/grid2-thumb.png',
					'title' => __( 'Grid 2 Thumb', 'themify' )
				)
			)
		),
		// Posts Per Page
		array(
			  'name' 		=> 'video_posts_per_page',
			  'title'		=> __('Videos Per Page', 'themify'),
			  'description'	=> '',
			  'type'		=> 'textbox',
			  'meta'		=> array('size' => 'small')
			),

		// Display Content
		array(
			  'name' 		=> 'video_display_content',
			  'title'		=> __('Display Content', 'themify'),
			  'description'	=> '',
			  'type'		=> 'dropdown',
			  'meta'		=> array(
									array('name' => __('Full Content', 'themify'),'value'=>'content','selected'=>true),
									array('name' => __('Excerpt', 'themify'),'value'=>'excerpt'),
									array('name' => __('None', 'themify'),'value'=>'none')
								)
			),
		// Featured Image Size
		array(
			'name'	=>	'video_feature_size_page',
			'title'	=>	__('Image Size', 'themify'),
			'description' => __('Image sizes can be set at <a href="options-media.php">Media Settings</a> and <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerated</a>', 'themify'),
			'type'		 =>	'featimgdropdown'
			),

		// Multi field: Image Dimension
		array(
			'type' => 'multi',
			'name' => '_video_image_dimensions',
			'title' => __('Image Dimensions', 'themify'),
			'meta' => array(
				'fields' => array(
					// Image Width
					array(
					  'name' 		=> 'video_image_width',
					  'label' => __('width', 'themify'),
					  'description' => '',
					  'type' 		=> 'textbox',
					  'meta'		=> array('size'=>'small')
					),
					// Image Height
					array(
					  'name' 		=> 'video_image_height',
					  'label' => __('height', 'themify'),
					  'description' => '',
					  'type' 		=> 'textbox',
					  'meta'		=> array('size'=>'small')
					),
				),
				'description' => __('Enter height = 0 to disable vertical cropping with img.php enabled', 'themify'),
				'before' => '',
				'after' => '',
				'separator' => ''
			)
		),
		// Hide Title
		array(
			  'name' 		=> 'video_hide_title',
			  'title'		=> __('Hide Video Title', 'themify'),
			  'description'	=> '',
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
									array('value' => 'default', 'name' => '', 'selected' => true),
									array('value' => 'yes', 'name' => __('Yes', 'themify')),
									array('value' => 'no',	'name' => __('No', 'themify'))
								)
			),
		// Unlink Post Title
		array(
			  'name' 		=> 'video_unlink_title',
			  'title' 		=> __('Unlink Video Title', 'themify'),
			  'description' => __('Unlink video title (it will display the post title without link)', 'themify'),
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
									array('value' => 'default', 'name' => '', 'selected' => true),
									array('value' => 'yes', 'name' => __('Yes', 'themify')),
									array('value' => 'no',	'name' => __('No', 'themify'))
								)
			),
		// Hide Post Date
		array(
			  'name' 		=> 'video_hide_date',
			  'title'		=> __('Hide Video Date', 'themify'),
			  'description'	=> '',
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
									array('value' => 'default', 'name' => '', 'selected' => true),
									array('value' => 'yes', 'name' => __('Yes', 'themify')),
									array('value' => 'no',	'name' => __('No', 'themify'))
								)
			),
		// Hide Post Meta
		array(
			'name' 		=> 'video_hide_meta_all',
			'title' 	=> __('Hide Video Meta', 'themify'),
			'description' => '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Hide Post Image
		array(
			  'name' 		=> 'video_hide_image',
			  'title' 		=> __('Hide Featured Image', 'themify'),
			  'description' => '',
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Unlink Post Image
		array(
			  'name' 		=> 'video_unlink_image',
			  'title' 		=> __('Unlink Featured Image', 'themify'),
			  'description' => __('Display the Featured Image Without Link', 'themify'),
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Page Navigation Visibility
		array(
			  'name' 		=> 'video_hide_navigation',
			  'title'		=> __('Hide Page Navigation', 'themify'),
			  'description'	=> '',
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
	);
}

/**
 * Gallery Meta Box Options
 * @param array $args
 * @return array
 * @since 1.0.7
 */
function themify_theme_query_gallery_meta_box($args = array()){
	extract( $args );
	return array(
		// Query Category
		array(
			'name' 		=> 'gallery_query_category',
			'title'		=> __('Gallery Category', 'themify'),
			'description'	=> __('Select a gallery category or enter multiple gallery category IDs (eg. 2,5,6). Enter 0 to display all gallery categories.', 'themify'),
			'type'		=> 'query_category',
			'meta'		=> array('taxonomy' => 'gallery-category')
		),
		// Descending or Ascending Order for Galleries
		array(
			'name' 		=> 'gallery_order',
			'title'		=> __('Order', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array('name' => __('Descending', 'themify'), 'value' => 'desc', 'selected' => true),
				array('name' => __('Ascending', 'themify'), 'value' => 'asc')
			)
		),
		// Criteria to Order By
		array(
			'name' 		=> 'gallery_orderby',
			'title'		=> __('Order By', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array('name' => __('Date', 'themify'), 'value' => 'content', 'selected' => true),
				array('name' => __('Random', 'themify'), 'value' => 'rand'),
				array('name' => __('Author', 'themify'), 'value' => 'author'),
				array('name' => __('Post Title', 'themify'), 'value' => 'title'),
				array('name' => __('Comments Number', 'themify'), 'value' => 'comment_count'),
				array('name' => __('Modified Date', 'themify'), 'value' => 'modified'),
				array('name' => __('Post Slug', 'themify'), 'value' => 'name'),
				array('name' => __('Post ID', 'themify'), 'value' => 'ID')
			)
		),
		// Post Layout
		array(
			'name' 		=> 'gallery_layout',
			'title'		=> __('Gallery Layout', 'themify'),
			'description'	=> '',
			'type'		=> 'layout',
			'show_title' => true,
			'meta'		=> array(
				array(
					'value' => 'list-post',
					'img' => 'images/layout-icons/list-post.png',
					'selected' => true
				),
				array(
					'value' => 'grid4',
					'img'   => 'images/layout-icons/grid4.png',
					'title' => __( 'Grid 4', 'themify' )
				),
				array(
					'value' => 'grid3',
					'img'   => 'images/layout-icons/grid3.png',
					'title' => __( 'Grid 3', 'themify' )
				),
				array(
					'value' => 'grid2',
					'img'   => 'images/layout-icons/grid2.png',
					'title' => __( 'Grid 2', 'themify' )
				),
				array(
					'value' => 'list-large-image',
					'img'   => 'images/layout-icons/list-large-image.png',
					'title' => __( 'List Large Image', 'themify' )
				),
				array(
					'value' => 'list-thumb-image',
					'img'   => 'images/layout-icons/list-thumb-image.png',
					'title' => __( 'List Thumb Image', 'themify' )
				),
				array(
					'value' => 'grid2-thumb',
					'img'   => 'images/layout-icons/grid2-thumb.png',
					'title' => __( 'Grid 2 Thumb', 'themify' )
				)
			)
		),
		// Posts Per Page
		array(
			  'name' 		=> 'gallery_posts_per_page',
			  'title'		=> __('Galleries Per Page', 'themify'),
			  'description'	=> '',
			  'type'		=> 'textbox',
			  'meta'		=> array('size' => 'small')
			),

		// Display Content
		array(
			  'name' 		=> 'gallery_display_content',
			  'title'		=> __('Display Content', 'themify'),
			  'description'	=> '',
			  'type'		=> 'dropdown',
			  'meta'		=> array(
									array('name' => __('Full Content', 'themify'),'value'=>'content','selected'=>true),
									array('name' => __('Excerpt', 'themify'),'value'=>'excerpt'),
									array('name' => __('None', 'themify'),'value'=>'none')
								)
			),
		// Featured Image Size
		array(
			'name'	=>	'gallery_feature_size_page',
			'title'	=>	__('Image Size', 'themify'),
			'description' => __('Image sizes can be set at <a href="options-media.php">Media Settings</a> and <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerated</a>', 'themify'),
			'type'		 =>	'featimgdropdown'
			),

		// Multi field: Image Dimension
		array(
			'type' => 'multi',
			'name' => '_gallery_image_dimensions',
			'title' => __('Image Dimensions', 'themify'),
			'meta' => array(
				'fields' => array(
					// Image Width
					array(
					  'name' 		=> 'gallery_image_width',
					  'label' => __('width', 'themify'),
					  'description' => '',
					  'type' 		=> 'textbox',
					  'meta'		=> array('size'=>'small')
					),
					// Image Height
					array(
					  'name' 		=> 'gallery_image_height',
					  'label' => __('height', 'themify'),
					  'description' => '',
					  'type' 		=> 'textbox',
					  'meta'		=> array('size'=>'small')
					),
				),
				'description' => __('Enter height = 0 to disable vertical cropping with img.php enabled', 'themify'),
				'before' => '',
				'after' => '',
				'separator' => ''
			)
		),
		// Hide Title
		array(
			  'name' 		=> 'gallery_hide_title',
			  'title'		=> __('Hide Gallery Title', 'themify'),
			  'description'	=> '',
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
									array('value' => 'default', 'name' => '', 'selected' => true),
									array('value' => 'yes', 'name' => __('Yes', 'themify')),
									array('value' => 'no',	'name' => __('No', 'themify'))
								)
			),
		// Unlink Post Title
		array(
			  'name' 		=> 'gallery_unlink_title',
			  'title' 		=> __('Unlink Gallery Title', 'themify'),
			  'description' => __('Unlink gallery title (it will display the post title without link)', 'themify'),
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
									array('value' => 'default', 'name' => '', 'selected' => true),
									array('value' => 'yes', 'name' => __('Yes', 'themify')),
									array('value' => 'no',	'name' => __('No', 'themify'))
								)
			),
		// Hide Post Date
		array(
			  'name' 		=> 'gallery_hide_date',
			  'title'		=> __('Hide Gallery Date', 'themify'),
			  'description'	=> '',
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
									array('value' => 'default', 'name' => '', 'selected' => true),
									array('value' => 'yes', 'name' => __('Yes', 'themify')),
									array('value' => 'no',	'name' => __('No', 'themify'))
								)
			),
		// Hide Post Meta
		array(
			'name' 		=> 'gallery_hide_meta_all',
			'title' 	=> __('Hide Gallery Meta', 'themify'),
			'description' => '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Hide Post Image
		array(
			  'name' 		=> 'gallery_hide_image',
			  'title' 		=> __('Hide Featured Image', 'themify'),
			  'description' => '',
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Unlink Post Image
		array(
			  'name' 		=> 'gallery_unlink_image',
			  'title' 		=> __('Unlink Featured Image', 'themify'),
			  'description' => __('Display the Featured Image Without Link', 'themify'),
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Page Navigation Visibility
		array(
			  'name' 		=> 'gallery_hide_navigation',
			  'title'		=> __('Hide Page Navigation', 'themify'),
			  'description'	=> '',
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
	);
}

/**
 * Query Albums Meta Box Options
 * @param array $args
 * @return array
 * @since 1.0.7
 */
function themify_theme_query_album_meta_box($args = array()){
	extract( $args );
	return array(
		// Query Category
		array(
			'name' 		=> 'album_query_category',
			'title'		=> __('Album Category', 'themify'),
			'description'	=> __('Select a album category or enter multiple album category IDs (eg. 2,5,6). Enter 0 to display all album categories.', 'themify'),
			'type'		=> 'query_category',
			'meta'		=> array('taxonomy' => 'album-category')
		),
		// Descending or Ascending Order for Videos
		array(
			'name' 		=> 'album_order',
			'title'		=> __('Order', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array('name' => __('Descending', 'themify'), 'value' => 'desc', 'selected' => true),
				array('name' => __('Ascending', 'themify'), 'value' => 'asc')
			)
		),
		// Criteria to Order By
		array(
			'name' 		=> 'album_orderby',
			'title'		=> __('Order By', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array('name' => __('Date', 'themify'), 'value' => 'content', 'selected' => true),
				array('name' => __('Random', 'themify'), 'value' => 'rand'),
				array('name' => __('Author', 'themify'), 'value' => 'author'),
				array('name' => __('Post Title', 'themify'), 'value' => 'title'),
				array('name' => __('Comments Number', 'themify'), 'value' => 'comment_count'),
				array('name' => __('Modified Date', 'themify'), 'value' => 'modified'),
				array('name' => __('Post Slug', 'themify'), 'value' => 'name'),
				array('name' => __('Post ID', 'themify'), 'value' => 'ID'),
				array('name' => __('Artist', 'themify'), 'value' => 'artist')
			)
		),
		// Post Layout
		array(
			'name' 		=> 'album_layout',
			'title'		=> __('Album Layout', 'themify'),
			'description'	=> '',
			'type'		=> 'layout',
			'show_title' => true,
			'meta'		=> array(
				array(
					'value' => 'list-post',
					'img' => 'images/layout-icons/list-post.png',
					'selected' => true
				),
				array(
					'value' => 'grid4',
					'img'   => 'images/layout-icons/grid4.png',
					'title' => __( 'Grid 4', 'themify' )
				),
				array(
					'value' => 'grid3',
					'img'   => 'images/layout-icons/grid3.png',
					'title' => __( 'Grid 3', 'themify' )
				),
				array(
					'value' => 'grid2',
					'img'   => 'images/layout-icons/grid2.png',
					'title' => __( 'Grid 2', 'themify' )
				),
				array(
					'value' => 'list-large-image',
					'img'   => 'images/layout-icons/list-large-image.png',
					'title' => __( 'List Large Image', 'themify' )
				),
				array(
					'value' => 'list-thumb-image',
					'img'   => 'images/layout-icons/list-thumb-image.png',
					'title' => __( 'List Thumb Image', 'themify' )
				),
				array(
					'value' => 'grid2-thumb',
					'img'   => 'images/layout-icons/grid2-thumb.png',
					'title' => __( 'Grid 2 Thumb', 'themify' )
				)
			)
		),
		// Posts Per Page
		array(
			  'name' 		=> 'album_posts_per_page',
			  'title'		=> __('Albums Per Page', 'themify'),
			  'description'	=> '',
			  'type'		=> 'textbox',
			  'meta'		=> array('size' => 'small')
			),

		// Display Content
		array(
			  'name' 		=> 'album_display_content',
			  'title'		=> __('Display Content', 'themify'),
			  'description'	=> '',
			  'type'		=> 'dropdown',
			  'meta'		=> array(
									array('name' => __('Full Content', 'themify'),'value'=>'content','selected'=>true),
									array('name' => __('Excerpt', 'themify'),'value'=>'excerpt'),
									array('name' => __('None', 'themify'),'value'=>'none')
								)
			),
		// Featured Image Size
		array(
			'name'	=>	'album_feature_size_page',
			'title'	=>	__('Image Size', 'themify'),
			'description' => __('Image sizes can be set at <a href="options-media.php">Media Settings</a> and <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerated</a>', 'themify'),
			'type'		 =>	'featimgdropdown'
			),

		// Multi field: Image Dimension
		array(
			'type' => 'multi',
			'name' => '_album_image_dimensions',
			'title' => __('Image Dimensions', 'themify'),
			'meta' => array(
				'fields' => array(
					// Image Width
					array(
					  'name' 		=> 'album_image_width',
					  'label' => __('width', 'themify'),
					  'description' => '',
					  'type' 		=> 'textbox',
					  'meta'		=> array('size'=>'small')
					),
					// Image Height
					array(
					  'name' 		=> 'album_image_height',
					  'label' => __('height', 'themify'),
					  'description' => '',
					  'type' 		=> 'textbox',
					  'meta'		=> array('size'=>'small')
					),
				),
				'description' => __('Enter height = 0 to disable vertical cropping with img.php enabled', 'themify'),
				'before' => '',
				'after' => '',
				'separator' => ''
			)
		),
		// Hide Title
		array(
			  'name' 		=> 'album_hide_title',
			  'title'		=> __('Hide Album Title', 'themify'),
			  'description'	=> '',
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
									array('value' => 'default', 'name' => '', 'selected' => true),
									array('value' => 'yes', 'name' => __('Yes', 'themify')),
									array('value' => 'no',	'name' => __('No', 'themify'))
								)
			),
		// Unlink Post Title
		array(
			  'name' 		=> 'album_unlink_title',
			  'title' 		=> __('Unlink Album Title', 'themify'),
			  'description' => __('Unlink album title (it will display the post title without link)', 'themify'),
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
									array('value' => 'default', 'name' => '', 'selected' => true),
									array('value' => 'yes', 'name' => __('Yes', 'themify')),
									array('value' => 'no',	'name' => __('No', 'themify'))
								)
			),
		// Hide Post Date
		array(
			  'name' 		=> 'album_hide_date',
			  'title'		=> __('Hide Album Date', 'themify'),
			  'description'	=> '',
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
									array('value' => 'default', 'name' => '', 'selected' => true),
									array('value' => 'yes', 'name' => __('Yes', 'themify')),
									array('value' => 'no',	'name' => __('No', 'themify'))
								)
			),
		// Hide Post Meta
		array(
			'name' 		=> 'album_hide_meta_all',
			'title' 	=> __('Hide Album Meta', 'themify'),
			'description' => '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Hide Post Image
		array(
			  'name' 		=> 'album_hide_image',
			  'title' 		=> __('Hide Featured Image', 'themify'),
			  'description' => '',
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Unlink Post Image
		array(
			  'name' 		=> 'album_unlink_image',
			  'title' 		=> __('Unlink Featured Image', 'themify'),
			  'description' => __('Display the Featured Image Without Link', 'themify'),
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Page Navigation Visibility
		array(
			  'name' 		=> 'album_hide_navigation',
			  'title'		=> __('Hide Page Navigation', 'themify'),
			  'description'	=> '',
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
	);
}

/**
 * Query Albums Meta Box Options
 * @param array $args
 * @return array
 * @since 1.0.7
 */
function themify_theme_query_press_meta_box($args = array()){
	extract( $args );
	return array(
		// Query Category
		array(
			'name' 		=> 'press_query_category',
			'title'		=> __('Press Category', 'themify'),
			'description'	=> __('Select a press category or enter multiple press category IDs (eg. 2,5,6). Enter 0 to display all press categories.', 'themify'),
			'type'		=> 'query_category',
			'meta'		=> array('taxonomy' => 'press-category')
		),
		// Descending or Ascending Order for Videos
		array(
			'name' 		=> 'press_order',
			'title'		=> __('Order', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array('name' => __('Descending', 'themify'), 'value' => 'desc', 'selected' => true),
				array('name' => __('Ascending', 'themify'), 'value' => 'asc')
			)
		),
		// Criteria to Order By
		array(
			'name' 		=> 'press_orderby',
			'title'		=> __('Order By', 'themify'),
			'description'	=> '',
			'type'		=> 'dropdown',
			'meta'		=> array(
				array('name' => __('Date', 'themify'), 'value' => 'content', 'selected' => true),
				array('name' => __('Random', 'themify'), 'value' => 'rand'),
				array('name' => __('Author', 'themify'), 'value' => 'author'),
				array('name' => __('Post Title', 'themify'), 'value' => 'title'),
				array('name' => __('Comments Number', 'themify'), 'value' => 'comment_count'),
				array('name' => __('Modified Date', 'themify'), 'value' => 'modified'),
				array('name' => __('Post Slug', 'themify'), 'value' => 'name'),
				array('name' => __('Post ID', 'themify'), 'value' => 'ID')
			)
		),
		// Post Layout
		array(
			'name' 		=> 'press_layout',
			'title'		=> __('Press Layout', 'themify'),
			'description'	=> '',
			'type'		=> 'layout',
			'show_title' => true,
			'meta'		=> array(
				array(
					'value' => 'list-post',
					'img' => 'images/layout-icons/list-post.png',
					'selected' => true
				),
				array(
					'value' => 'grid4',
					'img'   => 'images/layout-icons/grid4.png',
					'title' => __( 'Grid 4', 'themify' )
				),
				array(
					'value' => 'grid3',
					'img'   => 'images/layout-icons/grid3.png',
					'title' => __( 'Grid 3', 'themify' )
				),
				array(
					'value' => 'grid2',
					'img'   => 'images/layout-icons/grid2.png',
					'title' => __( 'Grid 2', 'themify' )
				),
				array(
					'value' => 'list-large-image',
					'img'   => 'images/layout-icons/list-large-image.png',
					'title' => __( 'List Large Image', 'themify' )
				),
				array(
					'value' => 'list-thumb-image',
					'img'   => 'images/layout-icons/list-thumb-image.png',
					'title' => __( 'List Thumb Image', 'themify' )
				),
				array(
					'value' => 'grid2-thumb',
					'img'   => 'images/layout-icons/grid2-thumb.png',
					'title' => __( 'Grid 2 Thumb', 'themify' )
				)
			)
		),
		// Posts Per Page
		array(
			  'name' 		=> 'press_posts_per_page',
			  'title'		=> __('Albums Per Page', 'themify'),
			  'description'	=> '',
			  'type'		=> 'textbox',
			  'meta'		=> array('size' => 'small')
			),

		// Display Content
		array(
			  'name' 		=> 'press_display_content',
			  'title'		=> __('Display Content', 'themify'),
			  'description'	=> '',
			  'type'		=> 'dropdown',
			  'meta'		=> array(
									array('name' => __('Full Content', 'themify'),'value'=>'content','selected'=>true),
									array('name' => __('Excerpt', 'themify'),'value'=>'excerpt'),
									array('name' => __('None', 'themify'),'value'=>'none')
								)
			),
		// Featured Image Size
		array(
			'name'	=>	'press_feature_size_page',
			'title'	=>	__('Image Size', 'themify'),
			'description' => __('Image sizes can be set at <a href="options-media.php">Media Settings</a> and <a href="https://wordpress.org/plugins/regenerate-thumbnails/" target="_blank">Regenerated</a>', 'themify'),
			'type'		 =>	'featimgdropdown'
			),

		// Multi field: Image Dimension
		array(
			'type' => 'multi',
			'name' => '_press_image_dimensions',
			'title' => __('Image Dimensions', 'themify'),
			'meta' => array(
				'fields' => array(
					// Image Width
					array(
					  'name' 		=> 'press_image_width',
					  'label' => __('width', 'themify'),
					  'description' => '',
					  'type' 		=> 'textbox',
					  'meta'		=> array('size'=>'small')
					),
					// Image Height
					array(
					  'name' 		=> 'press_image_height',
					  'label' => __('height', 'themify'),
					  'description' => '',
					  'type' 		=> 'textbox',
					  'meta'		=> array('size'=>'small')
					),
				),
				'description' => __('Enter height = 0 to disable vertical cropping with img.php enabled', 'themify'),
				'before' => '',
				'after' => '',
				'separator' => ''
			)
		),
		// Hide Title
		array(
			  'name' 		=> 'press_hide_title',
			  'title'		=> __('Hide Press Title', 'themify'),
			  'description'	=> '',
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
									array('value' => 'default', 'name' => '', 'selected' => true),
									array('value' => 'yes', 'name' => __('Yes', 'themify')),
									array('value' => 'no',	'name' => __('No', 'themify'))
								)
			),
		// Unlink Post Title
		array(
			  'name' 		=> 'press_unlink_title',
			  'title' 		=> __('Unlink Press Title', 'themify'),
			  'description' => __('Unlink press title (it will display the post title without link)', 'themify'),
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
									array('value' => 'default', 'name' => '', 'selected' => true),
									array('value' => 'yes', 'name' => __('Yes', 'themify')),
									array('value' => 'no',	'name' => __('No', 'themify'))
								)
			),
		// Hide Post Date
		array(
			  'name' 		=> 'press_hide_date',
			  'title'		=> __('Hide Press Date', 'themify'),
			  'description'	=> '',
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
									array('value' => 'default', 'name' => '', 'selected' => true),
									array('value' => 'yes', 'name' => __('Yes', 'themify')),
									array('value' => 'no',	'name' => __('No', 'themify'))
								)
			),
		// Hide Post Meta
		array(
			'name' 		=> 'press_hide_meta_all',
			'title' 	=> __('Hide Press Meta', 'themify'),
			'description' => '',
			'type' 		=> 'dropdown',
			'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Hide Post Image
		array(
			  'name' 		=> 'press_hide_image',
			  'title' 		=> __('Hide Featured Image', 'themify'),
			  'description' => '',
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Unlink Post Image
		array(
			  'name' 		=> 'press_unlink_image',
			  'title' 		=> __('Unlink Featured Image', 'themify'),
			  'description' => __('Display the Featured Image Without Link', 'themify'),
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
		// Page Navigation Visibility
		array(
			  'name' 		=> 'press_hide_navigation',
			  'title'		=> __('Hide Page Navigation', 'themify'),
			  'description'	=> '',
			  'type' 		=> 'dropdown',
			  'meta'		=> array(
				array('value' => 'default', 'name' => '', 'selected' => true),
				array('value' => 'yes', 'name' => __('Yes', 'themify')),
				array('value' => 'no',	'name' => __('No', 'themify'))
			)
		),
	);
}

/**
 * Default Page Layout Module
 * @param array $data Theme settings data
 * @return string Markup for module.
 * @since 1.0.0
 */
function themify_default_page_layout($data = array()){
	$data = themify_get_data();

	/**
	 * Theme Settings Option Key Prefix
	 * @var string
	 */
	$prefix = 'setting-default_page_';

	/**
	 * Sidebar placement options
	 * @var array
	 */
	$sidebar_location_options = array(
		array('value' => 'sidebar1', 'img' => 'images/layout-icons/sidebar1.png', 'selected' => true, 'title' => __('Sidebar Right', 'themify')),
		array('value' => 'sidebar1 sidebar-left', 'img' => 'images/layout-icons/sidebar1-left.png', 'title' => __('Sidebar Left', 'themify')),
		array('value' => 'sidebar-none', 'img' => 'images/layout-icons/sidebar-none.png', 'title' => __('No Sidebar', 'themify'))
	);

	/**
	 * Tertiary options <blank>|yes|no
	 * @var array
	 */
	$default_options = array(
		array('name' => '', 'value' => ''),
		array('name' => __('Yes', 'themify'), 'value' => 'yes'),
		array('name' => __('No', 'themify'), 'value' => 'no')
	);

	/**
	 * Module markup
	 * @var string
	 */
	$output = '';

	/**
	 * Page sidebar placement
	 */
	$output .= '<p>
					<span class="label">' . __('Page Sidebar Option', 'themify') . '</span>';
	$val = isset( $data[$prefix.'layout'] ) ? $data[$prefix.'layout'] : '';
	foreach ( $sidebar_location_options as $option ) {
		if ( ( '' == $val || ! $val || ! isset( $val ) ) && ( isset( $option['selected'] ) && $option['selected'] ) ) {
			$val = $option['value'];
		}
		if ( $val == $option['value'] ) {
			$class = "selected";
		} else {
			$class = "";
		}
		$output .= '<a href="#" class="preview-icon '.$class.'" title="'.$option['title'].'"><img src="'.THEME_URI.'/'.$option['img'].'" alt="'.$option['value'].'"  /></a>';
	}
	$output .= '<input type="hidden" name="'.$prefix.'layout" class="val" value="'.$val.'" /></p>';

	/**
	 * Hide Title in All Pages
	 */
	$output .= '<p>
					<span class="label">' . __('Hide Title in All Pages', 'themify') . '</span>
					<select name="setting-hide_page_title">'.
						themify_options_module($default_options, 'setting-hide_page_title') . '
					</select>
				</p>';

    /**
     * Hide Feauted images in All Pages
     */
    $output .= '<p>
                    <span class="label">' . __('Hide Featured Image', 'themify') . '</span>
                    <select name="setting-hide_page_image">' .
                        themify_options_module($default_options, 'setting-hide_page_image') . '
                    </select>
                </p>';
	/**
	 * Page Comments
	 */
	$pre = 'setting-comments_pages';
	$output .= '<p><span class="label">' . __('Page Comments', 'themify') . '</span><label for="'.$pre.'"><input type="checkbox" id="'.$pre.'" name="'.$pre.'" ' . checked( themify_get( $pre ), 'on', false ) . ' /> ' . __('Disable comments in all Pages', 'themify') . '</label></p>';

	return $output;
}