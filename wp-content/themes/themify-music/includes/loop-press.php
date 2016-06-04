<?php
/**
 * Template for press post type display.
 * @package themify
 * @since 1.0.0
 */
?>
<?php if(!is_singular( 'press' )){ global $more; $more = 0; } //enable more link ?>

<?php
/** Themify Default Variables
 *  @var object */
global $themify; ?>

<?php themify_post_before(); // hook ?>
<article id="post-<?php the_id(); ?>" <?php post_class('post clearfix press-post'); ?>>
	<?php themify_post_start(); // hook ?>

	<?php if ( ! is_singular( 'press' ) ) : ?>
		<?php get_template_part( 'includes/post-media', get_post_type()); ?>
		<div class="post-meta entry-meta clearfix">
			<time class="post-date entry-date updated" datetime="<?php the_time( 'o-m-d' ) ?>">
				<span class="day"><?php the_time( 'j' ); ?></span>
				<span class="month"><?php the_time( 'M' ); ?></span>
				<span class="year"><?php the_time( 'Y' ); ?></span>
			</time>
		</div>
	<?php endif; ?>

	<div class="post-content">

		<?php if ( ! is_singular( 'press' ) ) : ?>

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

			<div class="press-meta-wrapper">
				<?php if ( $themify->hide_meta != 'yes' ): ?>
					<?php if ( $themify->hide_meta_category != 'yes' ): ?>
						<?php the_terms( get_the_id(), 'post' != get_post_type() ? get_post_type() . '-category' : 'category', ' <span class="post-category">', ', ', '</span>' ); ?>
					<?php endif; // meta category ?>

					<?php if ( $themify->hide_meta_tag != 'yes' ): ?>
						<?php the_terms( get_the_id(), 'post' != get_post_type() ? get_post_type() . '-tag' : 'post_tag', ' <span class="post-tag">', ', ', '</span>' ); ?>
					<?php endif; // meta tag ?>
				<?php endif; //post meta ?>

				<?php get_template_part( 'includes/social-share' ); ?>
			</div>

		<?php endif; // is single ?>

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
