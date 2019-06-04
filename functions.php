<?php
/*
 *  Custom functions, support, custom post types and more.
 */


/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if( function_exists('acf_add_options_page') ) {
    acf_add_options_page();
}

if (!isset($content_width))
{
    $content_width = 900;
}

function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    $mimes['exe'] = 'application/exe';
    $mimes['ai']  = 'application/postscript';
    $mimes['eps'] = 'application/postscript';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


add_action('admin_head', 'custom_styles');
function custom_styles() {
    // "global" field set and big section block indicators
  echo '<style>
    .field-content_sections .acf-fields {
     border-bottom: 3px solid #666;
    } 
  </style>';
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    // add_theme_support('menus');
    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('news_thumb', 680, 280, true); // Large Thumbnail
    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');
    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

function theme_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        //Cannot register custom jQuery without deregistering Wordpress version first. Wordpress version works fine, only enqueue is required.
        //wp_register_script('jquery', get_template_directory_uri() . '/assets/libs/jquery.min.js',[],false,true);
        wp_enqueue_script('jquery'); 

        wp_register_script('modernizr', get_template_directory_uri() . '/assets/libs/modernizr.js',[],false,true);
        wp_enqueue_script('modernizr'); 

        wp_register_script('bootstrap', get_template_directory_uri() . '/assets/libs/bootstrap.js',[],'4.3.1-0',true);
        wp_enqueue_script('bootstrap'); 

        wp_register_script('fancybox','https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.js',[],false,true);
        wp_enqueue_script('fancybox'); 

        wp_register_script('slick', get_template_directory_uri() . '/assets/libs/slick.js',[],false,true);
        wp_enqueue_script('slick'); 


        wp_register_script('scrollreveal', get_template_directory_uri() . '/assets/libs/scrollreveal.min.js',[],false,true);
        wp_enqueue_script('scrollreveal'); 

        wp_register_script('countup', get_template_directory_uri() . '/assets/libs/countup.js',[],false,true);
        wp_enqueue_script('countup'); 

        wp_register_script('waypoints', get_template_directory_uri() . '/assets/libs/waypoints-with-inview.js',[],false,true);
        wp_enqueue_script('waypoints'); 

        wp_register_script('selectric', get_template_directory_uri() . '/assets/libs/jquery.selectric.js',[],false,true);
        wp_enqueue_script('selectric'); 

        // change to vue.min.js for prod to get rid of debugger
        //wp_register_script('vue','https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js',[],false,true);
        wp_register_script('vue','https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js',[],false,true);
        wp_enqueue_script('vue'); 

        wp_register_script('dash', get_template_directory_uri() . '/assets/dash.js',[],'1.2',true);
        wp_enqueue_script('dash');
        wp_register_script('vue-buyspend', get_template_directory_uri() . '/assets/vue-buyspend.js',[],'1.1',true);
        wp_enqueue_script('vue-buyspend');
        wp_register_script('vue-proposals', get_template_directory_uri() . '/assets/vue-proposals.js',[],false,true);
        wp_enqueue_script('vue-proposals');
        wp_register_script('vue-team', get_template_directory_uri() . '/assets/vue-team.js',[],false,true);
        wp_enqueue_script('vue-team');
        if (is_page_template( 'page-downloads.php' )) {
            wp_register_script('platform', get_template_directory_uri() . '/assets/libs/platform.js',[],false,false);
            wp_enqueue_script('platform');
            wp_register_script('downloads', get_template_directory_uri() . '/assets/downloads.js',[],'1.21',false);
            wp_enqueue_script('downloads');
            $translation_array = array(
                'download_windows' => __( 'Download for Windows' ),
                'download_macos' => __( 'Download for macOS'),
                'download_linux' => __('Download for Linux'),
                'download_android' => __('Download for Android'),
                'download_ios' => __('Download for iOS')
            );
            wp_localize_script( 'downloads', 'download_texts', $translation_array );
        }
    }
}

// Load HTML5 Blank styles
function theme_styles()
{
    wp_register_style('bootstrapcss', get_template_directory_uri() . '/assets/libs/bootstrap-rtl.css', array(), '4.3.1-0', 'all');
    wp_enqueue_style('bootstrapcss');

    wp_register_style('slick', get_template_directory_uri() . '/assets/libs/slick.css', array(), '1.0', 'all');
    wp_enqueue_style('slick');

    wp_register_style('selectric', get_template_directory_uri() . '/assets/libs/selectric.css', array(), '1.0', 'all');
    wp_enqueue_style('selectric');


    wp_register_style('fancyboxcss', 'https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.css', '1.0', 'all');
    wp_enqueue_style('fancyboxcss');
    
    // Remove time() and replace with static version number after strophy finishes fixing CSS
    wp_register_style('dashcss', get_template_directory_uri() . '/assets/dash.css', array(), '1.22', 'all');
    wp_enqueue_style('dashcss');

}


// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}



// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = wp_trim_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// End of post excerpt
function html5_blank_view_article($more)
{
    global $post;
    // return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
    return "...";
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}




/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('wp_enqueue_scripts', 'theme_scripts'); // Add Custom Scripts to wp_head. This should be done in wp_enqueue_scripts, not init.
add_action('wp_enqueue_scripts', 'theme_styles'); // Add Theme Stylesheet
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 ); // Display the oEmbed discovery links
remove_action( 'wp_head', 'wp_oembed_add_host_js' ); // Include link to wp-embed.min.js
remove_action('rest_api_init', 'wp_oembed_register_route'); // Register REST API
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether



?>
