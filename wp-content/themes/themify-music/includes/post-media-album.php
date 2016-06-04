<?php
/**
 * Album Media Template.
 * If there's a Video URL in Themify Custom Panel it will show it, otherwise shows the featured image.
 * @package themify
 * @since 1.0.0
 */

/** Themify Default Variables
 *  @var object */
global $themify; ?>

<?php if ( $themify->hide_image != 'yes' ) : ?>
	<?php themify_before_post_image(); // Hook ?>

	<?php
	if ( themify_get( 'video_url' ) != '' ) : ?>

		<figure class="post-image">
			<?php
				global $wp_embed;
				echo $wp_embed->run_shortcode('[embed]' . themify_get('video_url') . '[/embed]');
			?>
		</figure>

	<?php else: ?>

		<?php
		if ( 'yes' == $themify->use_original_dimensions ) {
			$themify->width = themify_get( 'image_width' );
			$themify->height = themify_get( 'image_height' );
		} elseif ( is_singular( 'album' ) ) {
			$side = themify_check( 'image_width' ) ? themify_get( 'image_width' ) : 363;
			list( $w, $h ) = apply_filters( 'themify_theme_album_single_image_dimensions', array( $side, $side ) );
			$themify->width = $w;
			$themify->height = $h;
		}
		$post_in_lightbox = isset( $_GET['post_in_lightbox'] ) ? $_GET['post_in_lightbox'] : '';
		?>

		<?php if( $post_image = themify_get_image( 'ignore=true&w='.$themify->width.'&h='.$themify->height  ) ) : ?>

			<figure class="post-image <?php echo $themify->image_align; ?>">

				<a href="<?php echo themify_get_featured_image_link(); ?>" <?php if ( $post_in_lightbox != '1' ) echo 'class="themify-lightbox"' ?> data-album="<?php the_permalink(); ?>"><?php echo $post_image; ?><?php themify_zoom_icon(); ?></a>

			</figure>

		<?php endif; // if there's a featured image?>

	<?php endif; // video else image ?>

	<?php themify_after_post_image(); // Hook ?>
<?php endif; // hide image ?>
