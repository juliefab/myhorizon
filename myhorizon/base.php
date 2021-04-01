<?php get_template_part('templates/head'); ?>
  <body <?php function_exists('body_id') && body_id() ?> <?php body_class(); ?>>
    <?php
      do_action('get_header');
      get_template_part('templates/header');
    ?>
      
      <!-- Base.php -->
    <?php if(mht_display_sidebar()) : ?>
      <main class="wrap container" role="main">
          <div class="content row">
              <div class="main">
                  <?php include mht_template_path(); ?>
              </div><!-- /.main -->
              <aside class="sidebar" role="complementary">
                  <?php include mht_sidebar_path(); ?>
              </aside><!-- /.sidebar -->              
          </div>
      </main><!-- /.wrap -->
      <?php get_template_part('templates/cta'); ?>
          <?php else: ?>
      <main class="wrap" role="main">
              <?php include mht_template_path(); ?>
                <?php the_latest_atm_frontpage ($post);?>
                <?php get_template_part('templates/cta'); ?>
      </main><!-- /.wrap -->
      <?php endif; ?>
      <?php
      get_template_part('templates/footer');
      wp_footer();
    ?>
      <?php get_template_part('templates/site-scripts'); ?>
  </body>
</html>