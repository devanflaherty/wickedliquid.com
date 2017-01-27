<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

		</section>
		<footer id="footer-container">
			<div class="row">
				<div class="columns small-8 medium-4 footer-meta">
					<div class="hgroup">
						<h5><?php echo bloginfo('name'); ?></h5>
						<span class="tagline"><?php echo bloginfo('tagline'); ?></span>
					</div>
					<?php if (have_rows('social_links', 'options')) : ?>
					<nav class="social-links">
						<?php while(have_rows('social_links', 'options')) : the_row(); ?>
							<a href="<?php the_sub_field('url'); ?>"><i class="fa <?php the_sub_field('icon'); ?>"></i><?php if(!get_sub_field('icon')) { the_sub_field('label');} ?></a>
						<?php endwhile;?>
					</nav>
					<?php endif;?>
					<p>© 2017 <?php echo bloginfo('name'); ?> All Rights Reserved.</p>
				</div>
				<div class="columns small-8 medium-4 footer-dynamic">
					<div id="footerWidgets">
						<?php do_action( 'foundationpress_before_footer' ); ?>
						<?php dynamic_sidebar( 'footer-widgets' ); ?>
						<?php do_action( 'foundationpress_after_footer' ); ?>
					</div>
				</div>
			</div>
		</footer>

		<?php do_action( 'foundationpress_layout_end' ); ?>

<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
		</div><!-- Close off-canvas wrapper inner -->
	</div><!-- Close off-canvas wrapper -->
</div><!-- Close off-canvas content wrapper -->
<?php endif; ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.14.2/TweenMax.min.js"></script>
<script src="/wp-content/themes/FoundationPress/assets/javascript/vendor/scrollmagic/ScrollMagic.min.js"></script>
<script src="/wp-content/themes/FoundationPress/assets/javascript/vendor/scrollmagic/animation.gsap.min.js"></script>
<script src="/wp-content/themes/FoundationPress/assets/javascript/vendor/scrollmagic/debug.addIndicators.min.js"></script>
<?php wp_footer(); ?>
<?php do_action( 'foundationpress_before_closing_body' ); ?>
</body>
</html>
