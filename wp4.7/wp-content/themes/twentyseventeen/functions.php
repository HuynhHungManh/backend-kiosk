<?php
/**
 * Twenty Seventeen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

/**
 * Twenty Seventeen only works in WordPress 4.7 or later.
 */
include('selector.inc');
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */


function add_new_posts_admin_column($column) {
		$column['hoVaTen'] = 'Họ và tên';
		$column['soDienThoai'] = 'Số điện thoại';
		$column['email'] = 'Email';
		$column['noiDung'] = 'Nội dung';
    return $column;
}

add_filter('manage_gop_y_posts_columns', 'add_new_posts_admin_column');

add_filter('manage_gop_y_posts_columns','my_manage_columns');

function my_manage_columns( $columns ) {
	unset(
		$columns['title'],
		$columns['date'],
		$columns['tags'],
		$columns['cb']
	);
  return $columns;
}

function my_column_init() {
  //add_filter( 'manage_posts_columns' , 'my_manage_columns');
}
add_action( 'admin_init' , 'my_column_init' );


function add_new_posts_admin_column_show_value($column_name) {
    if ($column_name == 'hoVaTen') {
				echo get_field('hoVaTen');
    }
		if ($column_name == 'soDienThoai') {
				echo get_field('soDienThoai');
    }
		if ($column_name == 'email') {
				echo get_field('email');
    }
		if ($column_name == 'noiDung') {
				echo get_field('noiDung');
    }
}
add_action( 'init', function() {
    remove_post_type_support( 'post', 'editor' );
    remove_post_type_support( 'page', 'editor' );
		remove_post_type_support( 'lich_lam_viec', 'editor' );
		remove_post_type_support( 'thong_bao', 'editor' );

}, 99);


add_action('admin_init', 'remove_all_media_buttons');

function remove_all_media_buttons()
{
remove_all_actions('media_buttons');
}

add_action('manage_posts_custom_column', 'add_new_posts_admin_column_show_value', 10, 2);


add_action( 'init', 'my_custom_post_type_rest_support', 25 );
 function my_custom_post_type_rest_support() {
	 global $wp_post_types;
	 $post_type_name = 'planet';
	 if( isset( $wp_post_types[ $post_type_name ] ) ) {
		 $wp_post_types[$post_type_name]->show_in_rest = true;
		 $wp_post_types[$post_type_name]->rest_base = $post_type_name;
		 $wp_post_types[$post_type_name]->rest_controller_class = 'WP_REST_Posts_Controller';
	 }
 }

 add_action( 'init', 'my_custom_taxonomy_rest_support', 25 );
  function my_custom_taxonomy_rest_support() {
  	global $wp_taxonomies;
  	$taxonomy_name = 'planet_class';
  	if ( isset( $wp_taxonomies[ $taxonomy_name ] ) ) {
  		$wp_taxonomies[ $taxonomy_name ]->show_in_rest = true;
  		$wp_taxonomies[ $taxonomy_name ]->rest_base = $taxonomy_name;
  		$wp_taxonomies[ $taxonomy_name ]->rest_controller_class = 'WP_REST_Terms_Controller';
  	}
  }


function twentyseventeen_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentyseventeen
	 * If you're building a theme based on Twenty Seventeen, use a find and replace
	 * to change 'twentyseventeen' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentyseventeen' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'twentyseventeen-featured-image', 2000, 1200, true );

	add_image_size( 'twentyseventeen-thumbnail-avatar', 100, 100, true );

	// Set the default content width.
	$GLOBALS['content_width'] = 525;

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'top'    => __( 'Top Menu', 'twentyseventeen' ),
		'social' => __( 'Social Links Menu', 'twentyseventeen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'audio',
	) );

	// Add theme support for Custom Logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 250,
		'height'      => 250,
		'flex-width'  => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, and column width.
 	 */
	add_editor_style( array( 'assets/css/editor-style.css', twentyseventeen_fonts_url() ) );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
			// Place three core-defined widgets in the sidebar area.
			'sidebar-1' => array(
				'text_business_info',
				'search',
				'text_about',
			),

			// Add the core-defined business info widget to the footer 1 area.
			'sidebar-2' => array(
				'text_business_info',
			),

			// Put two core-defined widgets in the footer 2 area.
			'sidebar-3' => array(
				'text_about',
				'search',
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/espresso.jpg', // URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/coffee.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'top' => array(
				'name' => __( 'Top Menu', 'twentyseventeen' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name' => __( 'Social Links Menu', 'twentyseventeen' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters Twenty Seventeen array of starter content.
	 *
	 * @since Twenty Seventeen 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'twentyseventeen_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'twentyseventeen_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function twentyseventeen_content_width() {

	$content_width = $GLOBALS['content_width'];

	// Get layout.
	$page_layout = get_theme_mod( 'page_layout' );

	// Check if layout is one column.
	if ( 'one-column' === $page_layout ) {
		if ( twentyseventeen_is_frontpage() ) {
			$content_width = 644;
		} elseif ( is_page() ) {
			$content_width = 740;
		}
	}

	// Check if is single post and there is no sidebar.
	if ( is_single() && ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 740;
	}

	/**
	 * Filter Twenty Seventeen content width of the theme.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param $content_width integer
	 */
	$GLOBALS['content_width'] = apply_filters( 'twentyseventeen_content_width', $content_width );
}
add_action( 'template_redirect', 'twentyseventeen_content_width', 0 );

/**
 * Register custom fonts.
 */
function twentyseventeen_fonts_url() {
	$fonts_url = '';

	/**
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Libre Franklin font: on or off', 'twentyseventeen' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Libre Franklin:300,300i,400,400i,600,600i,800,800i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function twentyseventeen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentyseventeen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentyseventeen_resource_hints', 10, 2 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentyseventeen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'twentyseventeen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 1', 'twentyseventeen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer 2', 'twentyseventeen' ),
		'id'            => 'sidebar-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentyseventeen_widgets_init' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since Twenty Seventeen 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function twentyseventeen_excerpt_more( $link ) {
	if ( is_admin() ) {
		return $link;
	}

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentyseventeen' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'twentyseventeen_excerpt_more' );

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Seventeen 1.0
 */
function twentyseventeen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyseventeen_javascript_detection', 0 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function twentyseventeen_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'twentyseventeen_pingback_header' );

/**
 * Display custom color CSS.
 */
function twentyseventeen_colors_css_wrap() {
	if ( 'custom' !== get_theme_mod( 'colorscheme' ) && ! is_customize_preview() ) {
		return;
	}

	require_once( get_parent_theme_file_path( '/inc/color-patterns.php' ) );
	$hue = absint( get_theme_mod( 'colorscheme_hue', 250 ) );
?>
	<style type="text/css" id="custom-theme-colors" <?php if ( is_customize_preview() ) { echo 'data-hue="' . $hue . '"'; } ?>>
		<?php echo twentyseventeen_custom_colors_css(); ?>
	</style>
<?php }
add_action( 'wp_head', 'twentyseventeen_colors_css_wrap' );

/**
 * Enqueue scripts and styles.
 */
function twentyseventeen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyseventeen-fonts', twentyseventeen_fonts_url(), array(), null );

	// Theme stylesheet.
	wp_enqueue_style( 'twentyseventeen-style', get_stylesheet_uri() );

	// Load the dark colorscheme.
	if ( 'dark' === get_theme_mod( 'colorscheme', 'light' ) || is_customize_preview() ) {
		wp_enqueue_style( 'twentyseventeen-colors-dark', get_theme_file_uri( '/assets/css/colors-dark.css' ), array( 'twentyseventeen-style' ), '1.0' );
	}

	// Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
	if ( is_customize_preview() ) {
		wp_enqueue_style( 'twentyseventeen-ie9', get_theme_file_uri( '/assets/css/ie9.css' ), array( 'twentyseventeen-style' ), '1.0' );
		wp_style_add_data( 'twentyseventeen-ie9', 'conditional', 'IE 9' );
	}

	// Load the Internet Explorer 8 specific stylesheet.
	wp_enqueue_style( 'twentyseventeen-ie8', get_theme_file_uri( '/assets/css/ie8.css' ), array( 'twentyseventeen-style' ), '1.0' );
	wp_style_add_data( 'twentyseventeen-ie8', 'conditional', 'lt IE 9' );

	// Load the html5 shiv.
	wp_enqueue_script( 'html5', get_theme_file_uri( '/assets/js/html5.js' ), array(), '3.7.3' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'twentyseventeen-skip-link-focus-fix', get_theme_file_uri( '/assets/js/skip-link-focus-fix.js' ), array(), '1.0', true );

	$twentyseventeen_l10n = array(
		'quote'          => twentyseventeen_get_svg( array( 'icon' => 'quote-right' ) ),
	);

	if ( has_nav_menu( 'top' ) ) {
		wp_enqueue_script( 'twentyseventeen-navigation', get_theme_file_uri( '/assets/js/navigation.js' ), array( 'jquery' ), '1.0', true );
		$twentyseventeen_l10n['expand']         = __( 'Expand child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['collapse']       = __( 'Collapse child menu', 'twentyseventeen' );
		$twentyseventeen_l10n['icon']           = twentyseventeen_get_svg( array( 'icon' => 'angle-down', 'fallback' => true ) );
	}

	wp_enqueue_script( 'twentyseventeen-global', get_theme_file_uri( '/assets/js/global.js' ), array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'jquery-scrollto', get_theme_file_uri( '/assets/js/jquery.scrollTo.js' ), array( 'jquery' ), '2.1.2', true );

	wp_localize_script( 'twentyseventeen-skip-link-focus-fix', 'twentyseventeenScreenReaderText', $twentyseventeen_l10n );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'twentyseventeen_scripts' );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function twentyseventeen_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 740 <= $width ) {
		$sizes = '(max-width: 706px) 89vw, (max-width: 767px) 82vw, 740px';
	}

	if ( is_active_sidebar( 'sidebar-1' ) || is_archive() || is_search() || is_home() || is_page() ) {
		if ( ! ( is_page() && 'one-column' === get_theme_mod( 'page_options' ) ) && 767 <= $width ) {
			 $sizes = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
		}
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'twentyseventeen_content_image_sizes_attr', 10, 2 );

/**
 * Filter the `sizes` value in the header image markup.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $html   The HTML image tag markup being filtered.
 * @param object $header The custom header object returned by 'get_custom_header()'.
 * @param array  $attr   Array of the attributes for the image tag.
 * @return string The filtered header image HTML.
 */
function twentyseventeen_header_image_tag( $html, $header, $attr ) {
	if ( isset( $attr['sizes'] ) ) {
		$html = str_replace( $attr['sizes'], '100vw', $html );
	}
	return $html;
}
add_filter( 'get_header_image_tag', 'twentyseventeen_header_image_tag', 10, 3 );

/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for post thumbnails.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array $attr       Attributes for the image markup.
 * @param int   $attachment Image attachment ID.
 * @param array $size       Registered image size or flat array of height and width dimensions.
 * @return string A source size value for use in a post thumbnail 'sizes' attribute.
 */

 function cf_search_join( $join ) {
     global $wpdb;

     if ( is_search() ) {
         $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
     }

     return $join;
 }
 add_filter('posts_join', 'cf_search_join' );

 function cf_search_where( $where ) {
   global $pagenow, $wpdb;

    if ( is_search() ) {
       $where = preg_replace(
         "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
         "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
     }

    return $where;
    }
  add_filter( 'posts_where', 'cf_search_where' );


  function cf_search_distinct( $where ) {
    global $wpdb;

     if ( is_search() ) {
         return "DISTINCT";
    }

    return $where;
  }
  add_filter( 'posts_distinct', 'cf_search_distinct' );
function twentyseventeen_post_thumbnail_sizes_attr( $attr, $attachment, $size ) {
	if ( is_archive() || is_search() || is_home() ) {
		$attr['sizes'] = '(max-width: 767px) 89vw, (max-width: 1000px) 54vw, (max-width: 1071px) 543px, 580px';
	} else {
		$attr['sizes'] = '100vw';
	}

	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'twentyseventeen_post_thumbnail_sizes_attr', 10, 3 );

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function twentyseventeen_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template',  'twentyseventeen_front_page_template' );

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path( '/inc/custom-header.php' );

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_parent_theme_file_path( '/inc/customizer.php' );

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path( '/inc/icon-functions.php' );

function prefix_get_endpoint_phrase($request) {

		$data=json_decode($request->get_body());
		$postarr=array(
			'post_type'=> "gop_y",
			'post_title'=>$data->title,
			'post_status'=>'publish'
		);

		$idpost = wp_insert_post($postarr);

		add_post_meta($idpost,'hoVaTen',$data->hoVaTen);
		add_post_meta($idpost,'email',$data->email);
		add_post_meta($idpost,'soDienThoai',$data->soDienThoai);
		add_post_meta($idpost,'noiDung',$data->noiDung);

		$resultm = get_post($idpost);
    // rest_ensure_response() wraps the data we want to return into a WP_REST_Response, and ensures it will be properly returned.
    return rest_ensure_response($result);
}

/**
 * This function is where we register our routes for our example endpoint.
 */

 function prefix_get_endpoint_phrase_rating() {
		$html = file_get_contents('http://cchc.danang.gov.vn/index.php?option=com_mucdohailong&controller=danhgiacongchuc&task=loadCanbo&format=raw&coquan=150945');
		$arr = select_elements('#tasks .li_canbo img', $html);
		$data = array();

		foreach ($arr as $key => $value) {
		    $name = select_elements('#tasks .li_canbo .lbl:nth-child(1)', $html)[$key]["text"];
		    $dOB = str_replace("Ngày sinh ","",select_elements('#tasks .li_canbo .lbl:nth-child(2)', $html)[$key]["text"]);
		    $image = $value["attributes"]["src"];
		    $level = str_replace("Trình độ học vấn: ","",select_elements('#tasks .li_canbo .lbl:nth-child(3)', $html)[$key]["text"]);
		    $position = str_replace("Chức vụ: ","",select_elements('#tasks .li_canbo .lbl:nth-child(4)', $html)[$key]["text"]);

		    $to_encode = array(
					'id' => $key,
					'name' => $name,
		      'dOB' => $dOB,
		      'image' => $image,
		      'level' => $level,
		      'position' => $position,
		    );
		    array_push($data,$to_encode);
		}
    return $data;
 }

 function prefix_get_endpoint_phrase_procedure($request) {
		$data=json_decode($request->get_body());
		if($data->coQuan === null && $data->linhVuc === null && $data->tenThuTuc === null){
			$ch = curl_init("http://tthc.danang.gov.vn/index.php?option=com_thutuchanhchinh&task=getListThutucFromDB&dept_id=44230");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$result = curl_exec($ch);
			$dataAll = json_decode($result, true);
		}
		else{
			$fields = array(
	       'filter_coquan' => $data->coQuan,
	       'filter_linhvuc' => $data->linhVuc,
	       'filter_tenthutuc' => $data->tenThuTuc,
				 'dept_id' => 44230
	    );
			$url = 'http://tthc.danang.gov.vn/index.php?option=com_thutuchanhchinh&task=getListThutucFromDB';
	    $postvars = http_build_query($fields);
	    $ch = curl_init();
	 	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 	  curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_POST, count($fields));
	 	  curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
	    $result = curl_exec($ch);
	 	 	$dataAll = json_decode($result, true);
		}

		$arrAddIndex = array();
		$index = 1;
		foreach ($dataAll["data"] as $key => $value) {
			if(($key+1) %20 !== 0){
				$arrPage = array(
					'indexPage' => $index,
					'data' => $value,
					'stt' => $key+1
				);
				array_push($arrAddIndex,$arrPage);
			}
			else{
				$arrPage = array(
					'indexPage' => $index,
					'data' => $value,
					'stt' => $key+1
				);
				array_push($arrAddIndex,$arrPage);
				$index++;
			}
		}
		if($index !== $arrAddIndex[$dataAll["recordsTotal"]-1]["indexPage"]){
			$index--;
		}
		$dataOfPage = array();
		foreach ($arrAddIndex as $key => $value) {
			if($value["indexPage"] === $data->index){
				array_push($dataOfPage,$value);
			}
		}
		$fromPage = $dataOfPage[19][stt];

		if($fromPage === undefined || $fromPage === null){
			$fromPage = $dataAll[recordsTotal];
		}

		$dataOfPage = array(
		 	 totalPage => $index,
			 totalRecord => $dataAll[recordsTotal],
		 	 data => $dataOfPage,
			 fromPage => $dataOfPage[0][stt],
			 toPage => $fromPage,
			 indexPage => $dataOfPage[0][indexPage]
	 );
		return $dataOfPage;
 }

 function prefix_get_endpoint_phrase_search_procedure($request) {
	 $data=json_decode($request->get_body());
	 if($data->coQuan === "" && $data->linhVuc === "" && $data->tenThuTuc === ""){
		 return array(
					 				totalPage => 1,
					 				totalRecord => 0,
					 				data => []
 									);
	 }
   $fields = array(
      'filter_coquan' => $data->coQuan,
      'filter_linhvuc' => $data->linhVuc,
      'filter_tenthutuc' => $data->tenThuTuc,
			'dept_id'=> 44230
   );

	 $url = 'http://tthc.danang.gov.vn/index.php?option=com_thutuchanhchinh&task=getListThutucFromDB';
   $postvars = http_build_query($fields);
   $ch = curl_init();
	 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 curl_setopt($ch, CURLOPT_HEADER, 0);
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_POST, count($fields));
	 curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
   $result = curl_exec($ch);
	 $dataAll = json_decode($result, true);

	 if(count($dataAll)>0){
		 $arrAddIndex = array();
		 $index = 1;
		 foreach ($dataAll["data"] as $key => $value) {
			 if(($key+1) % 20 !== 0){
				 $arrPage = array(
					 'indexPage' => $index,
					 'data' => $value,
					 'stt' => $key+1
				 );
				 array_push($arrAddIndex,$arrPage);
			 }
			 else{
				 $arrPage = array(
					 'indexPage' => $index,
					 'data' => $value,
					 'stt' => $key+1
				 );
				 array_push($arrAddIndex,$arrPage);
				 $index++;
			 }
		 }

		 $dataOfPage = array();
		 foreach ($arrAddIndex as $key => $value) {
			 if($value["indexPage"] === 1){
				 array_push($dataOfPage,$value);
			 }
		 }
		 $fromPage = $dataOfPage[19][stt];

		 if($fromPage === undefined || $fromPage === null){
			 $fromPage = $dataAll[recordsTotal];
		 }

		 $dataOfPage = array(
				totalPage => $index,
				totalRecord => $dataAll[recordsTotal],
				data => $dataOfPage,
				fromPage => $dataOfPage[0][stt],
				toPage => $fromPage,
				indexPage => $dataOfPage[0][indexPage]
		);
		 return $dataOfPage;
	 }
	 else{
		 return $dataOfPage = array(
 				totalPage => 1,
 				totalRecord => 0,
 				data => []
 		);
	 }
 }

 function prefix_get_endpoint_phrase_unit_procedure() {
	 $html = file_get_contents('http://tthc.danang.gov.vn/index.php?option=com_thutuchanhchinh&controller=thutuchanhchinh&type=1&task=thutuc&format=raw&dept_id=44230');
	 $arr = select_elements('#filter_coquan',$html);
	 $data = array();

	 foreach ($arr[0]["children"] as $key => $value) {
	   $name = $value["text"];
	   $to_encode = array(
	     'id' => $key,
	     'name' => $name,
			 'value' => $name
	   );
	   array_push($data,$to_encode);
	 }
	 $data[0][name] = "Tất cả";
	 return $data;
 }

 function prefix_get_endpoint_phrase_field_procedure() {
	 $html = file_get_contents('http://tthc.danang.gov.vn/index.php?option=com_thutuchanhchinh&controller=thutuchanhchinh&type=1&task=thutuc&format=raw&dept_id=44230');
	 $arr = select_elements('#filter_linhvuc',$html);
	 $data = array();

	 foreach ($arr[0]["children"] as $key => $value) {
	   $name = $value["text"];
	   $to_encode = array(
	     'id' => $key,
	     'name' => $name,
			 'value' => $name
	   );
	   array_push($data,$to_encode);
	 }
	 $data[0][name] = "Tất cả";
	 return $data;
 }

 function prefix_get_endpoint_phrase_get_all_document(){
	 $query = new WP_Query( array( 'posts_per_page' => -1 ));
	 $arr = $query->posts;
	 $data = array();
	 foreach ($arr as $key => $value) {
	 	$to_encode = array(
	 		'id' => $value->ID,
			'acf' => array( 'fileBieuMau' => get_field("fileBieuMau", $value->ID ),
										  'fileBieuMauHuongDan' => get_field("fileBieuMauHuongDan", $value->ID )),
			'author' => $value->post_author,
			'slug'  => $value->post_name,
			'title'  => array('rendered'=>$value->post_title),
			'categories' => array($value->post_parent)
	 	);
	 	array_push($data,$to_encode);
	 }

	 return $data;
 }

 function prefix_get_endpoint_phrase_search_document($request){
		$data=json_decode($request->get_body());
		$string = trim(strtolower($data->nameDocument));
		$category_detail=get_the_category( 459 );
	  $query = new WP_Query( array( 'posts_per_page' => -1 ));
	  $arr = $query->posts;
	  $data = array();
	  foreach ($arr as $key => $value) {
			 if(strpos($value->post_title, $string) !== false){
					 $to_encode = array(
						  'id' => $value->ID,
						  'acf' => array( 'fileBieuMau' => get_field("fileBieuMau", $value->ID ),
						 								 'fileBieuMauHuongDan' => get_field("fileBieuMauHuongDan", $value->ID )),
						  'author' => $value->post_author,
						  'slug'  => $value->post_name,
						  'title'  => array('rendered'=>$value->post_title),
						  'categories' => array(get_the_category($value->ID)[0]->term_id)
						  );
						  array_push($data,$to_encode);
				   }
			}
	  return $data;
 }

 function prefix_get_endpoint_phrase_get_document_by_id_categories($request){
	$args = array(
	'posts_per_page'   => -1,
	'offset'           => 0,
	'category'         => $request["idCat"],
	'category_name'    => '',
	'orderby'          => 'date',
	'order'            => 'DESC',
	'include'          => '',
	'exclude'          => '',
	'meta_key'         => '',
	'meta_value'       => '',
	'post_type'        => 'post',
	'post_mime_type'   => '',
	'post_parent'      => '',
	'author'	   => '',
	'author_name'	   => '',
	'post_status'      => 'publish',
	'suppress_filters' => true
	);
	$arr = get_posts( $args );
	$category = get_term( $request["idCat"], 'category' );
  $data = array();
  foreach ($arr as $key => $value) {
 		 $to_encode = array(
  	 		'id' => $value->ID,
  			'acf' => array( 'fileBieuMau' => get_field("fileBieuMau", $value->ID),
  										  'fileBieuMauHuongDan' => get_field("fileBieuMauHuongDan", $value->ID)),
  			'author' => $value->post_author,
  			'slug'  => $value->post_name,
  			'title'  => array('rendered'=>$value->post_title),
 			  'categories' => array((int)$request["idCat"])
  	 	);
 			array_push($data,$to_encode);
 	 }
	// $path = "https://docs.google.com/gview?url=http://demo.api.kioskthanhkhe.greenglobal.vn:9973/wp-content/uploads/2017/09/M%E1%BA%ABu-b%E1%BA%A3n-c%C3%B4ng-b%E1%BB%91-h%E1%BB%A3p-quy-ho%E1%BA%B7c-c%C3%B4ng-b%E1%BB%91-ph%C3%B9-h%E1%BB%A3p-quy-%C4%91%E1%BB%8Bnh-an-to%C3%A0n-th%E1%BB%B1c-ph%E1%BA%A9m_Ngh%E1%BB%8B-%C4%91%E1%BB%8Bnh-s%E1%BB%91-382012N%C4%90-CP.docx&embedded=true&zoom=30";
	// $b64Doc = chunk_split(base64_encode(file_get_contents($path)));
  return $data;
 }


function prefix_register_example_routes() {
    // register_rest_route() handles more arguments but we are going to stick to the basics for now.
    register_rest_route( 'wp/v2', '/gop-y', array(
        // By using this constant we ensure that when the WP_REST_Server changes our readable endpoints will work as intended.
        'methods'  => 'POST',
        // Here we register our callback. The callback is fired when this endpoint is matched by the WP_REST_Server class.
        'callback' => 'prefix_get_endpoint_phrase',
				// 'validate_callback'=>'',
    ) );
		register_rest_route( 'wp/v2', '/danh-gia', array(
        // By using this constant we ensure that when the WP_REST_Server changes our readable endpoints will work as intended.
        'methods'  => 'GET',
        // Here we register our callback. The callback is fired when this endpoint is matched by the WP_REST_Server class.
        'callback' => 'prefix_get_endpoint_phrase_rating',
				// 'validate_callback'=>'',
    ) );

		register_rest_route( 'wp/v2', '/thu-tuc', array(
        // By using this constant we ensure that when the WP_REST_Server changes our readable endpoints will work as intended.
        'methods'  => 'POST',
        // Here we register our callback. The callback is fired when this endpoint is matched by the WP_REST_Server class.
        'callback' => 'prefix_get_endpoint_phrase_procedure',
				// 'validate_callback'=>'',
    ) );

		register_rest_route( 'wp/v2', '/tra-cuu-thu-tuc', array(
        // By using this constant we ensure that when the WP_REST_Server changes our readable endpoints will work as intended.
        'methods'  => 'POST',
        // Here we register our callback. The callback is fired when this endpoint is matched by the WP_REST_Server class.
        'callback' => 'prefix_get_endpoint_phrase_search_procedure',
				// 'validate_callback'=>'',
    ) );

		register_rest_route( 'wp/v2', '/co-quan', array(
        // By using this constant we ensure that when the WP_REST_Server changes our readable endpoints will work as intended.
        'methods'  => 'GET',
        // Here we register our callback. The callback is fired when this endpoint is matched by the WP_REST_Server class.
        'callback' => 'prefix_get_endpoint_phrase_unit_procedure',
				// 'validate_callback'=>'',
    ) );

		register_rest_route( 'wp/v2', '/linh-vuc', array(
        // By using this constant we ensure that when the WP_REST_Server changes our readable endpoints will work as intended.
        'methods'  => 'GET',
        // Here we register our callback. The callback is fired when this endpoint is matched by the WP_REST_Server class.
        'callback' => 'prefix_get_endpoint_phrase_field_procedure',
				// 'validate_callback'=>'',
    ) );

		register_rest_route( 'wp/v2', '/all-document', array(
        // By using this constant we ensure that when the WP_REST_Server changes our readable endpoints will work as intended.
        'methods'  => 'GET',
        // Here we register our callback. The callback is fired when this endpoint is matched by the WP_REST_Server class.
        'callback' => 'prefix_get_endpoint_phrase_get_all_document',
				// 'validate_callback'=>'',
    ) );

		register_rest_route( 'wp/v2', '/posts/search-document', array(
        // By using this constant we ensure that when the WP_REST_Server changes our readable endpoints will work as intended.
        'methods'  => 'POST',
        // Here we register our callback. The callback is fired when this endpoint is matched by the WP_REST_Server class.
        'callback' => 'prefix_get_endpoint_phrase_search_document',
				// 'validate_callback'=>'',
    ) );

		register_rest_route( 'wp/v2', 'posts/get-document-id-category/(?P<idCat>\d+)', array(
        // By using this constant we ensure that when the WP_REST_Server changes our readable endpoints will work as intended.
	        'methods'  => 'GET',
        // Here we register our callback. The callback is fired when this endpoint is matched by the WP_REST_Server class.
        'callback' => 'prefix_get_endpoint_phrase_get_document_by_id_categories'
				// 'validate_callback'=>'',
    ) );

}


add_action( 'rest_api_init', 'prefix_register_example_routes' );
