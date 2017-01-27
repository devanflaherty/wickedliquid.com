<?php
if ($tax == "") {
  $args = array(
    'post_type'   => 'work',
    'post_status' => 'publish',
   );
} else {
  $args = array(
    'post_type'   => 'work',
    'post_status' => 'publish',
    'tax_query'   => array(
    	array(
    		'taxonomy' => 'work-type',
    		'field'    => 'slug',
    		'terms'    => $tax
    	)
    )
   );
 }

$work = new WP_Query( $args );
if( $work->have_posts() ) :
?>
  <div class="row small-up-1 medium-up-2 work-loop">
    <?php
      while( $work->have_posts() ) :
        $work->the_post();

        ?>
					<div class="work-post columns">
						<a data-open="modal<?php echo get_the_ID(); ?>">
							<div class="tile work-thumbnail">
								<?php if(get_field('gif') && get_field('gif') !== '') : ?>
									<img class="gif-me" src="<?php the_post_thumbnail_url(); ?>">
								<?php else : ?>
									<img src="<?php the_post_thumbnail_url(); ?>">
								<?php endif; ?>
							</div>

              <hgroup>
                <h5><?php the_title(); ?></h5>
                <h6><?php the_field('client'); ?></h6>
              </hgroup>
						</a>

            <div class="reveal" id="modal<?php echo get_the_ID(); ?>"
              data-reveal data-close-on-click="true"
              data-animation-in="slide-in-down"
              data-animation-out="slide-out-down"
              >
              <div class="hgroup">
                <h3><?php the_title(); ?></h3>
                <h4><?php the_field('client'); ?></h4>
              </div>
              <div class="responsive-embed widescreen">
                <?php the_content(); ?>
              </div>
              <button class="close-button" data-close aria-label="Close modal" type="button">
                <div aria-hidden="true">
                  <span>CLOSE</span>

                  <svg width="122px" height="122px" viewBox="-1 -1 122 122" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                      <defs></defs>
                      <path d="M72,49 L72,-2.84217094e-13 L49,-2.84217094e-13 L49,49 L-6.80712683e-13,49 L-6.82121026e-13,72 L49,72 L49,121 L72,121 L72,72 L121,72 L121,49 L72,49 Z" id="Combined-Shape" stroke="none" fill="#565656" fill-rule="evenodd"></path>
                  </svg>

                </div>
              </button>
            </div>

					</div>
        <?php
      endwhile;
      wp_reset_postdata();
    ?>
  </div>
<?php
else :
  $term = get_term_by('name', $tax, 'work-type');
  $name = $term->name;
  echo "<h3>There are no work posts in the {$name} category.</h3>";
endif;
?>
