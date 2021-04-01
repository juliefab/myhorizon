<?php
/* 
 * The bankruptcy101/basics content
 *
 * @package myhorizon
 */
?>

<div class="col-md-12 cpt-item">
            <div <?php post_class(); ?>>
        <div class=" cpt-med">
            <div class="cpt-inner">
               <?php
                 if (has_post_thumbnail()):
                     $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                 ?>
                <div class="cpt-thumbnail cpt-thumbnail-med">
                     <a href="<?php the_permalink(); ?>" class="image-wrap"><img src="<?php echo $image[0] ?>" class="img-responsive" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/></a>
                     <h4 class="entry-title">
                        <span class="text">
                            <a href="<?php the_permalink(); ?>" class="read-more"><?php the_title(); ?></a>
                        </span>
                    </h4>
                </div>
                <div class="entry-summary">
                    <?php get_template_part('templates/entry-meta', 'basics', 'considering-bankruptcy'); ?>
                    <?php echo get_excerpt(150); ?>
                </div>
                <?php else : ?>
                <h4 class="entry-title">
                        <span class="text">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </span>
                        <span class="meta">
                            <a href="<?php the_permalink(); ?>" class="read-more">Read more</a>
                        </span>
                    </h4>
                <?php get_template_part('templates/entry-meta', 'basics'); ?>
                <div class="entry-summary">
                    <?php echo get_excerpt(200); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>       
        </div>

 