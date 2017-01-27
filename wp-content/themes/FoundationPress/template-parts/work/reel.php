<?php
  $page = get_page_by_title($pageTitle);
  $pid = $page->ID;

  if( get_field('video_reel', $pid) ) :
?>
<div class="row reel align-center">

  <div class="small-8 medium-8 large-5 columns">
    <div class="reel-video-wrap">
      <div class="responsive-embed widescreen vimeo">
        <?php the_field('video_reel', $pid); ?>
      </div>
    </div>
  </div>

  <div class="small-8 large-3 columns flex">
    <div class="reel-description">
      <h3><?php echo get_the_title($pid); ?></h3>
      <?php the_field('reel_excerpt',$pid); ?>
    </div>
  </div>

</div>
<?php endif; ?>
