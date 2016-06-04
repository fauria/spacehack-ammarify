<?php 
/**
 * Post Navigation Template
 * @package themify
 * @since 1.0.0
 */

if ( ! themify_check( 'setting-post_nav_disable' ) ) :

	$in_same_cat = themify_check('setting-post_nav_same_cat')? true: false;
	$this_post_type = get_post_type();
	$this_taxonomy = ( 'post' == $this_post_type ) ? 'category' : $this_post_type . '-category';
	?>

	<!-- post-nav -->
	<div class="post-nav clearfix">

		<?php previous_post_link( '<span class="prev">%link</span>', '<span class="arrow"></span> %title', $in_same_cat, '', $this_taxonomy ); ?>

		<?php next_post_link( '<span class="next">%link</span>', '<span class="arrow"></span> %title', $in_same_cat, '', $this_taxonomy	); ?>

	</div>
	<!-- /post-nav -->

<?php endif; ?>