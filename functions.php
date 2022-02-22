<?php
/**
 * Blank functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Blank
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}


if ( ! function_exists( 'blank_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function blank_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Blank, use a find and replace
		 * to change 'blank' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'blank', get_template_directory() . '/languages' );

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

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'blank' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'blank_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'blank_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blank_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'blank_content_width', 640 );
}
add_action( 'after_setup_theme', 'blank_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blank_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'blank' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'blank' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'blank_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function blank_scripts() {
	wp_enqueue_style( 'blank-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'blank-style', 'rtl', 'replace' );
    
    // Font-Awesome CSS.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), null );
    
	wp_enqueue_script( 'blank-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'blank_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/*-----------------------------------------------------------------------------------*/
/*	Post Excerpt
/*-----------------------------------------------------------------------------------*/
// Remove […] string
function blank_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'blank_excerpt_more');

// Add Shortcodes in Excerpt Field
add_filter( 'get_the_excerpt', 'do_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Exceprt Length
/*-----------------------------------------------------------------------------------*/
function blank_excerpt_limit( $limit ) {
  $blank_excerpt = explode(' ', get_the_excerpt(), $limit);
    
  if ( count( $blank_excerpt )>=$limit ) {
    array_pop($blank_excerpt);
    $blank_excerpt = implode(" ",$blank_excerpt).'...';
  } else {
    $blank_excerpt = implode(" ",$blank_excerpt);
  }
    
  $blank_excerpt = preg_replace('`[[^]]*]`','',$blank_excerpt);
    
  return $blank_excerpt;
}
add_filter( 'get_the_excerpt', 'do_shortcode');
/*-----------------------------------------------------------------------------------*/
/*	Breadcrumb
/*-----------------------------------------------------------------------------------*/
function blank_breadcrumb() {
	if (!is_home()) {
		echo '<span class="breadcrumb-item">';
		echo '<a itemprop="item" href="';
		echo home_url();
		echo '">';
        echo '<span itemprop="name">';
		echo __( 'Home','blank' );
		echo "</span>";
		echo "</a>";
		echo "</span>";
		if (is_category() || is_single()) {
			echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
            echo '<span class="breadcrumb-item">';
            echo '<span itemprop="item">';
			the_category(' &bull; ');
            echo "</span>";
            echo "</span>";
			if (is_single()) {
				echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
                echo '<span class="breadcrumb-item">';
                echo '<span itemprop="item">';
				the_title();
                echo "</span>";
                echo "</span>";
			}
		} elseif (is_page()) {
			echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
			echo the_title();
		}
	}
	elseif (is_tag()) {
		echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
		single_tag_title();
		}
	elseif (is_day()) {
		echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
		echo"Archive for "; the_time('F jS, Y');
		}
	elseif (is_month()) {
		echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
		echo"Archive for "; the_time('F, Y');
		}
	elseif (is_year()) {
		echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
		echo"Archive for "; the_time('Y');
		}
	elseif (is_author()) {
		echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
		echo"Author Archive";
		}
	elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
		echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
		echo "Blog Archives";
		}
	elseif (is_search()) {
		echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
		echo"Search Results"; 
		}
}

/*-----------------------------------------------------------------------------------*/
/*	Comments Callback
/*-----------------------------------------------------------------------------------*/
function blank_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
    ?>
	<li <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
        <?php endif; ?>
        <div class="comment-author vcard" >
            <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment->comment_author_email, 60 ); ?>
        </div>
        
        <div class="commentBody">
            <div class="commentHeader">
                <?php printf(__('<span class="fn">%s</span>','blank'), get_comment_author_link()) ?>
                <span class="comment-meta">
                    <time itemprop="commentTime" datetime="<?php echo esc_attr( get_comment_date( 'c' ) ); ?>">
                    <?php
                        printf( __('%1$s','blank'), get_comment_date())
                    ?>
                    </time>
                </span>
                 <span class="reply">
                    <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __(' Reply','blank')))) ?>
                </span>
            </div>
             
            <?php if ($comment->comment_approved == '0') : ?>
                <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.','blank') ?></em>
                <br />
            <?php endif; ?>

            <div class="comment-content" itemprop="commentText">
                <?php comment_text() ?>
            </div>
        </div><!--.commentBody-->
	</div>
    <?php
}



if ( is_admin() ) {
	require get_template_directory() . '/inc/admin-functions.php';
}

