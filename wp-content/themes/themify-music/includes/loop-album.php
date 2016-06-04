<?php
/**
 * Template for album post type display.
 * @package themify
 * @since 1.0.0
 */
?>
<?php if(!is_singular( 'album' )){ global $more; $more = 0; } //enable more link ?>

<?php
/** Themify Default Variables
 *  @var object */
global $themify; ?>

<?php themify_post_before(); // hook ?>
<article id="post-<?php the_id(); ?>" <?php post_class('post clearfix album-post'); ?>>
	<?php themify_post_start(); // hook ?>

	<?php if ( ! is_singular( 'album' ) || ( is_singular( 'album' ) && isset( $themify->is_shortcode ) && $themify->is_shortcode ) ) : ?>
		<?php get_template_part( 'includes/post-media', get_post_type()); ?>
	<?php endif; ?>

	<div class="post-content">

		<?php if ( ! is_singular( 'album' ) || ( is_singular( 'album' ) && isset( $themify->is_shortcode ) && $themify->is_shortcode ) ) : ?>

			<?php if ( $themify->hide_title != 'yes' ): ?>
				<?php themify_before_post_title(); // Hook ?>
				<?php if ( $themify->unlink_title == 'yes' ): ?>
					<h2 class="post-title entry-title"><?php the_title(); ?></h2>
				<?php else: ?>
					<h2 class="post-title entry-title">
						<a href="<?php echo themify_get_featured_image_link(); ?>" data-album="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="album-title-link"><?php the_title(); ?></a>
					</h2>
				<?php endif; //unlink post title ?>
				<?php themify_after_post_title(); // Hook ?>
			<?php endif; //post title ?>

			<ul class="record-details">
				<?php if ( $artist = themify_get( 'artist' ) ) : ?>
					<li>
						<h6 class="record-artist"><?php _e( 'Artist', 'themify' ); ?></h6>
						<p class="record-artist"><?php echo $artist; ?></p>
					</li>
				<?php endif; // artist?>
				<?php if ( $released = themify_get( 'released' ) ) : ?>
					<li>
						<h6 class="record-release"><?php _e( 'Released', 'themify' ); ?></h6>
						<p class="record-release"><?php echo $released; ?></p>

					</li>
				<?php endif; // released ?>
				<?php if ( $genre = themify_get( 'genre' ) ) : ?>
					<li>
						<h6 class="record-genre"><?php _e( 'Genre', 'themify' ); ?></h6>
						<p class="record-genre"><?php echo $genre; ?></p>
					</li>
				<?php endif; // genre ?>
			</ul>

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
