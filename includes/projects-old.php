<?php

// add_action('admin_menu', 'test_plugin_setup_menu');
 
// function test_plugin_setup_menu(){
//     add_menu_page( 
//         'ChaSon Form User Auth', 
//         'ChaSon Form', 
//         'manage_options', 
//         'chason-form', 
//         'my_plugin_options',
//         'dashicons-schedule', 
//         3 
//     );
// }

function projek_setting_form() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	// echo '<div class="wrap">';
    // echo '<h1>Welcome to my custom admin page.</h1>';
	// echo '<p>Here is where the form would go if I actually had options.</p>';
	// echo '</div>';
    ?> 
<style>
    #wpcontent {
        padding-left: 0 !important;
    }
    #csf-plugin-container {min-height: 100vh;}
    #csf-plugin-container a {
        text-decoration: none;
    }
    .csf-masthead {
        background-color: #fff;
        box-shadow: 0 1px 0 #c3c4c7, 0 1px 1px 1px rgb(0 0 0 / 4%);
        text-align: center;
    }
    .csf-masthead__inside-container {
        display: flex;
        flex-wrap: wrap;
        margin: 0 auto;
        max-width: 65rem;
        padding-bottom: 0.375rem;
        width: 100%;
    }
    .csf-masthead__logo-container {
        flex-grow: 0;
        flex-shrink: 0;
        padding: 0.6875rem 0 0;
    }
    .csf-masthead__logo-link {
        display: inline-block;
        outline: none;
        vertical-align: middle;
    }
    .csf-masthead__logo-link+code {
        background: #e6ecf1;
        border-radius: 2px;
        color: #647a88;
        margin: 0 10px;
        padding: 5px 9px;
    }
    .csf-lower {
        margin: 0 auto;
        max-width: 65rem;
        padding: 1.5rem;
        text-align: left;
    }
    .csf-footer {
        margin: 3.4em 0 2rem;
        text-align: center;
        font-size: 14px;
    }
    .csf-db-footer-bottom {
        display: flex;
        justify-content: center;
    }
    .csf-dashboard .csf-db-footer-thanks {
        font-size: 0.9em;
    }
    .csf-db-welcome-wrapper {
        display: flex;
        flex-flow: column;
    }
    .csf-db-card {
        margin-top: 1.7em;
        padding: 2.8em;
        font-size: inherit;
        background-color: #fff;
        border-radius: 12px;
        -webkit-box-shadow: 4px 30px 67px #0060f321;
        -moz-box-shadow: 4px 30px 67px #0060F321;
        -ms-box-shadow: 4px 30px 67px #0060F321;
        -o-box-shadow: 4px 30px 67px #0060F321;
        box-shadow: 4px 30px 67px #0060f321;
        /* box-shadow: 0 1px 2px rgb(0 0 0 / 6%), 0 1px 3px rgb(0 0 0 / 10%); */
    }
    .csf-db-welcome-setup {
        padding: 0;
    }
    .csf-db-welcome-container {
        flex: 1;
        padding: 2.8em;
        text-align: center;
        background-color: #fcfcfc;
    }
    .csf-db-setup {
        flex: 1;
        padding: 2.8em;
    }
    .csf-db-welcome-heading {
        margin: 0 0 0.5em 0;
        padding: 0;
        font-size: 38.4px;
        line-height: 49.92px;
        font-weight: 700;
        color: #32373c;
    }
    .csf-db-welcome-text {
        margin: 0 0 1em 0;
        margin-bottom: 1.4em;
        font-size: inherit;
        line-height: 1.7;
    }
    .csf-dashboard p {
        margin: 0 0 1em 0;
        font-size: inherit;
        line-height: 1.7;
    }
    .csf-dashboard .csf-db-welcome-setup {
        display: flex;
        overflow: hidden;
        position: relative;
    }
</style>
        <div id="csf-plugin-container" class="csf-dashboard">
            <div>
                <div class="csf-masthead">
                    <div class="csf-masthead__inside-container">
                        <div class="csf-masthead__logo-container">
                            <a href="" class="csf-masthead__logo-link">
                                ChaSon Form
                            </a>
                            <code>FREE Lifetime!</code>*Tapi beli dulu.
                        </div>
                    </div>
                </div>
                <div class="csf-lower">
                    <div class="csf-db-welcome-wrapper">
                        <section class="csf-db-card csf-db-welcome-setup">
                            <div class="csf-db-welcome-container">
                                <div class="csf-db-welcome-intro">
                                    <h1 class="csf-db-welcome-heading">
                                        <?php esc_html_e( 'Welcome to ChaSon!', 'my-plugin-textdomain' ); ?>
                                    </h1>
                                    <p class="csf-db-welcome-text">Here is where the form would go if I actually had options.</p>
                                </div>
                            </div>
                            <div class="csf-db-setup">
                                <p>Plugin Name: ChaSon Form User Auth</p>
                                <p>Description: Plugin for allowing users to register into your WordPress site via front-end forms. Completely free of admin panel.</p>
                                <p>Version: 1.0</p>
                                <p>Author: Muhammad Tison | Charles Simanjuntak</p>
                                <p>License: GPLv2</p>
                            </div>
                        </section>
                    </div>
                </div>
                <div class="csf-footer">
                    <div class="csf-db-footer-bottom">
                        <div class="csf-db-footer-thanks">
                            <strong>ChaSon Form version 1.0</strong>
                            <br>
                            Thank you for choosing ChaSon Form. We are honored and are fully dedicated to making your experience perfect.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    <?php
}

function ath_styles()
{
    wp_enqueue_style( 'plugin_css', plugin_dir_url( __FILE__ ) . 'style.css' );
}
add_action( 'wp_enqueue_scripts', 'ath_styles' );

// FUNGSI MENU PROJEK POST
// add_action('init',  "my_first_project_post");
add_action('init', 'my_first_project_post');
function my_first_project_post(){

    $labels = array(
        'name'               =>   _x('Projek Post', 'post type general name'),
        'singular_name'      =>   _x('Projek', 'post type singular name'),
        'menu_name'          =>   _x('Leson Form', 'admin menu'),
        'name_admin_bar'     =>   _x('Projek', 'add new on admin bar'),
        'add_new'            =>   _x('Add New', ''),
        'add_new_item'       =>   __('Add New Projek'),
        'edit_item'          =>   __('Edit Projek'),
        'new_item'           =>   __('New Projek'),
        'all_items'          =>   __('All Projek'),
        'view_item'          =>   __('View Projek'),
        'search_items'       =>   __('Search Projek'),
        'search_items'       =>   __('Search Projek'),
        'not_found'          =>   __('No Projek found'),
        'not_found_in_trash' =>   __('No Projek found in Trash'),
        'parent_item_colon'  =>   __('Parent Projek:'),                   

    );

    $args = array(
        'hierarchical'       =>  true,    
        'labels'             =>  $labels,
        'public'             =>  true,
        'publicly_queryable' =>  true, 
        'description'        => __('Description.'),
        'taxonomies'          => array( 'kategori' ),
        'show_ui'            =>  true,
        'show_in_menu'       =>  true,
        'show_in_nav_menus'  =>  true,                
        'query_var'          =>  true,
        'rewrite'            =>  true,
        'query_var'          =>  true,
        'rewrite'            =>  array('slug' => 'projek'),
        'capability_type'    =>  'post',
        'has_archive'        =>  true,
        'menu_position'      =>   20,
        "show_in_rest"       =>  true,
        'supports'           =>  array( 'title', 'editor', 'author', 'thumbnail', 'attachment' )
    );

    register_post_type('projek', $args);   

}
// function my_first_project_post()
// {
//     $args = array (
//         'labels' => array(
//             'name' => 'Projek',
//             'singular_name' => 'Projek',
//         ),
//         'hierarchical' => true,
//         'public' => true,
//         'has_archive' => true,
//         'menu_icon' => 'dashicons-images-alt2',
//         // 'supports' => array('title', 'thumbnail', 'attachment'),
//         'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'attachment'),
//         // 'supports' => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
//         // 'rewrite' => array('slug' => 'projek')
//         'tutorial_subpage_example_render_page'//$function
//     );

//     register_post_type('projek', $args);
// }


// FUNGSI MENU KATEGORI PROJEK POST
add_action('init', 'my_first_project_taxonomy', 0);
function my_first_project_taxonomy()
{
    $args = array (
        'labels' => array(
            'name' => 'Kategori',
            'singular_name' => 'Kategori',
        ),

        'public' => true,
        'hierarchical' => true,

        'exclude_from_search'   => true,
        'has_archive'           => true,
        'rewrite'               => array( 'slug' => 'kategori' ),
        'show_ui'               => true,
        'query_var'             => true,
    );

    register_taxonomy('kategori', array('projek'), $args);
}
// 'kategori' is the registered post type name
// function directory_columns($defaults) {
//     // 'kategori' is the registered taxonomy name
//     $defaults['kategori'] = 'Product Category';
//     return $defaults;
// }
// function directory_custom_column($column_name, $post_id) {
//     $taxonomy = $column_name;
//     $post_type = get_post_type($post_id);
//     $terms = get_the_terms($post_id, $taxonomy);

//     if ( !empty($terms) ) {
//         foreach ( $terms as $term )
//             $post_terms[] = "<a href='edit.php?post_type={$post_type}&{$taxonomy}={$term->slug}'> " . esc_html(sanitize_term_field('name', $term->name, $term->term_id, $taxonomy, 'edit')) . "</a>";
//         echo join( ', ', $post_terms );
//     }
//     else echo '<i>Not assigned.</i>';
// }
// add_filter( 'manage_project_posts_columns', 'directory_columns' );
// add_action( 'manage_project_posts_custom_column', 'directory_custom_column', 10, 2 );

add_action('admin_menu', 'my_first_project_setting');
function my_first_project_setting(){

     add_submenu_page(
        'edit.php?post_type=projek', //$parent_slug
        'Leson Settings',  //$page_title
        'Leson Settings',        //$menu_title
        'manage_options',           //$capability
        'projek_setting_form',//$menu_slug
        'projek_setting_form'//$function
     );

}

//add_submenu_page callback function

// function projek_setting_form() {

//     echo '<h2> Projek Settings </h2>';

// }
// FUNGSI TEMPLATE LAYOUT PROJEK POST
function load_projek_template( $template ) {
    global $post;

    if ( 'projek' === $post->post_type && locate_template( array( 'fd-projek.php' ) ) !== $template ) {
        /*
         * This is a 'projek' post
         * AND a 'single projek template' is not found on
         * theme or child theme directories, so load it
         * from our plugin directory.
         */
        return plugin_dir_path( __FILE__ ) . 'fd-projek.php';
    }

    return $template;
}

add_filter( 'single_template', 'load_projek_template' );

// FUNGSI META BOX PROJEK POST
// add_meta_box( $id, $title, $callback, $screen, $context, $priority, $callback_args);
/**
 * Register meta boxes.
 */
function cobain_register_meta_boxes() {
    add_meta_box( 
        'hcf-1', __( 'Projek Content', 'hcf' ), // meta box title
        'hcf_display_callback', // callback function that prints the meta box HTML
        'projek', // post type where to add it
        'normal', // priority
        'high'
    );
}
add_action( 'add_meta_boxes', 'cobain_register_meta_boxes' );

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function hcf_display_callback( $post ) {
    // echo "Cobain Custom Field";
    include plugin_dir_path( __FILE__ ) . './form.php';
}
?>
