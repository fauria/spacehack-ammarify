<?php
/**
 * Template for video post type display.
 * @package themify
 * @since 1.0.0
 */
?>
<?php if(!is_singular( 'gallery' )){ global $more; $more = 0; } //enable more link ?>

<?php
/** Themify Default Variables
 *  @var object */
global $themify; ?>

<?php themify_post_before(); // hook ?>
<article id="post-<?php the_id(); ?>" <?php post_class('post clearfix gallery-post'); ?>>
	<?php themify_post_start(); // hook ?>

	<?php if ( ! is_singular( 'gallery' ) ) : ?>
		<?php get_template_part( 'includes/post-media', get_post_type()); ?>
	<?php endif; ?>

	<div class="post-content">

		<?php if ( ! is_singular( 'gallery' ) ) : ?>

			<?php if ( $themify->hide_meta != 'yes' || $themify->hide_date != 'yes' ) : ?>
				<div class="post-meta entry-meta">

					<?php if ( $themify->hide_date != 'yes' && ( ! is_single() || isset( $themify->is_shortcode ) ) ): ?>

						<time datetime="<?php the_time('o-m-d') ?>" class="post-date entry-date updated">
							<span class="day"><?php the_time( 'j' ); ?></span>
							<span class="month"><?php the_time( 'M' ); ?></span>
							<span class="year"><?php the_time( 'Y' ); ?></span>
						</time>

					<?php endif; //post date ?>

					<?php if($themify->hide_meta != 'yes'): ?>
						<?php the_terms( get_the_id(), 'gallery-category', ' <span class="post-category">', ', ', '</span>' ); ?>
						<?php the_terms( get_the_id(), 'gallery-tag', ' <span class="post-tag">', ', ', '</span>' ); ?>
					<?php endif; //post categories and tags ?>

				</div>
			<?php endif; //post meta ?>

			<?php if($themify->hide_title != 'yes'): ?>
				<?php themify_before_post_title(); // Hook ?>
				<?php if($themify->unlink_title == 'yes'): ?>
					<h2 class="post-title entry-title"><?php the_title(); ?></h2>
				<?php else: ?>
					<h2 class="post-title entry-title"><a href="<?php echo themify_get_featured_image_link(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<?php endif; //unlink post title ?>
				<?php themify_after_post_title(); // Hook ?>
			<?php endif; //post title ?>

		<?php endif; // single view ?>

		<div class="entry-content">

			<?php if ( 'excerpt' == $themify->display_content && ! is_attachment() ) : ?>

				<?php if ( ! is_single() ) : ?>

					<?php
					// Short excerpt for index/archive views
					echo apply_filters( 'themify_theme_trim_excerpt', wp_trim_words( get_the_excerpt(), 12, ' <a href="'. get_permalink() .'">' . __(  'Read More', 'themify' ) . '</a>' ), 12, get_permalink() ); ?>

				<?php else: ?>

					<?php the_excerpt(); ?>

					<?php if( themify_check('setting-excerpt_more') ) : ?>
						<p><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute('echo=0'); ?>" class="more-link"><?php echo themify_check('setting-default_more_text')? themify_get('setting-default_more_text') : __('More &rarr;', 'themify') ?></a></p>
					<?php endif; ?>

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
