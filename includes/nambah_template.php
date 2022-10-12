<?php

/**
 * Add "Custom" template to page attirbute template section.
 */
function add_template_to_select( $post_templates, $wp_theme, $post, $post_type ) {

    // Add custom template named template-custom.php to select dropdown 
    $post_templates['kosongan.php'] = __('# Leson Template - Kosongan');
    $post_templates['dashboard.php'] = __('# Leson Template - Dashboard');
    $post_templates['dashboard-no-sidebar.php'] = __('# Leson Template - Dashboard No Sidebar');
    $post_templates['detail-produk.php'] = __('# Leson Template - Detail Product');
    $post_templates['page-produk.php'] = __('# Leson Template - Page Product');

    return $post_templates;
}

add_filter( 'theme_page_templates', 'add_template_to_select', 10, 4 );


/**
 * Check if current page has our custom template. Try to load
 * template from theme directory and if not exist load it 
 * from root plugin directory.
 */
function load_plugin_template( $template ) {

    if(  get_page_template_slug() === 'kosongan.php' ) {

        if ( $theme_file = locate_template( array( 'kosongan.php' ) ) ) {
            $template = $theme_file;
        } else {
            $template = plugin_dir_path( __FILE__ ) . 'templates/kosongan.php';
        }
    }
    if(  get_page_template_slug() === 'dashboard.php' ) {

        if ( $theme_file = locate_template( array( 'dashboard.php' ) ) ) {
            $template = $theme_file;
        } else {
            $template = plugin_dir_path( __FILE__ ) . 'templates/dashboard.php';
        }
    }
    if(  get_page_template_slug() === 'dashboard-no-sidebar.php' ) {

        if ( $theme_file = locate_template( array( 'dashboard-no-sidebar.php' ) ) ) {
            $template = $theme_file;
        } else {
            $template = plugin_dir_path( __FILE__ ) . 'templates/dashboard-no-sidebar.php';
        }
    }
    if(  get_page_template_slug() === 'detail-produk.php' ) {

        if ( $theme_file = locate_template( array( 'detail-produk.php' ) ) ) {
            $template = $theme_file;
        } else {
            $template = plugin_dir_path( __FILE__ ) . 'templates/detail-produk.php';
        }
    }
    if(  get_page_template_slug() === 'page-produk.php' ) {

        if ( $theme_file = locate_template( array( 'page-produk.php' ) ) ) {
            $template = $theme_file;
        } else {
            $template = plugin_dir_path( __FILE__ ) . 'templates/page-produk.php';
        }
    }

    // Archive
    if ( is_tax( 'categori' ) ) {
        if ( $theme_file = locate_template( array( 'taxonomy-categori.php' ) ) ) {
            $template = $theme_file;
        } else {
            $template = plugin_dir_path( __FILE__ ) . 'templates/taxonomy-categori.php';
        }
    }

    // Search
    global $wp_query;   
    $post_type = get_query_var('post_type');
    if( isset($_GET['s']) && $post_type == 'job' ) {

        if ( $theme_file = locate_template( array( 'archive-search.php' ) ) ) {
            $template = $theme_file;
        } else {
            $template = plugin_dir_path( __FILE__ ) . 'templates/archive-search.php';
        }
    }

    if($template == '') {
        throw new \Exception('No template found');
    }

    return $template;
}

add_filter( 'template_include', 'load_plugin_template' );
