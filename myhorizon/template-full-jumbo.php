<?php
/*
Template Name: Full Width w/ Jumbotron
* 
* @package myhorizon
*/
?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'page'); ?>
<?php endwhile; ?>
