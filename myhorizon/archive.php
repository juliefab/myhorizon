<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package myhorizon
 */
?>
<div class="blog-wrap">
    
<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php single_cat_title('Sorry, nothing has been posted in '); ?>
  </div>
<?php endif; ?>

    <div class="row">
<?php while (have_posts()) : the_post(); ?>
       
    <?php if ( is_category( array( 12, 13, 14 ) )):?>
          <?php get_template_part('templates/content', 'basics'); ?>
    <?php else: ?>
        <?php get_template_part('templates/content', get_post_format()); ?>
<?php endif; ?>        
  
<?php endwhile; ?>
        </div>

<?php if ($wp_query->max_num_pages > 1) : ?>
    <nav class="blog-pagination">
        <?php wpex_pagination(); ?>
        </nav>
<?php endif; ?>

</div>