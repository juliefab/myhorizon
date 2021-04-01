<?php
$blog_page = 7;
?>

<?php if(get_field('jumbo_video_embed')): //Must at least have a video embed to do the rest ?>
    <div class="jumbotron jumbotron-feature video">
        <div>
          <div class="row">
          <div class="col-md-5">
            <?php
                if(get_field('jumbo_mobile_heading')){
                    echo '<h1><span class="hxs">' . get_field('jumbo_heading') . '</span><span class="vxsb">' . get_field('jumbo_mobile_heading') . '</span></h1>';

                } elseif(get_field('jumbo_heading')){
                    echo '<h1>' . get_field('jumbo_heading') . '</h1>';

                }
                if(get_field('jumbo_mobile_sub_heading')){
                    echo '<p class="lead"><span class="hxs">' . get_field('jumbo_sub_heading') . '</span><span class="vxsb">' . get_field('jumbo_mobile_sub_heading') . '</span></p>';

                }elseif(get_field('jumbo_sub_heading')){
                    echo '<p class="lead">' . get_field('jumbo_sub_heading') . '</p>'; 

                }

                if(get_field('jumbo_link_location')){
                    echo '<p><a href="' . get_field('jumbo_link_location') . '" class="'. get_field('jumbo_link_class') .'" onclick="'. get_field('jumbo_link_tracking') .'"   >' . get_field('jumbo_link_text') . '</a>';
                    if(get_field('jumbo_link_location_two')){
                        echo '<a href="' . get_field('jumbo_link_location_two') . '" class="'. get_field('jumbo_link_class_two') .'" onclick="'. get_field('jumbo_tracking_two') .'"   >' . get_field('jumbo_link_text_two') . '</a>';
                            }
                      echo '</p>';
                    }

                ?>
          </div>
          <div class="col-md-7">
            <?php
              if(get_field('jumbo_video_embed')){
                  echo '<div class="jumbo-video-embed">' . get_field('jumbo_video_embed') . '</div>';
                }
                if(get_field('jumbo_video_autoplay')){
                    echo '<script>if (/' . get_field('jumbo_video_autoplay') . '/.test(location.href)) {
                      wistiaEmbed.play();
                    }
                    </script>';
                  }
                ?>
          </div>
          </div>
        </div>
    </div>

<?php elseif(get_field('jumbo_heading')): //Must at least have a Heading to get the rest. ?>
    <div class="jumbotron jumbotron-feature">
        <div>
    <?php
        if(get_field('jumbo_logo')){
            echo '<a href="' . get_field('jumbo_logo_link') . '"><img class="' . get_field('jumbo_logo_class') . '" src="' . get_field('jumbo_logo') . '" ></a>';

        }
        if(get_field('jumbo_mobile_heading')){
            echo '<h1><span class="hxs">' . get_field('jumbo_heading') . '</span><span class="vxsb">' . get_field('jumbo_mobile_heading') . '</span></h1>';

        } elseif(get_field('jumbo_heading')){
            echo '<h1>' . get_field('jumbo_heading') . '</h1>';

        }
        if(get_field('jumbo_mobile_sub_heading')){
            echo '<p class="lead"><span class="hxs">' . get_field('jumbo_sub_heading') . '</span><span class="vxsb">' . get_field('jumbo_mobile_sub_heading') . '</span></p>';

        }elseif(get_field('jumbo_sub_heading')){
            echo '<p class="lead">' . get_field('jumbo_sub_heading') . '</p>';

        }

        if(get_field('jumbo_link_location')){
            echo '<p><a href="' . get_field('jumbo_link_location') . '" class="'. get_field('jumbo_link_class') .'" onclick="'. get_field('jumbo_link_tracking') .'"   >' . get_field('jumbo_link_text') . '</a>';
            if(get_field('jumbo_link_location_two')){
                echo '<a href="' . get_field('jumbo_link_location_two') . '" class="'. get_field('jumbo_link_class_two') .'" onclick="'. get_field('jumbo_tracking_two') .'"   >' . get_field('jumbo_link_text_two') . '</a>';
                    }
              echo '</p>';
            }

        ?>

        </div>
    </div>

<?php elseif(is_home()): ?>
    <div class="jumbotron jumbotron-blog jbh">
        <div>
                <h1>
                  <?php the_field('jumbo_heading', $blog_page); ?>
                </h1>
              <p class="lead"><?php the_field('jumbo_sub_heading', $blog_page); ?></p>
                <div class="jumbo-search"><?php get_template_part('templates/searchform', 'jumbo'); ?></div>
        </div>
    </div>

<?php elseif (is_archive()): ?>
    <div class="jumbotron jumbotron-blog jbs">
     
    </div>

<?php elseif (
        is_single() ||
        is_search()
        ): ?>
    <div class="jumbotron jumbotron-blog jbs">
    </div>

<?php elseif (is_404()): ?>
  <div class="jumbotron jumbotron-default">
      <div>
          <h1>Page not found</h1>
          <p class="lead">It looks like this page no longer exists.</p>
      </div>
  </div>

<?php else: //Keep this last! ?>
  <div class="jumbotron jumbotron-default">
      <div>
            <h1>
              <?php echo mht_title(); ?>
            </h1>
        </div>
    </div>

<?php endif; ?>
