<?php
/**
 *
 * @package myhorizon
 */
?>
<?php if(is_front_page()) { //Use the sidebar conditional to display the breadcrumbs
        get_template_part('templates/alert');  
    }
    else {
              //Don't display the alert bar
    }
    ?>
<header role="banner">
    <nav id="global-nav" role="navigation">
      <div>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <div class="navbar-brand-logo">
                              <a href="<?php bloginfo( 'url' ); ?>"><?php bloginfo( 'name' ); ?></a>
                            </div>
        </div>
            <div class="navbar-gutter">
                <?php dynamic_sidebar('header-gutter'); ?>
            </div>
            <?php
                wp_nav_menu( array(
                    'menu'              => 'primary',
                    'theme_location'    => 'primary',
                    'depth'             => 2,
                    'container'         => 'div',
                    'container_class'   => 'collapse navbar-collapse',
                    'container_id'      => 'navbar-collapse-1',
                    'menu_class'        => 'nav navbar-nav',
                    'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                    'walker'            => new wp_bootstrap_navwalker())
                );
            ?>
        </div>
      </nav>
   <?php get_template_part('templates/jumbotron'); ?>  <!-- would take out the jumbotron on everypage -->
    <?php if(mht_display_sidebar()) { //Use the sidebar conditional to display the breadcrumbs
        get_template_part('templates/breadcrumbs');  
    }
    else {
              //Don't display the breadcrumb bar
    }
    ?>
</header>