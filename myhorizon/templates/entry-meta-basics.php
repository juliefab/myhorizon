<?php
/**
 * Custom entry meta for the evergreen basics content. Currently returning nothing.
 *
 * @package myhorizon
 */
?>

<?php if (in_category( 7 )): ?>
<div class="entry-meta">
    <span class="post-author">By <?php the_author_posts_link(); ?>- <a href="<?php the_author_meta('user_url'); ?>" class="post-author-website" target="_blank"><?php $authorcompany = get_the_author_meta('company'); ?><?php echo $authorcompany ?></a></span>
    <?php the_date(); ?>
</div>
<?php else: ?>

<?php endif; ?>


