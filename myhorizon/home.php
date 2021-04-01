<?php
/**
 * The blog home page
 *
 * @package myhorizon
 */
?>
<div class="blog-wrap">
    <h2 class="section-header"><a href="<?php bloginfo( 'url' ); ?>/bankruptcy101/category/basics/">Bankruptcy Basics</a></h2>
        <div class="row">
            <div class="col-md-12 cpt-item">
                <?php basics_featured_home ($post);?>
            </div>
        </div>
    <div class="row">
<?php basics_home ($post);?>
    </div>
    <div class="row">
        <div class="col-md-12 read-more-bar">
            <a href="<?php bloginfo( 'url' ); ?>/bankruptcy101/category/basics/" class="read-more"><span class="text-color">Read more in </span>Bankruptcy Basics</a>
        </div>
    </div>
<h2 class="section-header"><a href="<?php bloginfo( 'url' ); ?>/bankruptcy101/category/articles/">myHorizon Blog</a></h2>
    <div class="row">
     <?php articles_home ($post);?>
    </div>
    <div class="row">
        <div class="col-md-12 read-more-bar">
            <a href="<?php bloginfo( 'url' ); ?>/bankruptcy101/category/articles/" class="read-more"><span class="text-color">Read more from the</span> <span style="text-transform: none;">myHorizon</span> Blog</a>
        </div>
    </div>
</div>
