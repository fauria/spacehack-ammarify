<?php
/**
 * Template for single gallery post view
 * @package themify
 * @since 1.0.0
 */
?>

<?php get_header(); ?>

<?php
/** Themify Default Variables
 *  @var object */
global $themify, $themify_gallery;
?>

<?php if( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<!-- layout-container -->
	<div id="layout" class="pagewidth clearfix">

		<?php if ( is_single() ) : ?>

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

		<div id="featured-area-<?php the_ID(); ?>" class="gallery-wrapper masonry clearfix gallery-columns-<?php echo $themify_gallery->get_gallery_columns(); ?>">

			<?php
			/**
			 * GALLERY TYPE: GALLERY
			 */
			if ( themify_get( 'gallery_shortcode' ) != '' ) : ?>

				<?php
				$images = $themify_gallery->get_gallery_images();
				if ( $images ) : $counter = 0; ?>

					<?php foreach ( $images as $image ) :
						$counter++;

						$caption = $themify_gallery->get_caption( $image );
						$description = $themify_gallery->get_description( $image );
						if ( $caption ) {
							$alt = $caption;
						} elseif ( $description ) {
							$alt = $description;
						} else {
							$alt = the_title_attribute('echo=0');
						}
						$featured = get_post_meta( $image->ID, 'themify_gallery_featured', true );
						if ( $featured && '' != $featured ) {
							$img_size = array(
								'width' => 350,
								'height' => 400,
							);
						} else {
							$img_size = array(
								'width' => 350,
								'height' => 200,
							);
						}
						$img_size = apply_filters( 'themify_single_gallery_image_size', $img_size, $featured );

						if ( themify_check( 'setting-img_settings_use' ) ) {
							$size = $featured && '' != $featured ? 'large' : 'medium';
							$img = wp_get_attachment_image_src( $image->ID, apply_filters( 'themify_gallery_post_type_single', $size ) );
							$out_image = '<img src="' . $img[0] . '" alt="' . $alt . '" width="' . $img_size['width'] . '" height="' . $img_size['height'] . '" />';

						} else {
							$img = wp_get_attachment_image_src( $image->ID, apply_filters( 'themify_gallery_post_type_single', 'large' ) );
							$out_image = themify_get_image( "src={$img[0]}&w={$img_size['width']}&h={$img_size['height']}&ignore=true&alt=$alt" );
						}

						?>
						<div class="item gallery-item gallery-icon <?php echo $featured; ?>">
							<a href="<?php echo $img[0]; ?>" class="" data-image="<?php echo $img[0]; ?>" data-caption="<?php echo $caption; ?>" data-description="<?php echo $description; ?>">
								<div class="gallery-item-wrapper">

									<?php echo $out_image; ?>

									<div class="gallery-caption">
										<h2 class="post-title entry-title">
											<?php echo $image->post_title; ?>
										</h2>
										<p class="entry-content">
											<?php echo $caption; ?>
										</p>
									</div>

								</div>
							</a>
						</div>
					<?php endforeach; // images as image ?>

				<?php endif; // images ?>

			<?php endif; // gallery section ?>
		</div>

		<?php themify_content_before(); // hook ?>
		<!-- content -->
		<div id="content" class="list-post">
			<?php themify_content_start(); // hook ?>

			<?php get_template_part( 'includes/loop', get_post_type()); ?>

			<?php wp_link_pages(array('before' => '<p class="post-pagination"><strong>' . __('Pages:', 'themify') . ' </strong>', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			<?php get_template_part( 'includes/author-box', 'single'); ?>

			<?php get_template_part( 'includes/post-nav'); ?>

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
