<?php
/**
 * Gallery Media Template.
 * If there's a Video URL in Themify Custom Panel it will show it, otherwise shows the featured image.
 * @package themify
 * @since 1.0.0
 */

/** Themify Default Variables
 *  @var object */
global $themify, $themify_gallery; ?>

<?php if ( $themify->hide_image != 'yes' ) : ?>
	<?php themify_before_post_image(); // Hook ?>

	<?php
	/**
 	 * GALLERY VIDEO
	 */
	if ( themify_get( 'video_url' ) != '' ) : ?>

		<figure class="post-image">
			<?php
				global $wp_embed;
				echo $wp_embed->run_shortcode('[embed]' . themify_get('video_url') . '[/embed]');
			?>
		</figure>

	<?php
	/**
	 * GALLERY FEATURED IMAGE
	 */
	elseif( $post_image = themify_get_image( $themify->auto_featured_image . $themify->image_setting . 'w=' . $themify->width . '&h=' . $themify->height . '&ignore=true'  ) ) : ?>

		<figure class="post-image <?php echo $themify->image_align; ?>">

			<?php if( 'yes' == $themify->unlink_image): ?>
				<?php echo $post_image; ?>
			<?php else: ?>
				<a href="<?php echo themify_get_featured_image_link(); ?>"><?php echo $post_image; ?><?php themify_zoom_icon(); ?></a>
			<?php endif; // unlink image ?>

		</figure>

	<?php endif; // gallery if video elseif gallery elseif image ?>

	<?php themify_after_post_image(); // Hook ?>
<?php endif; // hide image ?>
