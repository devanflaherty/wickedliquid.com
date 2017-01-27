<section id="columnContent">
	<div class="row align-center">
	<?php
		if( have_rows('content', $pid) ):
			$i = 0;
		  while ( have_rows('content', $pid) ) : the_row();
				$i++;

				$cSpan = get_sub_field('column_span');
				if ($cSpan) {
					if($cSpan == 'full') {
						$span = 'small-8';
					} elseif($cSpan == '1-2') {
						$span = "small-8 large-4";
					} elseif($cSpan == '1-4') {
						$span = "small-8 medium-2 large-2";
					} elseif($cSpan == '3-4') {
						$span = "small-12 medium-6 large-6";
					} else {
						$span = "";
					}
				}
			?>

		  	<?php if( get_row_layout() == 'column' ): ?>

					<article class="<?= $span; ?> columns">
						<?php get_template_part( 'template-parts/columns/column' ); ?>
					</article>

		    <?php elseif( get_row_layout() == 'image' ): ?>

					<article class="<?= $span; ?> columns no-pad">
						<img src="<?= get_sub_field('image'); ?>">
					</article>

				<?php elseif( get_row_layout() == 'cta' ): ?>

					<article class="<?= $span; ?> columns no-pad slides">
						<?php
							$slideRow = 'cta_select';
							include(locate_template('partials/cta/loop.php'));
						?>
					</article>

				<?php endif;?>

      <?php endwhile; ?>
    <?php else : ?>
		<?php endif; ?>
	</div>
</section>
