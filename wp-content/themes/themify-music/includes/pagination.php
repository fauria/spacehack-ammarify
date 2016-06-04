<?php
/**
 * Post Pagination Template
 * @package themify
 * @since 1.0.0
 */

/** Themify Default Variables
 *  @var object */
global $themify;

if ( 'numbered' == themify_get( 'setting-entries_nav' ) || '' == themify_get( 'setting-entries_nav' ) ) : ?>

	<?php themify_pagenav(); ?>

<?php else : ?>

	<div class="post-nav">

		<span class="prev"><?php next_posts_link(__('&laquo; Older Entries', 'themify')) ?></span>

		<span class="next"><?php previous_posts_link(__('Newer Entries &raquo;', 'themify')) ?></span>

	</div>

<?php endif; ?>