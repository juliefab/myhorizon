<?php 
/* 
Template Name: SpecialSideBar
*/
?>

<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <?php
       if (has_post_thumbnail()):
           $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
       ?>
      <img src="<?php echo $image[0] ?>" class="single-featured img-responsive" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/>
      <?php endif; ?>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
    </header>
    <div class="entry-content">
      <?php echo wp_seriesmeta_write(); ?>
      <?php the_content(); ?>
    </div>
    <?php echo wp_seriesmeta_write(); ?>
  </article>
<?php related_posts();?>
     
<?php endwhile; ?>

