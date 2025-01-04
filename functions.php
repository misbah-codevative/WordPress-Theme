<?php
function my_theme_setup() {
    // Add title tag support
    add_theme_support('title-tag');
    
    // Add post thumbnail support
    add_theme_support('post-thumbnails');
    
}
add_action('after_setup_theme', 'my_theme_setup');

// Register Custom Menus Function
function my_custom_theme_register_menus() {
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'my-custom-theme'),
        'footer'  => __('Footer Menu', 'my-custom-theme'),
        'footer_1'     => __('Footer Menu 1', 'my-custom-theme'),
    ));
}
add_action('after_setup_theme', 'my_custom_theme_register_menus');
// END Register Custom Menus Function

// Enable All Core Blocks Function
function my_custom_theme_allowed_block_types($allowed_blocks, $editor_context) {
    if (!empty($editor_context->post)) {
        return WP_Block_Type_Registry::get_instance()->get_all_registered();
    }
    return $allowed_blocks;
}
add_filter('allowed_block_types_all', 'my_custom_theme_allowed_block_types', 10, 2);
// END Enable All Core Blocks Function

// Enqueue Bootstrap, OWL CAROUSEL CDN files
function my_custom_theme_enqueue_scripts() {
    // Bootstrap CSS
    wp_enqueue_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css', array(), '5.3.2');

    // Theme's Main CSS
    wp_enqueue_style('theme-style', get_stylesheet_uri(), array('bootstrap-css'));

    // Bootstrap JS
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js', array('jquery'), '5.3.2', true);

    // Owl Carousel CSS
    wp_enqueue_style('owl-carousel-css', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', array(), '2.3.4');
    wp_enqueue_style('owl-carousel-theme', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', array('owl-carousel-css'), '2.3.4');

    // Owl Carousel JS
    wp_enqueue_script('owl-carousel-js', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', array('jquery'), '2.3.4', true);

    // Custom JS
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery', 'owl-carousel-js'), null, true);
}
add_action('wp_enqueue_scripts', 'my_custom_theme_enqueue_scripts');
// END Enqueue Bootstrap, OWL CAROUSEL CDN files




// Custom Siderbar Function Hook
function my_theme_widgets_init() {
    register_sidebar(array(
        'name' => __('Main Sidebar', 'my-custom-theme'),
        'id' => 'main-sidebar',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'my_theme_widgets_init');
// END Custom Siderbar Function Hook

// Custom Post Type For Services
function custom_service_post_type() {
  
// Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x( 'Services', 'Post Type General Name', 'twentytwentyone' ),
        'singular_name'       => _x( 'Service', 'Post Type Singular Name', 'twentytwentyone' ),
        'menu_name'           => __( 'Services', 'twentytwentyone' ),
        'parent_item_colon'   => __( 'Parent Service', 'twentytwentyone' ),
        'all_items'           => __( 'All Services', 'twentytwentyone' ),
        'view_item'           => __( 'View Service', 'twentytwentyone' ),
        'add_new_item'        => __( 'Add New Service', 'twentytwentyone' ),
        'add_new'             => __( 'Add New', 'twentytwentyone' ),
        'edit_item'           => __( 'Edit Service', 'twentytwentyone' ),
        'update_item'         => __( 'Update Service', 'twentytwentyone' ),
        'search_items'        => __( 'Search Service', 'twentytwentyone' ),
        'not_found'           => __( 'Not Found', 'twentytwentyone' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwentyone' ),
    );
        
// Set other options for Custom Post Type
        
    $args = array(
        'label'               => __( 'services', 'twentytwentyone' ),
        'description'         => __( 'Service news and reviews', 'twentytwentyone' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
        // You can associate this CPT with a taxonomy or custom taxonomy. 
        'taxonomies'          => array( 'genres' ),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 5,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest' => true,
    
    );
        
    // Registering your Custom Post Type
    register_post_type( 'services', $args );
    
}
    
add_action( 'init', 'custom_service_post_type', 0 );
// END Custom Post Type For Services


// Add Custom Logo Field into Appeareance > Customizer > Site Identity
function mytheme_customize_register($wp_customize) {
    // Add the custom logo setting
    $wp_customize->add_setting('custom_logo_image', array(
        'default'           => '', // Default logo
        'sanitize_callback' => 'esc_url', // Sanitize URL
        'transport'         => 'refresh', // Refresh the page on change
    ));

    // Add the control for the custom logo
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'custom_logo_image_control',
        array(
            'label'    => __('Custom Logo', 'mytheme'),
            'section'  => 'title_tagline', // Add to Site Identity section
            'settings' => 'custom_logo_image',
        )
    ));
}
add_action('customize_register', 'mytheme_customize_register');

// Display the custom logo in the theme
function mytheme_display_custom_logo() {
    $custom_logo = get_theme_mod('custom_logo_image');
    if ($custom_logo) {
        echo '<img src="' . esc_url($custom_logo) . '" alt="' . get_bloginfo('name') . ' Logo">';
    }
}

// END Add Custom Logo Field into Appeareance > Customizer > Site Identity

// SVG File Upload Function
function enable_svg_support($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'enable_svg_support'); 
// END SVG File Upload Function


// Footer Widgets Function

function my_custom_theme_widgets_init() {
    register_sidebar( array(
        'name' => 'Footer Sidebar 1',
        'id' => 'footer-sidebar-1',
        'description' => 'Appears in the footer area',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar( array(
        'name' => 'Footer Sidebar 2',
        'id' => 'footer-sidebar-2',
        'description' => 'Appears in the footer area',
        'before_widget' => '<div id="%1$s" class="foot-nav">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar( array(
        'name' => 'Footer Sidebar 3',
        'id' => 'footer-sidebar-3',
        'description' => 'Appears in the footer area',
        'before_widget' => '<div id="%1$s" class="foot-nav">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar( array(
        'name' => 'Footer Sidebar 4',
        'id' => 'footer-sidebar-4',
        'description' => 'Appears in the footer area',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}
add_action('widgets_init', 'my_custom_theme_widgets_init');
// END Footer Widgets Function