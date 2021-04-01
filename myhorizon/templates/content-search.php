<?php get_template_part('templates/page', 'header'); ?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'mht'); ?>
  </div>
<?php endif; ?>

<div class="row">
<?php while (have_posts()) : the_post(); ?>
  <div class="col-md-6 cpt-item">
            <div <?php post_class(); ?>>
            <?php
            if (has_post_thumbnail()):
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large'); 
            ?>
            <a class="cpt-thumbnail" href="<?php the_permalink(); ?>" ><img src="<?php echo $image[0] ?>" class="img-responsive" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/></a>
            <?php endif; ?>
            <div class="cpt-info">            
                <div class="cpt-content">
                    <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <?php get_template_part('templates/entry-meta'); ?>
                    <?php echo get_excerpt(200); ?>
                </div>       
            </div>
            </div>            
        </div>
<?php endwhile; ?>
    </div>

<?php if ($wp_query->max_num_pages > 1) : ?>
    <nav class="blog-pagination">
        <?php wpex_pagination(); ?>
        </nav>
<?php endif; ?>


