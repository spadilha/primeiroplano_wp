<?php
/*
Author: Saulo Padilha
URL: htp://spadilha.com
*/

/************* DEFINE URLS *********************/
$themefolder = get_template_directory_uri();
$homeurl = get_home_url();
define('ROOTPATH', dirname(__FILE__));
define('THEMEPATH', $themefolder);
define('SITEHOME', $homeurl);


/************* OPTIONS PAGE *********************/
if( function_exists('acf_add_options_page') )
{
    $page = acf_add_options_page(array(
        'page_title'    => 'Opções do Tema',
        'menu_title'    => 'Opções do Tema',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'manage_options',
        'position'      => 2,
        'icon_url'      => 'dashicons-welcome-widgets-menus'
    ));
}


/************* THUMBNAIL SIZE OPTIONS *********************/
add_image_size( 'square', 356, 356, true);


/************* CALL CORE FUNCTIONS *********************/
require_once('functions/core.php');

/************* SHORTCODES ******************/
require_once('functions/shortcodes.php');

/************* EDITOR STYLES AND BUTONS ******************/
require( 'functions/editor-buttons/editor.php' );
function spa_add_editor_styles() {
    add_editor_style( 'css/editor-style.css' );
}
add_action( 'admin_init', 'spa_add_editor_styles' );


/************* SANITIZE FILE NAME *********************/
require_once('functions/sanitize.php');



/************* MUDA POST PARA NOTÍCIAS  *********************/

function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Notícias';
    $submenu['edit.php'][5][0] = 'Todas Notícias';
    $submenu['edit.php'][10][0] = 'Adicionar Notícia';
    echo '';
}
function change_post_object_label() {
        global $wp_post_types;
        $labels = &$wp_post_types['post']->labels;
        $labels->name = 'Notícias';
        $labels->singular_name = 'Notícia';
        $labels->add_new = 'Adicionar Notícia';
        $labels->add_new_item = 'Adicionar Notícia';
        $labels->edit_item = 'Editar Notícia';
        $labels->new_item = 'Notícia';
        $labels->view_item = 'Ver Notícia';
        $labels->search_items = 'Procurar Notícias';
        $labels->not_found = 'Nenhuma Notícia encontrada';
        $labels->not_found_in_trash = 'Nenhuma Notícia encontrada na lixeira';
}
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );


/************* MUDA ÍCONE DE POSTS/NOTÍCIAS *********************/
function ccd_menu_news_icon() {
  global $menu;
  foreach ( $menu as $key => $val ) {
    if ( __( 'News') == $val[0] ) {
      $menu[$key][6] = 'dashicons-welcome-write-blog';
    }
  }
}
add_action( 'admin_menu', 'ccd_menu_news_icon' );



/************* CUSTOM EXCERPT *************/
function spa_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'spa_custom_excerpt_length', 999 );
function new_excerpt_more( $more ) {
    return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');



/************* WRAP EMBEDS *********************/
add_filter('embed_oembed_html', 'my_embed_oembed_html', 99, 4);
function my_embed_oembed_html($html, $url, $attr, $post_id) {
  return '<div class="embed-wrap fitvidz">' . $html . '</div>';
}


/*  Stop TinyMCE removing tags (span, etc) from editor */
function override_mce_options($initArray) {
    $opts = '*[*]';
    $initArray['valid_elements'] = $opts;
    $initArray['extended_valid_elements'] = $opts;
    return $initArray;
}
add_filter('tiny_mce_before_init', 'override_mce_options');


// add_action( 'admin_enqueue_scripts', 'load_admin_style' );
function load_admin_style() {
    wp_enqueue_style( 'admin_css', THEMEPATH . '/css/admin-style.css', false, '1.0.0' );
}


/************* ADVANCED CF7 DB CONFIG ******************/
add_filter("vsz_display_character_count","vsz_display_character_count_callback",10,1);
function vsz_display_character_count_callback($count){
    return 4000;
}

add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo "<style>
    .vsz-cf7-listing table.fixed {table-layout:auto;}
    .vsz-cf7-listing .widefat {width: 100%;}
    .bulk-actions select, .select-form select {background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2220%22%20height%3D%2220%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Cpath%20d%3D%22M5%206l5%205%205-5%202%201-7%207-7-7%202-1z%22%20fill%3D%22%23555%22%2F%3E%3C%2Fsvg%3E') !important;}
  </style>";
}



// AJUSTA REWRITE RULES PARA INCLUIR EDIÇÃO NOS POSTS E PAGES
// add_filter('post_link', 'spa_post_link', 10, 3);
// add_filter('post_type_link', 'spa_post_link', 10, 3);
// function spa_post_link( $permalink, $post ) {

//     $terms = wp_get_post_terms( $post->ID, 'edicao' );
//     if ( ! empty( $terms ) && ! is_wp_error( $terms ) )
//         $term = current( $terms )->slug;
//     else
//         $term = 'geral';

//     $permalink = str_replace( '%edicao%', $term, $permalink );

//     return $permalink;
// }

// add_filter('page_link', 'spa_page_link', 10, 3);
// function spa_page_link( $permalink, $post ) {

//     return $permalink;
// }

// // add_filter('rewrite_rules_array','remove_bare_folder_rule');
// // function remove_bare_folder_rule( $rules ){
// //    unset($rules['([^/]+)/?$']);
// //    return $rules;
// // }



// add_action( 'init', 'custom_rewrite_rules', 1, 0 );
// function custom_rewrite_rules(){
//     global $wp_rewrite;

//     $wp_rewrite->extra_permastructs['page']['struct'] = '/%pagename%';
//     $wp_rewrite->extra_permastructs['page']['with_front'] = 1;
//     $wp_rewrite->extra_permastructs['page']['ep_mask'] = 0;
//     $wp_rewrite->extra_permastructs['page']['paged'] = 1;
//     $wp_rewrite->extra_permastructs['page']['feed'] = 1;
//     $wp_rewrite->extra_permastructs['page']['forcomments'] = 0;
//     $wp_rewrite->extra_permastructs['page']['walk_dirs'] = 1;
//     $wp_rewrite->extra_permastructs['page']['endpoints'] = 1;

//     // print_r($wp_rewrite);
// }





?>