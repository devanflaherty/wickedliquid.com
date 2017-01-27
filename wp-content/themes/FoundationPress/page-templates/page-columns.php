<?php
/*
Template Name: Columned
*/
get_header(); ?>

<?php get_template_part( 'template-parts/featured-image' ); ?>

<div id="pageColumns" role="main">

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>
  <article <?php post_class('main-content') ?> id="post-<?php the_ID(); ?>">
    <?php get_template_part( 'template-parts/columns/component' ); ?>
  </article>
<?php endwhile;?>

<?php do_action( 'foundationpress_after_content' ); ?>

</div>

<?php get_footer();
