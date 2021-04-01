<?php
/*
YARPP Template: Wilmoth77
Description: Requires a theme which supports post thumbnails
Author: Jeff Wilmoth
*/ ?>
<div class="related-posts-wrapper">
<h4 class="page-header">Related Posts:</h4>
<?php if (have_posts()):?>
<div class="related-posts">
	<?php while (have_posts()) : the_post(); ?>
		<?php if (has_post_thumbnail()):?>
    
                    <div class="related-item">
                        <?php if (has_post_thumbnail()):
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small');
                        ?>
                        <a class="related-thumbnail" href="<?php the_permalink(); ?>" ><img src="<?php echo $image[0] ?>" class="img-responsive" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/></a>
                            <?php endif; ?>
                        <div class="related-info">
                            <div class="related-content">
                                <time class="published" datetime="<?php echo get_the_time('c'); ?>"><i class="fa fa-clock-o"></i>  <?php the_time('F jS, Y') ?></time>
                                <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>                                
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                        <?php endwhile; ?>
</div>
<?php else: ?>
<p>No related posts</p>
<?php endif; ?>
</div>