<?php
/**
 * Template for single post view
 * @package themify
 * @since 1.0.0
 */
?>

<?php get_header(); ?>

<?php
/** Themify Default Variables
 *  @var object */
global $themify, $themify_event;
?>

<?php if( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<!-- layout-container -->
	<div id="layout" class="pagewidth clearfix">

		<?php if ( is_single() ) : ?>
			<?php if ( $themify->hide_title != 'yes' ): ?>
				<?php themify_before_post_title(); // Hook ?>
				<?php if ( $themify->unlink_title == 'yes' ): ?>
					<h2 class="post-title entry-title"><?php the_title(); ?></h2>
				<?php else: ?>
					<h2 class="post-title entry-title">
						<a href="<?php echo themify_get_featured_image_link(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
					</h2>
				<?php endif; //unlink post title ?>
				<?php themify_after_post_title(); // Hook ?>
			<?php endif; //post title ?>
		<?php endif; // is single ?>

		<div class="event-single-wrap clearfix">

			<div class="event-map">
				<?php echo $themify_event->get_map( themify_get( 'map_address' ) ); ?>
			</div><!-- /.event-map -->

			<div class="event-single-details">

				<?php get_template_part( 'includes/post-media',	'event' ); ?>

				<div class="event-info-wrap">

					<?php
					$has_start_date = themify_check( 'start_date' );
					$has_end_date = themify_check( 'end_date' );
					if ( ( $has_start_date || $has_end_date ) ) : ?>
                                                <?php $repeat = false;?>
						<p class="event-date">
							<?php if ( $has_start_date ) :
                                $repeat = themify_get('repeat');
                                if($repeat){
                                    $repeat_x = intval(themify_get('repeat_x'));
                                    if(!$repeat_x || $repeat_x<0){
                                        $repeat = false;
                                    }
                                }
								$start_date = themify_get( 'start_date' );
								$start_date_parts = explode( '@', $start_date );
								?>
								<span class="event-start-date">
                                    <?php  echo $repeat?
		                                themify_theme_get_repeat_date($repeat, $repeat_x,$start_date_parts[0], $start_date_parts[1]):
		                                date_i18n( get_option( 'date_format' ), strtotime( $start_date_parts[0] ) ) . _x( ' @ ', 'Connector between date and time (with spaces around itself) in event date and time.', 'themify' ) . date_i18n( get_option( 'time_format' ), strtotime( $start_date_parts[1] ) );
									?>
                                </span>
							<?php endif; // has start date ?>

							<?php if (!$repeat && $has_end_date ) :
								$end_date = themify_get( 'end_date' );
								$end_date_parts = explode( '@', $end_date ); ?>
								<span class="event-end-date">
                                    <?php
                                          echo !isset($start_date_parts) || $start_date_parts[0]!=$end_date_parts[0]?_x( ' &#8211; ', 'Character to provide a hint that this is the event end date and time.', 'themify' ) . date_i18n( get_option( 'date_format' ), strtotime( $end_date_parts[0] ) ):' &#8211; ';
                                          echo  _x( ' @ ', 'Connector between date and time (with spaces around itself) in event date and time.', 'themify' ) . date_i18n( get_option( 'time_format' ), strtotime( $end_date_parts[1] ) );
                                    ?>
                                </span>
							<?php endif; ?>
						</p>
						<!-- /event-date -->
					<?php endif; // has start or end date and not hide event date ?>

					<?php if ( themify_check( 'location' ) ) : ?>
						<span class="location">
								<?php echo themify_get( 'location' ); ?>
							</span>
					<?php endif; ?>

					<?php if ( is_singular( 'event' ) && themify_check( 'map_address' ) ) : ?>
						<div class="address">
							<?php echo wpautop( themify_get( 'map_address' ) ); ?>
						</div>
						<!-- /address -->
					<?php endif; ?>

				</div>
				<!-- / .event-info-wrap -->

				<div class="event-cta-wrapper clearfix">

					<?php get_template_part( 'includes/social-share' ); ?>
					<?php if ( themify_check( 'buy_tickets' ) ) : ?>
						<a href="<?php echo themify_get( 'buy_tickets' ); ?>" class="buy-button">
							<span class="ticket"></span> <?php _e( 'Buy Tickets', 'themify' ); ?>
						</a>
					<?php endif; ?>

				</div><!-- event-cta-wrapper -->

			</div><!-- / .event-single-details -->
		</div>

		<?php themify_content_before(); // hook ?>
		<!-- content -->
		<div id="content" class="list-post">
			<?php themify_content_start(); // hook ?>

			<?php get_template_part( 'includes/loop', get_post_type()); ?>

			<?php wp_link_pages( array( 'before' => '<p class="post-pagination"><strong>' . __( 'Pages:', 'themify' ) . ' </strong>', 'after' => '</p>', 'next_or_number' => 'number' ) ); ?>

			<?php get_template_part( 'includes/author-box', 'single' ); ?>

			<?php get_template_part( 'includes/post-nav' ); ?>

			<?php if(!themify_check('setting-comments_posts')): ?>
				<?php comments_template(); ?>
			<?php endif; ?>

			<?php themify_content_end(); // hook ?>
		</div>
		<!-- /content -->
		<?php themify_content_after(); // hook ?>

		<?php
		/////////////////////////////////////////////
		// Sidebar
		/////////////////////////////////////////////
		if ($themify->layout != "sidebar-none"): get_sidebar(); endif; ?>

	</div>
	<!-- /layout-container -->

<?php endwhile; ?>

<?php get_footer(); ?>
