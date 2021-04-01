<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package myhorizon
 */

 /**
  * Hide the HTML tab of the editor for Pages only, not posts.
  * http://wordpress.stackexchange.com/questions/12370/disable-wysiwyg-editor-only-when-creating-a-page
  */

  add_filter( 'user_can_richedit', 'nopages_user_can_richedit');

  function nopages_user_can_richedit($cap) {
      global $post_type;

      if ('page' == $post_type)
          return false;
      return $cap;
  }


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function mht_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'mht_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function mht_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'mht_body_classes' );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function mht_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}

	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'mht' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'mht_wp_title', 10, 2 );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function mht_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'mht_setup_author' );

/**
 * Add Bootstrap's IE conditional html5 shiv and respond.js to header
 */
function conditional_js() {

	global $wp_scripts;

	wp_register_script( 'html5_shiv', 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js', '', '', false );
	wp_register_script( 'respond_js', 'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js', '', '', false );

	$wp_scripts->add_data( 'html5_shiv', 'conditional', 'lt IE 9' );
	$wp_scripts->add_data( 'respond_js', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'conditional_js' );

/**
 * Enable the ability to use the disable wpautotop plugin on private posts such as content blocks
 * Add filter and then go to Settings > Writing
 */
add_filter('lp_wpautop_show_private_pt', '__return_true');


/**
 * Body ID function; example usage is adding page name as an ID to the body element
 *
 * csanford
 */
function get_html_id()
{
    $id = 'hid';

    switch (true) {

        case ((@isset($_REQUEST['s']) && !empty($_REQUEST['s'])) || is_search()):
            $id = 'search';
            break;

        case (is_home() || is_front_page()):
            $id = 'index';
            break;

        case is_page():
            $id = 'page';
            break;

        case is_single():
            $id = 'single';
            break;

        case is_category():
            $id = 'category';
            break;

        case is_tag():
            $id = 'tag';
            break;

        case is_archive():
            $id = 'archive';
            break;
    }

    $id = apply_filters('html_id', $id);

    return 'id="' . esc_attr(sanitize_title($id)) . '"';
};

function html_id()
{
    echo get_html_id();
};

function get_body_id()
{
    $id = 'bid';

    switch (true) {

        case is_404():
            $id = 'status-404';
            break;

        case is_single() || is_page():
            global $post;
            $post = (object)$post;
            $id = $post->post_name;
            break;

        case is_archive() && is_category():
            $id = get_query_var('cat');
            if (is_int($id))
                $id = 'cat-' . $id;
            break;

        case is_archive() && is_tag():
            $id = get_query_var('tag');
            if (is_int($id))
                $id = 'tag-' . $id;
            break;
    };

    $id = apply_filters('body_id', $id);

    return 'id="' . esc_attr(sanitize_title($id)) . '"';
};

function body_id()
{
    echo get_body_id();
};

function html_class($class = array())
{
    echo get_html_class($class);
};

function get_html_class($class = array())
{
    if (!is_array($class))
        $class = preg_split('/\s+/', $class);

    $class = apply_filters('html_class', $class);
    return 'class="' . esc_attr(is_array($class) ? implode(' ', $class) : $class) . '"';
};

/**
 * Modify the excerpt
 */
// Replaces the excerpt "more" text by a link
function new_excerpt_more($more) {
       global $post;
       if(is_front_page()) {
           return '...<br><br><a class="read-more" href="'. get_permalink($post->ID) . '"> Read More</a>'; }
        elseif (is_page( array( 'mc-feed-1', 'mc-feed-2', 'mc-feed-3' ) )) {
           return '...'; }
        else {
            return '...<br><br><a role="button" class="btn btn-default btn-sm" href="'. get_permalink($post->ID) . '"> Read More</a>';
}
}
add_filter('excerpt_more', 'new_excerpt_more');

// Control Excerpt Length using Filters
function custom_excerpt_length( $length ) {
	return 35;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * Limit excerpt length by characters instead of words
 *
 * This completely negates the two excerpt functions above if you use this
 * function.
 *
 * Call the function and define the number of characters <?php echo get_excerpt(125); ?>
 *
 * https://wordpress.org/support/topic/limit-excerpt-length-by-characters
*/
// Numbered Pagination
function get_excerpt($count){
  $permalink = get_permalink($post->ID);
  $excerpt = get_the_content();
  $excerpt = strip_tags($excerpt);
  $excerpt = substr($excerpt, 0, $count);
  $excerpt = substr($excerpt, 0, strripos($excerpt, " "));
  if(is_front_page()) {
           $excerpt = '<p>' .$excerpt. '...</p><p><a class="read-more" href="'.$permalink. '"> Read More</a></p>'; }
        else {
           $excerpt = '<p>' .$excerpt. '...</p><p><a role="button" class="btn btn-default btn-sm" href="'.$permalink. '"> Read More</a></p>';
}
  return $excerpt;
}


/**
 * Function to test if a page is a parent and/or child; usage is is_tree
 *
 * http://css-tricks.com/snippets/wordpress/if-page-is-parent-or-child/
 * http://css-tricks.com/snippets/wordpress/if-page-is-parent-or-child/#comment-85846
 */
function is_tree($pid)
{
  global $post;

  $ancestors = get_post_ancestors($post->$pid);
  $root = count($ancestors) - 1;
  $parent = $ancestors[$root];

  if(is_page() && (is_page($pid) || $post->post_parent == $pid || in_array($pid, $ancestors)))
  {
    return true;
  }
  else
  {
    return false;
  }
};

/**
 * Add custom profile fields to users
 *
 * Use this to retrieve: $authorcompany = get_the_author_meta('company');
 *
 * http://davidwalsh.name/add-profile-fields
 */
function modify_contact_methods($profile_fields) {

	// Add new fields
	$profile_fields['company'] = 'Company';
        $profile_fields['picture'] = 'Picture';

	return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');

/**
 * Custom pagination
 *
 * Pagination call back with <?php wpex_pagination(); ?>
 *
 * http://www.wpexplorer.com/pagination-wordpress-theme/
 */
// Numbered Pagination
if ( !function_exists( 'wpex_pagination' ) ) {
    function wpex_pagination() {
        $prev_arrow = is_rtl() ? '&rarr;' : '&larr;';
        $next_arrow = is_rtl() ? '&larr;' : '&rarr;';
        global $wp_query;
        $total = $wp_query->max_num_pages;
        $big = 999999999; // need an unlikely integer
          if( $total > 1 )  {
              if( !$current_page = get_query_var('paged') )
                      $current_page = 1;
              if( get_option('permalink_structure') ) {
                  $format = 'page/%#%/';

              } else {
                  $format = '&paged=%#%';

              }
              echo paginate_links(array(
                  'base'                => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                  'format'		=> $format,
                  'current'		=> max( 1, get_query_var('paged') ),
                  'total' 		=> $total,
                  'mid_size'		=> 3,
                  'type' 		=> 'list',
                  'prev_text'		=> $prev_arrow,
                  'next_text'		=> $next_arrow,
                  ) );

              }
              }
              }

/**
 * Latest posts from 'Articles that matter' for the front page of the website
 *
 * Query WP for the latest posts from 'Articles that matter'
 * and display the 3 most recent
 *
 */
function the_latest_atm_frontpage($post) {
    if ( is_front_page()):?>
<div class="section section-blog">
    <div>
        <div>
            <h2 class="section-header hxs">Articles that matter | <a href="/bankruptcy101" class="btn btn-info btn-lg">myHorizon Blog</a></h2>
            <h2 class="section-header vxsb">Articles that matter</h2>
                <?php $relatedargs = array(
                    'cat' => 6,
                    'posts_per_page' => 3
                    );
                $relatedquery = new WP_Query( $relatedargs );
                while($relatedquery->have_posts()){
                    $relatedquery->the_post();
                    $ID = get_the_ID();
                    ?>
                <div class="col-md-4 cpt-item">
                    <article>
                        <?php
                        if (has_post_thumbnail()):
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                        ?>
                        <a class="cpt-thumbnail" href="<?php the_permalink(); ?>" ><img src="<?php echo $image[0] ?>" class="img-responsive" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/></a>
                            <?php endif; ?>
                        <div class="cpt-info">
                            <div class="cpt-content">
                                <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                    <?php get_template_part('templates/entry-meta'); ?>
																		<?php echo get_excerpt(175); ?>
                            </div>
                        </div>
                    </article>
                </div>
                    <?php }
                    wp_reset_postdata();?>
        </div>
    </div>
</div>
    <?php else: ?>
        <?php endif; ?>
            <?php }
/**
 * Bankruptcy Basics main featured post
 *
 * Query WP for the most recent Bankruptcy Basics post
 * with a tag of 'featured'
 *
 */
function basics_featured_home ($post) {
                    $relatedargs = array(
                    'post_type' => 'post',
                    'cat' => 7,
                    'tag_id' => 9, //Must have the featured tag to appear be returned in the query!
                    'posts_per_page' => 1
                    );
                $relatedquery = new WP_Query( $relatedargs );
                while($relatedquery->have_posts()){
                    $relatedquery->the_post();
                    $ID = get_the_ID();
                    ?>
                <article>
                    <div class="cpt-big">
                        <div class="cpt-inner">
                             <?php
                             if (has_post_thumbnail()):
                                 $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                             ?>
                            <div class="cpt-thumbnail cpt-thumbnail-big">
                                 <a href="<?php the_permalink(); ?>" class="image-wrap"><img src="<?php echo $image[0] ?>" class="img-responsive" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/></a>
                                <h3 class="entry-title">
                                    <span class="text">
                                        <a href="<?php the_permalink(); ?>" class="read-more"><?php the_title(); ?></a>
                                    </span>
                                </h3>
                            </div>
                            <div class="entry-summary">
                                <?php get_template_part('templates/entry-meta', 'basics'); ?>
                                <?php echo get_excerpt(200); ?>
                            </div>
                            <?php else : ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </article>
                    <?php }
                    wp_reset_postdata();?>
            <?php }

/**
 * Bankruptcy Basics
 *
 * Query WP for the 2 most recent Bankruptcy Basics posts
 * with a tag of 'featured' and offset by 1
 *
 */
function basics_home ($post) {
                    $relatedargs = array(
                    'post_type' => 'post',
                    'cat' => 7,
                    'tag_id' => 9,
                    'posts_per_page' => 2,
                    'offset' => 1 //so result of basics_feature_home isn't repeated here
                    );
                $relatedquery = new WP_Query( $relatedargs );
                while($relatedquery->have_posts()){
                    $relatedquery->the_post();
                    $ID = get_the_ID();
                    ?>
                <div class="col-md-6 cpt-item">
            <article>
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
                    <?php get_template_part('templates/entry-meta', 'basics'); ?>
                    <?php echo get_excerpt(200); ?>
                </div>
                <?php else : ?>
                <?php endif; ?>
            </div>
        </div>
    </article>
        </div>
                    <?php }
                    wp_reset_postdata();?>
            <?php }

/**
 * Articles that matter
 *
 * Query WP for the 4 most recent Articles that matter posts
 *
 */
function articles_home ($post) {
                    $relatedargs = array(
                    'post_type' => 'post',
                    'cat' => 6,
                    'posts_per_page' => 4
                    );
                $relatedquery = new WP_Query( $relatedargs );
                while($relatedquery->have_posts()){
                    $relatedquery->the_post();
                    $ID = get_the_ID();
                    ?>
                <div class="col-md-6 cpt-item">
            <article>
            <?php
            if (has_post_thumbnail()):
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
            ?>
            <a class="cpt-thumbnail" href="<?php the_permalink(); ?>" ><img src="<?php echo $image[0] ?>" class="img-responsive" alt="<?php the_title(); ?>" title="<?php the_title(); ?>"/></a>
            <?php endif; ?>
            <div class="cpt-info">
                <div class="cpt-content">
                    <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
										<?php echo wp_seriesmeta_write($excerpt = TRUE); ?>
                    <?php get_template_part('templates/entry-meta'); ?>
                    <?php echo get_excerpt(142); ?>
                </div>
            </div>
            </article>
        </div>
                    <?php }
                    wp_reset_postdata();?>
            <?php }

/**
 * Latest posts by author
 *
 * Query WP for the latest posts from the current author in the loop
 *
 * http://wordpress.stackexchange.com/questions/117081/get-latest-author-posts-inside-the-loop
 */
function the_latest_author_posts($post) {
    $relatedargs = array(
        'author' => $post->post_author,
        'post__not_in' => array( $post->ID),
        'posts_per_page' => 4
        );
    $relatedquery = new WP_Query( $relatedargs );
    while($relatedquery->have_posts()){
        $relatedquery->the_post();
        $ID = get_the_ID();
        ?>
<div class="row author-box-recent">
    <div class="col-md-3">
        <?php
        if(has_post_thumbnail()) {
            $relatedthumbnail = wp_get_attachment_image_src( get_post_thumbnail_id($ID), 'medium', false);
            ?>
        <div>
            <a href="<?php the_permalink(); ?>" ><img src="<?php echo $relatedthumbnail['0']; ?>" class="img-responsive" alt="<?php the_title(); ?>" /></a>
        </div>
            <?php } ?>
        </div>
    <div class="col-md-6">
        <h6>
            <a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a>
            <br><time datetime="<?php echo get_the_time('c'); ?>"><?php the_time('F jS, Y') ?></time>
        </h6>
    </div>
</div>
    <?php }
    wp_reset_postdata();
}

/**
 * Add tweet intent button to text editor toolbar
 *
 * Modified from: http://zoerooney.com/blog/tutorials/inline-click-to-tweet-functionality
 */
function add_tweet_quicktag(){ ?>
	<script>
		// create a new quicktag button labeled "tweet"
		QTags.addButton( 'quicktweet', 'tweet', selection_callback );

		// on click, it triggers this callback:
	    function selection_callback(e, c, ed) {

	    	// we want to grab the selected text and we're going to get a URL as well
	        var selection, postURL, t = this;
	        if ( ed.canvas.selectionStart !== ed.canvas.selectionEnd ) {

	            // if there's selected text, grab it
	            selection = ed.canvas.value.substring  (ed.canvas.selectionStart, ed.canvas.selectionEnd);

	            // trigger the prompt for URL
	            postURL = prompt('Enter URL to include in Tweet');

	            // if there's no URL that's ok, it'll just be blank
	            if ( postURL === null ) return;

	            // generate the tag that will go before the selection
	            // include the selected text and the URL, if one was given
	            t.tagStart = '<span class="twitterBlockquote" data-tweet="' + selection + '" data-shorturl="' + postURL + '">';

	            // generate the tag that will go after the selection
	            t.tagEnd = '</span>';

	        } else {

	        	// if there's no selected text, show an alert message
	        	alert('Please select the text you\'d like to tweet');
	        	return false;
	        }
	        QTags.TagButton.prototype.callback.call(t, e, c, ed);
	    };
	</script>
<?php
} // end the function
add_action( 'admin_print_footer_scripts', 'add_tweet_quicktag' );

/**
 * Add featured image to RSS feed as enclosure
 *
 * Modified from: https://gist.githubusercontent.com/duogeekdev/b51f035d3d6927f69e48/raw/code.php
 */

function add_featured_image_in_rss() {

    if ( function_exists( 'get_the_image' ) && ( $featured_image = get_the_image('format=array&echo=0') ) ) {
        $featured_image[0] = $featured_image['url'];
    } elseif ( function_exists( 'has_post_thumbnail' ) and has_post_thumbnail() ) {
        $featured_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'post-thumbnail' );
    } elseif ( function_exists( 'get_post_thumbnail_src' ) ) {
        $featured_image = get_post_thumbnail_src();
        if ( preg_match( '|^<img src="([^"]+)"|', $featured_image[0], $m ) )
            $featured_image[0] = $m[1];
    } else {
        $featured_image = false;
    }

    if ( ! empty( $featured_image ) ) {
        echo "\t" . '<enclosure url="' . $featured_image[0] . '" />' . "\n";
    }

}

add_action( 'rss2_item', 'add_featured_image_in_rss' );

/**
 * Replace the WordPress gallery with a Slick Slider
 *
 * Modified from: https://rschu.me/using-slick-slider-with-wordpress-shortcode/
 */

// Remove hook for the default shortcode...
remove_shortcode('gallery', 'gallery_shortcode');
// .. and create a new shortcode with the default WordPress shortcode name (tag) for the gallery
add_shortcode('gallery', function($atts)
{
	$attrs =
		shortcode_atts(array(
			'slider'              => md5(microtime().rand()), // Slider ID (is per default unique)
			'slider_class_name'   => '', // Optional slider css class
			'ids'                 => '', // Comma separated list of image ids
			'size'                => 'thumbnail', // Image format (could be an custom image format)
			'slides_to_show'      => 1,
			'slides_to_scroll'    => 1,
			'dots'                => true,
			'infinite'            => true,
			'speed'               => 300,
			'touch_move'          => true,
			'autoplay'            => false,
			'autoplay_speed'      => 2000,
			'accessibility'       => true,
			'arrows'              => true,
			'center_mode'         => false,
			'center_padding'      => '50px',
			'css_ease'            => 'ease',
			'dots_class'          => 'slick-dots',
			'draggable'           => true,
			'easing'              => 'linear',
			'fade'                => false,
			'focus_on_select'     => false,
			'lazy_load'           => 'ondemand',
			'on_before_change'    => null,
			'pause_on_hover'      => true,
			'pause_on_dots_hover' => false,
			'rtl'                 => false,
			'slide'               => 'div',
			'swipe'               => true,
			'touch_move'          => true,
			'touch_threshold'     => 5,
			'use_css'             => true,
			'vertical'            => false,
			'wait_for_animate'    => true
		), $atts);

	extract($attrs);

	// Verify if the chosen image format really exist
	if( !in_array( $size, get_intermediate_image_sizes()) )
	{
		echo 'Image Format <strong>'.$size.'</strong> Not Available!';
		exit;
	}

	// Iterate over attribute array, cleanup and make the array elements JavaScript ready
	foreach( $attrs as $key => $attr )
	{
		// CamelCase the array keys
		$new_key_name = lcfirst(str_replace(array(' ', 'Css'), array('', 'CSS'), ucwords(str_replace('_', ' ', $key))));

		// Remove unnecessary array elements
		if( in_array($key, array('size', 'ids', 'slider_class_name')) || strpos($key, '_') !== false )
		{
			unset($attrs[$key]);
		}

		// Fix the type before passing the array elements to JavaScript
		if( is_numeric($attr) )
		{
			$attrs[$new_key_name] = (int) $attr;
		}else if( is_bool($attr) || (strpos($attr, 'true') !== false || strpos($attr, 'false') !== false) )
		{
			$attrs[$new_key_name] = filter_var($attr, FILTER_VALIDATE_BOOLEAN);
		}else if( is_int($attr) )
		{
			$attrs[$new_key_name] = filter_var($attr, FILTER_VALIDATE_INT);
		}
	}

	// Create an empty variable for return html content
	$html_output = '';

	// Check if the slider should be unique and do some unique stuff (*optional)
	if( ctype_xdigit($slider) && strlen($slider) === 32 )
	{
		$is_unique = true;
	}else{
		$is_unique = false;
	}

	// Initiate the slider with the slider id and pass the php array as a json object
	$html_output .= '<script>$(function() {$(".'.$slider.'").slick('.json_encode($attrs).'); });</script>';

	// Build the html slider structure (open)
	$html_output .= '<div class="'.$slider_class_name.' '.$slider.' slider wp-slick-slider">';

	// wp_get_attachment() function:
	function wp_get_attachment( $attachment_id ) {
	$attachment = get_post( $attachment_id );
	return array(
	'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
	'caption' => $attachment->post_excerpt,
	'description' => $attachment->post_content,
	'href' => get_permalink( $attachment->ID ),
	'src' => $attachment->guid,
	'title' => $attachment->post_title
	);
	}

	// Iterate over the comma separated list of image ids and keep only the real numeric ids
	foreach( array_filter( array_map(function($id){ return (int) $id; }, explode(',', $ids)) ) as $media_id) {

	// Get the image by media id and build the html div group with the image source, width and height
	if( $image_data = wp_get_attachment_image_src( $media_id, $size ) ) {

	// added metainfo using wp_get_attachment() function
	$image_meta = wp_get_attachment($media_id);

	$html_output .=
	'<div>
		<div class="image">
			<img src="'.esc_url($image_data[0]).'" class="img-responsive"/>
		</div>
		<div class="caption"><h3>'. $image_meta['caption'] .'</h3></div>
		<div class="description">'. $image_meta['description'] .'</div>
	</div>';
	}
	}

	// Close the html slider structure and return the html output
	return $html_output.'</div>';

});
