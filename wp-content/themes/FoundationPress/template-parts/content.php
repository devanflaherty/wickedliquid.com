<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<div id="post-<?php the_ID(); ?>" class="post column">
	<a href="<?php the_permalink(); ?>">
		<div class="post-thumb">
			<div class="tile">
				<?php the_post_thumbnail(); ?>
			</div>
		</div>
		<h4><?php the_title(); ?></h4>
	</a>
</div>
