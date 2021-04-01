
<?php /*?>This PAGE Corresponsd to the category index the five categories as found on the sidebar are  bk basics debt relief money management rebuilding credit and life after bankruptcy if you click on one of thos they will take you to this category index view which has 2 columns of blog entries<?php */?>



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
              
                    <?php echo get_excerpt(150); ?>
                </div>
            </div>
            </div>         </div>  