<?php
/**
 * Template for event post type display.
 * @package themify
 * @since 1.0.0
 */
?>
<?php if(!is_singular( 'event' )){ global $more; $more = 0; } //enable more link ?>

<?php
/** Themify Default Variables
 *  @var object */
global $themify, $themify_event;
$is_singular  =  is_singular( 'event' );
?>

<?php themify_post_before(); // hook ?>
<article id="post-<?php the_id(); ?>" <?php post_class('post clearfix event-post'); ?>>
	<?php themify_post_start(); // hook ?>

	<?php if ( !$is_singular || ( isset( $themify->is_event_widget ) && $themify->is_event_widget ) ) : ?>

		<?php get_template_part( 'includes/post-media',	'event' ); ?>

	<?php endif; // is not single ?>

	<div class="post-content">

		<?php if ( !$is_singular || ( isset( $themify->is_event_widget ) && $themify->is_event_widget ) ) : ?>
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

			<div class="<?php echo $is_singular ? 'event-single-wrap clearfix' : 'event-info-wrap'; ?>">

				<?php if ( themify_check( 'location' ) && ( isset( $themify->hide_event_location ) && $themify->hide_event_location != 'yes' ) ) : ?>
					<span class="location">
						<span><?php echo themify_get( 'location' ); ?></span>
					</span>
				<?php endif; ?>

				<?php
				$has_start_date = themify_check( 'start_date' );
				$has_end_date = themify_check( 'end_date' );
				if ( ( $has_start_date || $has_end_date ) && ( isset( $themify->hide_event_date ) && $themify->hide_event_date != 'yes' ) ) : ?>
					<p class="event-date">
                        <?php $repeat = false;?>
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
	                            <?php
	                            echo $repeat?
									themify_theme_get_repeat_date($repeat, $repeat_x,$start_date_parts[0], $start_date_parts[1])
									:(date_i18n( get_option( 'date_format' ), strtotime( $start_date_parts[0] ) ) . _x( ' @ ', 'Connector between date and time (with spaces around itself) in event date and time.', 'themify' ) . date_i18n( get_option( 'time_format' ), strtotime( $start_date_parts[1] ) ) );
	                            ?>
                            </span>
						<?php endif; // has start date ?>

                    	<?php if (!$repeat && $has_end_date  && ($is_singular || (!$is_singular && !themify_check( 'event_end_date_hide' )))) :
							$end_date = themify_get( 'end_date' );
							$end_date_parts = explode( '@', $end_date ); ?>
							<span class="event-end-date">
	                            <?php echo !isset($start_date_parts) || $start_date_parts[0]!=$end_date_parts[0]?_x( ' &#8211; ', 'Character to provide a hint that this is the event end date and time.', 'themify' ) . date_i18n( get_option( 'date_format' ), strtotime( $end_date_parts[0] ) ):' &#8211; ';
	                                  echo  _x( ' @ ', 'Connector between date and time (with spaces around itself) in event date and time.', 'themify' ) . date_i18n( get_option( 'time_format' ), strtotime( $end_date_parts[1] ) ) ;
	                            ?>
                            </span>
						<?php endif; ?>
					</p>
					<!-- /event-date -->
				<?php endif; // has start or end date and not hide event date ?>

			</div><!-- /.event-info -->

			<div class="event-cta-wrapper">
				<?php get_template_part( 'includes/social-share' ); ?>
				<?php if ( themify_check( 'buy_tickets' ) ) : ?>
					<a href="<?php echo themify_get( 'buy_tickets' ); ?>" class="buy-button">
						<span class="ticket"></span> <?php _e( 'Buy Tickets', 'themify' ); ?>
					</a>
				<?php endif; ?>
			</div>
			<!-- event-cta-wrapper -->

		<?php endif; // is not single ?>

		<div class="entry-content">

			<?php if ( 'excerpt' == $themify->display_content && ! is_attachment() ) : ?>

				<?php the_excerpt(); ?>

				<?php if( themify_check('setting-excerpt_more') ) : ?>
					<p><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute('echo=0'); ?>" class="more-link"><?php echo themify_check('setting-default_more_text')? themify_get('setting-default_more_text') : __('More &rarr;', 'themify') ?></a></p>
				<?php endif; ?>

			<?php elseif($themify->display_content == 'none'): ?>

			<?php else: ?>

				<?php the_content(themify_check('setting-default_more_text')? themify_get('setting-default_more_text') : __('More &rarr;', 'themify')); ?>

			<?php endif; //display content ?>

		</div><!-- /.entry-content -->

		<?php edit_post_link(__('Edit', 'themify'), '<span class="edit-button">[', ']</span>'); ?>

	</div>
	<!-- /.post-content -->
	<?php themify_post_end(); // hook ?>

</article>
<!-- /.post -->
<?php themify_post_after(); // hook ?>
