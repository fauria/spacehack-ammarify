<?php
/**
 * Template for page view including query categories
 * @package themify
 * @since 1.0.0
 */
?>

<?php get_header(); ?>

<?php
/** Themify Default Variables
 *  @var object */
global $themify; ?>

<!-- layout-container -->
<div id="layout" class="pagewidth clearfix">

	<?php themify_content_before(); // hook ?>
	<!-- content -->
	<div id="content" class="clearfix">
    	<?php themify_content_start(); // hook ?>

		<?php
		/////////////////////////////////////////////
		// 404
		/////////////////////////////////////////////
		if(is_404()): ?>
			<h1 class="page-title"><?php _e('404','themify'); ?></h1>
			<p><?php _e( 'Page not found.', 'themify' ); ?></p>
		<?php endif; ?>

		<?php
		/////////////////////////////////////////////
		// PAGE
		/////////////////////////////////////////////
		?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div id="page-<?php the_ID(); ?>" class="type-page">

			<!-- page-title -->
			<?php if($themify->page_title != "yes"): ?>
				
				<time datetime="<?php the_time( 'o-m-d' ); ?>"></time>
				<h2 class="page-title"><?php the_title(); ?></h2>
			<?php endif; ?>
			<!-- /page-title -->

			<div class="page-content entry-content">

				<?php if ( $themify->hide_page_image != 'yes' && has_post_thumbnail() ) : ?>
					<figure class="post-image"><?php themify_image( "{$themify->auto_featured_image}w={$themify->page_image_width}&h=0&ignore=true" ); ?></figure>
				<?php endif; ?>

				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => '<p class="post-pagination"><strong>'.__('Pages:','themify').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

				<?php edit_post_link(__('Edit','themify'), '[', ']'); ?>

				<!-- comments -->
				<?php if(!themify_check('setting-comments_pages') && $themify->query_category == ""): ?>
					<?php comments_template(); ?>
				<?php endif; ?>
				<!-- /comments -->

			</div>
			<!-- /.post-content -->

			</div><!-- /.type-page -->
		<?php endwhile; endif; ?>

		<?php
		/////////////////////////////////////////////
		// Query Category
		/////////////////////////////////////////////
		?>
		<?php if($themify->query_category != ''): ?>

			<?php
			// Categories for Query Posts or Portfolios
			$categories = '0' == $themify->query_category? themify_get_all_terms_ids($themify->query_taxonomy) : explode(',', str_replace(' ', '', $themify->query_category));
			$qpargs = array(
				'post_type' => $themify->query_post_type,
				'tax_query' => array(
					array(
						'taxonomy' => $themify->query_taxonomy,
						'field' => 'id',
						'terms' => $categories
					)
				),
				'posts_per_page' => $themify->posts_per_page,
				'paged' => $themify->paged,
				'order' => $themify->order,
				'orderby' => $themify->orderby
			);

			if( 'album' == $themify->query_post_type ) {
				if( 'artist' == $themify->orderby ) {
					$qpargs['orderby'] = 'meta_value';
					$qpargs['meta_key'] = 'artist';
				}
			}

			if( 'event' == $themify->query_post_type ) {
				global $themify_event;
				// ordered by event date
				if ( 'meta_value' == themify_get( 'event_orderby' ) ) {
					$qpargs = wp_parse_args( $qpargs, apply_filters( 'themify_theme_event_sorting', array(
						'meta_key' => 'start_date',
					)));
				}
				if( 'yes' == themify_get( 'event_hide_past_events' ) ) { // show upcoming events only
					$qpargs['meta_query'] = array(
						'relation' => 'OR',
						array(
							'key' => 'end_date',
							'value' => date_i18n( $themify_event->date_time_format ),
							'compare' => '>'
						),
						array(
							'key' => 'end_date',
							'compare' => 'NOT EXISTS'
						),
						array(
							'key' => 'end_date',
							'value' => '',
							'compare' => '='
						),
					);
				} elseif( 'no' == themify_get( 'event_hide_past_events' ) ) { // show only past events
					$qpargs['meta_query'] = array(
						'relation' => 'AND',
						array(
							'key' => 'end_date',
							'value' => date_i18n( $themify_event->date_time_format ),
							'compare' => '<'
						),
						array(
							'key' => 'end_date',
							'value' => '',
							'compare' => '!='
						),
					);
				}
			}
			?>

			<?php
			query_posts(apply_filters('themify_query_posts_page_args', $qpargs)); ?>

			<?php if(have_posts()): ?>

				<!-- loops-wrapper -->
				<div id="loops-wrapper" class="loops-wrapper <?php echo "$themify->layout $themify->post_layout "; echo isset( $themify->query_post_type ) && ! in_array( $themify->query_post_type, array( 'post', 'page' ) ) ? $themify->query_post_type : ''; ?>">

					<?php while(have_posts()) : the_post(); ?>

						<?php get_template_part('includes/loop', $themify->query_post_type); ?>

					<?php endwhile; ?>

				</div>
				<!-- /loops-wrapper -->

				<?php if(themify_is_query_page() && 'section' != $themify->query_post_type) { ?>
					<?php if ($themify->page_navigation != 'yes'): ?>
						<?php get_template_part( 'includes/pagination'); ?>
					<?php endif; ?>
				<?php } ?>

			<?php endif; // have_posts() ?>

			<?php wp_reset_query(); ?>

		<?php endif; // is query page ?>

		<?php themify_content_end(); // hook ?>
	</div>
	<!-- /content -->
    <?php themify_content_after(); // hook ?>

	<?php
	/////////////////////////////////////////////
	// Sidebar
	/////////////////////////////////////////////
	//if ($themify->layout != 'sidebar-none'): get_sidebar(); endif; ?>

	

</div>
<!-- /layout-container -->

<?php get_footer(); ?>
