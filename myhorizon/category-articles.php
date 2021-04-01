<?php
/**
 * The bankruptcy101/articles category page
 *
 * @package myhorizon
 */

?>
<div class="blog-wrap">
    <h2 class="section-header"><?php single_cat_title(); ?></h2>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'mht'); ?>
  </div>
<?php endif; ?>

    <div class="row">
<?php while (have_posts()) : the_post(); ?>       
          <?php get_template_part('templates/content', 'articles'); ?>
<?php endwhile; ?>
        </div>
    
<?php if ($wp_query->max_num_pages > 1) : ?>
    <nav class="blog-pagination">
        <?php wpex_pagination(); ?>
        </nav>
<?php endif; ?>
</div>


            
 
