<?php
/*
Template Name: Front
*/
get_header(); ?>
<header id="front-hero" role="banner">
	<ul class="work-navigation para-parent">
		<li class="header-tab">
			<?php
				$page = get_page_by_title('VFX');
		  	$pid = $page->ID;
				$workImage = get_the_post_thumbnail_url($pid, 'full');
			?>
			<div class="cover-bg" style="background-image: url(<?= $workImage; ?>)"></div>
			<a href="#vfx"><span>VFX</span></a>
		</li>
		<li class="header-tab">
			<?php
				$page = get_page_by_title('Motion Graphics');
		  	$pid = $page->ID;
				$workImage = get_the_post_thumbnail_url($pid, 'full');
			?>
			<div class="cover-bg" style="background-image: url(<?= $workImage; ?>)"></div>
			<a href="#motion"><span>Motion Graphics</span></a>
		</li>
		<li class="header-tab">
			<?php
				$page = get_page_by_title('Medical Animation');
		  	$pid = $page->ID;
				$workImage = get_the_post_thumbnail_url($pid, 'full');
			?>
			<div class="cover-bg" style="background-image: url(<?= $workImage; ?>)"></div>
			<a href="#medical"><span>Medical Animation</span></a>
		</li>
	</ul>
</header>

<?php do_action( 'foundationpress_before_content' ); ?>
<?php while ( have_posts() ) : the_post(); ?>

<div id="workPosts" class="row align-center">
	<div class="columns">

		<ul class="tabs" data-tabs id="work">
		  <li class="tabs-title is-active"><a href="#recent" aria-selected="true">Recent</a></li>
		  <li class="tabs-title"><a href="#vfx">VFX</a></li>
			<li class="tabs-title"><a href="#motion">Motion Graphics</a></li>
			<li class="tabs-title"><a href="#medical">Medical Animation</a></li>
		</ul>

		<div class="tabs-content" data-tabs-content="work">
		  <div class="tabs-panel is-active" id="recent">
				<?php $tax = ""; ?>
				<?php $pageTitle = "Wicked Liquid"; ?>
				<?php include(locate_template('template-parts/work/reel.php')); ?>
		    <?php include(locate_template('template-parts/work/loop.php')); ?>
		  </div>
		  <div class="tabs-panel" id="vfx">
				<?php $tax = "vfx"; ?>
				<?php $pageTitle = "VFX"; ?>
				<?php include(locate_template('template-parts/work/reel.php')); ?>
		    <?php include(locate_template('template-parts/work/loop.php')); ?>
		  </div>
			<div class="tabs-panel" id="motion">
				<?php $tax = "motion-graphics"; ?>
				<?php $pageTitle = "Motion Graphics"; ?>
				<?php include(locate_template('template-parts/work/reel.php')); ?>
		    <?php include(locate_template('template-parts/work/loop.php')); ?>
		  </div>
			<div class="tabs-panel" id="medical">
				<?php $tax = "medical-animation"; ?>
				<?php $pageTitle = "Medical Animation"; ?>
				<?php include(locate_template('template-parts/work/reel.php')); ?>
		    <?php include(locate_template('template-parts/work/loop.php')); ?>
		  </div>
		</div>
	</div>
</div>

<section class="intro" role="main">
	<div class="fp-intro">

		<div <?php post_class() ?> id="post-<?php the_ID(); ?>">
			<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
			<footer>
				<?php wp_link_pages( array('before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ), 'after' => '</p></nav>' ) ); ?>
				<p><?php the_tags(); ?></p>
			</footer>
			<?php do_action( 'foundationpress_page_before_comments' ); ?>
			<?php comments_template(); ?>
			<?php do_action( 'foundationpress_page_after_comments' ); ?>
		</div>

	</div>

</section>
<?php endwhile;?>
<?php do_action( 'foundationpress_after_content' ); ?>

<?php get_footer();
