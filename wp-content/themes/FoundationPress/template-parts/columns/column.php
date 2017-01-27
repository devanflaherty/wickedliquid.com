<?php if (get_sub_field('header')) : ?>
  <?php $hLevel = get_sub_field('heading_level'); ?>
  <?= "<" . $hLevel . ">"; ?><?= get_sub_field('header'); ?><?= "</" . $hLevel .">"; ?>
<?php endif; ?>

<?php the_sub_field('content'); ?>
