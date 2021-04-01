
 <?php if (in_category(7)): ?>
<div class="entry-meta">
    <span class="post-author">By <?php the_author_posts_link(); ?> - <a href="<?php the_author_meta('user_url'); ?>" class="post-author-website" target="_blank"><?php $authorcompany = get_the_author_meta('company'); ?><?php echo $authorcompany ?></a></span><?php the_date(); ?>
</div> 

<?php elseif (is_single()): ?>
<div class="entry-meta">
  
  <!--This span effects the single article view by author view -->
    <span class="post-author">By <?php the_author_posts_link(); ?> <a href="<?php the_author_meta('user_url'); ?>" class="post-author-website" target="_blank"><?php $authorcompany = get_the_author_meta('company'); ?><?php echo $authorcompany ?></a></span>
    <time class="published" datetime="<?php echo get_the_time('c'); ?>"> - <?php the_time('F jS, Y') ?></time><br>
</div>

<?php else: ?>
<div class="entry-meta">
    <span class="post-author">By <?php the_author_posts_link(); ?>, <a href="<?php the_author_meta('user_url'); ?>" class="post-author-website" target="_blank"><?php $authorcompany = get_the_author_meta('company'); ?><?php echo $authorcompany ?></a></span>
    <br><time class="published" datetime="<?php echo get_the_time('c'); ?>"><i class="fa fa-clock-o"></i>  <?php the_time('F jS, Y') ?></time><br>
</div>
<?php endif; ?> 