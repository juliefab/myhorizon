<?php
/*
Template Name: Product Pages
* 
* @package myhorizon
*/
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
