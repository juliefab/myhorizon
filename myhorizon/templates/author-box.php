<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div id="author-box" class="author-box-wrapper" role="tabpanel">
<h4 class="page-header">About the Author:</h4>
  <!-- Nav tabs -->
  <ul id="author-tabs" class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#author-box-bio" aria-controls="home" role="tab"><i class="fa fa-user"></i> Bio</a></li>
    <li role="presentation"><a href="#author-box-posts" aria-controls="profile" role="tab"><i class="fa fa-newspaper-o"></i> Latest Posts</a></li>
    <?php
    global $user_ID;
    if ( get_the_author_meta('twitter') ) : // Does the author have a twitter account?
        ?>
        <li role="presentation"><a href="#author-twitter-pane" aria-controls="profile" role="tab"><i class="fa fa-twitter"></i> Twitter</a></li>
    <?php endif; ?>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="author-box-bio">
        <h4 class="page-header"><?php the_author_meta('display_name'); ?></h4>
        <div class="row">
            <?php
            global $user_ID;
            if ( get_the_author_meta('picture',$picture) ) : // If user has a picture echo two columns with picture
                ?>
        <div class="col-md-3 author-box-picture">           
            <?php $authorpicture = get_the_author_meta('picture'); ?><img src="<?php echo $authorpicture ?>" class="img-responsive img-circle">  
            
        </div>
            <div class="col-md-9">
                <?php the_author_meta('description'); ?>
                </div>
            <?php else : ?>
            <div class="col-md-12">
                <?php the_author_meta('description'); ?>
                </div>
            <?php endif; ?>
    </div>
        </div>
    <div role="tabpanel" class="tab-pane fade" id="author-box-posts">
        <h4 class="page-header">Latest posts by <?php the_author_meta('first_name'); ?></h4>
            <?php   the_latest_author_posts($post);?>
    </div>
      <?php
    global $user_ID;
    if ( get_the_author_meta('twitter') ) : // Does the author have a twitter account?
        ?>
      <div role="tabpanel" class="tab-pane fade" id="author-twitter-pane">
        <h4 class="page-header">Follow <?php the_author_meta('first_name'); ?> on <a href="http://twitter.com/<?php the_author_meta('twitter' );?>" target="_blank" title="@<?php the_author_meta('twitter');?>">Twitter</a></h4>
        <a href="http://twitter.com/<?php the_author_meta('twitter' );?>" class="twitter-follow-button" data-show-count="true" data-show-count="false" data-size="large">Follow @<?php the_author_meta('twitter' );?></a>
    </div>
      <?php endif; ?>
  </div>
</div>