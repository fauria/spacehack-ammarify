<?php
/**
 * Video Media Template.
 * If there's a Video URL in Themify Custom Panel it will fetch the thumbnail from the online service and show it, otherwise shows the featured image.
 * @package themify
 * @since 1.0.0
 */

/** Themify Default Variables
 *  @var object */
global $themify, $themify_video; ?>

<?php if ( $themify->hide_image != 'yes' ) : ?>
	<?php themify_before_post_image(); // Hook ?>

	<?php
	if ( ( themify_get( 'video_url' ) || themify_get( 'video_file' ) ) != '' && is_singular( 'video' ) ) : ?>

		<figure class="post-image">
			<?php
			if ( themify_check( 'video_type' ) && themify_get( 'video_type' ) && themify_check( 'video_file' ) && '' != themify_get( 'video_file' )
			) {
				echo do_shortcode('[video src="' . themify_get( 'video_file' ) . '"]');
			} else {
				global $wp_embed;
				echo $wp_embed->run_shortcode('[embed]' . themify_get('video_url') . '[/embed]');
			}
			?>
		</figure>

	<?php else: ?>
		<?php
		if ( 'yes' == $themify->use_original_dimensions ) {
			$themify->width = themify_get( 'image_width' );
			$themify->height = themify_get( 'image_height' );
		}
		$post_image = themify_get_image( 'ignore=true&w='.$themify->width.'&h='.$themify->height  );
		if ( ! isset( $post_image ) || '' == $post_image ) {
			// There is no featured image, get video service image
			$post_image = $themify_video->fetch_video_image( true, $themify->width );
		}
		?>
		<?php if( isset( $post_image ) && '' != $post_image ) : ?>
			<?php
			// Collect images for video thumbnails carousel
			$themify_video->thumbnails .= '<a href="#" class="video-pager-thumb">'.$post_image.'</a>';
			?>
			<figure class="post-image thumb-src <?php echo $themify->image_align; ?>" <?php echo $themify_video->data_thumb( $post_image ); ?>>

				<?php if( 'yes' == $themify->unlink_image): ?>
					<?php echo $post_image; ?>
				<?php else: ?>
					<a href="<?php echo $themify_video->get_featured_image_link(); ?>"><?php echo $post_image; ?><?php themify_zoom_icon(); ?></a>
				<?php endif; // unlink image ?>

			</figure>

		<?php endif; // if there's a featured image?>

	<?php endif; // video else image ?>

	<?php themify_after_post_image(); // Hook ?>
<?php endif; // hide image ?>
