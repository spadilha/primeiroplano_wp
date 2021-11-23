<?php
/*
Plugin Name: Advanced Taxonomy Terms Order
Plugin URI: https://www.nsp-code.com
Description: WordPress Taxonomies Terms Order. 
Version: 3.0
Author: Nsp Code
Author URI: https://www.nsp-code.com
Author Email: contact@nsp-code.com
*/


    define('ATTO_PATH',    plugin_dir_path(__FILE__));
    define('ATTO_URL',     str_replace(array('https:', 'http:'), "", plugins_url('', __FILE__)));

    define('ATTO_VERSION',              '3.0');
    define('ATTO_PRODUCT_ID',           'ATTO');
    define('ATTO_INSTANCE',             preg_replace('/:[0-9]+/', '', str_replace(array ("https://" , "http://"), "", trim(network_site_url(), '/'))));
    define('ATTO_UPDATE_API_URL',       'http://api.nsp-code.com/index.php');     

    //load language files
    add_action( 'plugins_loaded', 'atto_load_textdomain'); 
    function atto_load_textdomain() 
        {
            load_plugin_textdomain('atto', FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang');
        }
    
    include (ATTO_PATH . '/include/class.atto.functions.php'); 
    include (ATTO_PATH . '/include/class.atto.php');
    include (ATTO_PATH . '/include/class.atto.rest.php');
    include (ATTO_PATH . '/include/addons.php');
    
    include (ATTO_PATH . '/include/class.atto.licence.php');
    include (ATTO_PATH . '/include/class.atto.plugin-updater.php');
    
    register_deactivation_hook(__FILE__, 'ATTO_deactivated');
    register_activation_hook(__FILE__, 'ATTO_activated');

    function ATTO_activated($network_wide) 
        {
            global $wpdb;
                 
            // check if it is a network activation
            if ( $network_wide ) 
                {                   
                    // Get all blog ids
                    $blogids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
                    foreach ($blogids as $blog_id) 
                        {
                            switch_to_blog($blog_id);
                            ATTO_functions::plugin_activated_actions();
                            restore_current_blog();
                        }
                    
                    return;
                }
                else
                ATTO_functions::plugin_activated_actions();
        }
        
    
        
    add_action( 'wpmu_new_blog', 'ATTO_new_blog', 10, 6);       
    function ATTO_new_blog($blog_id, $user_id, $domain, $path, $site_id, $meta ) 
        {
            global $wpdb;
         
            if (is_plugin_active_for_network('advanced-taxonomy-terms-order/taxonomy-order.php')) 
                {
                    $current_blog = $wpdb->blogid;
                    
                    switch_to_blog($blog_id);
                    ATTO_functions::plugin_activated_actions();
                    
                    switch_to_blog($current_blog);
                }
        }
        
    function ATTO_deactivated() 
        {
            
        }
        
        
    add_filter('plugins_loaded', 'ATTO_plugins_loaded');
    function ATTO_plugins_loaded()
        {
            
            new ATTO();

        }

        
    add_action( 'wp_ajax_update-taxonomy-order', 'ATTO_SaveAjaxOrder' );
    function ATTO_SaveAjaxOrder()
        {
            global $wpdb; 
    
            //avoid using parse_Str due to the max_input_vars for large amount of data
            $_data = explode("&", $_POST['order']);   
            $_data  =   array_filter($_data);
            
            $data =   array();
            foreach ($_data as $_data_item)
                {
                    list($data_key, $value) = explode("=", $_data_item);
                    
                    $data_key = str_replace("item[", "", $data_key);
                    $data_key = str_replace("]", "", $data_key);
                    $data[$data_key] = trim($value);
                }
            

            $taxonomy   =   sanitize_key($_POST['taxonomy']);
            
            //retrieve the taxonomy details 
            $taxonomy_info = get_taxonomy($taxonomy);
            if($taxonomy_info->hierarchical === TRUE)    
                $is_hierarchical = TRUE;
                else
                $is_hierarchical = TRUE;
            
            //WPML fix
            if (defined('ICL_LANGUAGE_CODE'))
                {
                    global $iclTranslationManagement, $sitepress;
                    
                    remove_action('edit_term',  array($iclTranslationManagement, 'edit_term'),11, 2);
                    remove_action('edit_term',  array($sitepress, 'create_term'),1, 2);
                }
            
            if (is_array($data))
                {
                        
                    //prepare the var which will hold the item childs current order
                    $childs_current_order = array();
                    
                    foreach($data as $term_id => $parent_id ) 
                        {
                            
                            if($is_hierarchical === TRUE)
                                {
                                    //$current_item_term_order = '';
                                    if($parent_id != 'null')
                                        {
                                            $childs_current_order   =   array();
                                            $childs_current_order[$parent_id] = $current_item_term_order;
                                                
                                            $current_item_term_order    = $childs_current_order[$parent_id];
                                            $term_parent                = $parent_id;
                                        }
                                        else
                                            {
                                                                                
                                                $current_item_term_order    = isset($current_item_term_order) ? $current_item_term_order : 1;
                                                $term_parent                = 0;
                                            }
                                        
                                    //update the term_order
                                    $args = array(
                                                    'term_order'    =>  $current_item_term_order,
                                                    'parent'        =>  $term_parent
                                                    );
                                    //wp_update_term($term_id, $taxonomy, $args);
                                    //attempt a faster method
                                    
                                    //update the term_order as the above function can't do that !!
                                    $wpdb->update( $wpdb->terms, array('term_order' => $current_item_term_order), array('term_id' => $term_id) );
                                    $wpdb->update( $wpdb->term_taxonomy, array('parent'        =>  $term_parent), array('term_id' => $term_id) );
                                     
                                    do_action('atto_order_update_hierarchical', array('term_id' =>  $term_id, 'position' =>  $current_item_term_order, 'term_parent'    =>  $term_parent));
                                    
                                    $current_item_term_order++;
                                    
                                    continue;
                                }
                                
                            //update the non-hierarhical structure
                            $current_item_term_order = 1;
                                
                            //update the term_order
                            $args = array(
                                            'term_order'    =>  $current_item_term_order
                                            );
                            //wp_update_term($term_id, $taxonomy, $args);
                            //update the term_order as there code can't do that !! bug - hope they will fix soon! 
                            $wpdb->update( $wpdb->terms, array('term_order' => $current_item_term_order), array('term_id' => $term_id) );
                            
                            do_action('atto_order_update', array('term_id' =>  $term_id, 'position' =>  $current_item_term_order, 'term_parent'    =>  $term_parent));
                            
                            $current_item_term_order++;
        
                        }
        
                    //cache clear
                    clean_term_cache(array_keys( $data ), $taxonomy);
                    
                    do_action('atto/update-order');
                    do_action('atto/update-order-reorder-interface');
                }

            die();
        }
       
    
    //add support for drag & drop within default interface
    add_action( 'admin_enqueue_scripts', 'ATTO_admin_enqueue_scripts' );
    function ATTO_admin_enqueue_scripts(  $hook ) 
        {
            
            $options =   ATTO_functions::get_settings();
            if($options['default_interface_sort']   !=  '1')
                return;
            
            $screen =   get_current_screen();
            if(empty($screen->taxonomy))
                return;
            
            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-ui-sortable');
            wp_enqueue_script('atto-drag-drop', ATTO_URL . '/js/atto-drag-drop.js', array('jquery'), null, true);
            
            $vars = array(
                            'nonce'         =>  wp_create_nonce( 'taxonomy-default-interface-sort-update' ),
                            'taxonomy'      =>  $screen->taxonomy,
                            'paged'         =>  isset($_GET['paged'])   ?   intval($_GET['paged'])  :   '1'
                        );
            wp_localize_script( 'atto-drag-drop', 'ATTO_vars', $vars );
            
        }
    
    add_action('wp_ajax_update-taxonomy-order-default-list', 'ATTO_update_taxonomy_order_default_list');    
    function ATTO_update_taxonomy_order_default_list()
        {
            //check the nonce
            if ( ! wp_verify_nonce( $_POST['nonce'], 'taxonomy-default-interface-sort-update' ) ) 
                die();
            
            set_time_limit(600);
                
            global $wpdb, $userdata;

            parse_str($_POST['order'], $data);
            
            if (!is_array($data)    ||  count($data)    <   1)
                die();

            $curent_list_ids = array();
            reset($data);
            foreach (current($data) as $position => $term_id) 
                {
                    $curent_list_ids[] = $term_id;
                }

            $taxonomy   =   isset($_POST['taxonomy'])   ?   sanitize_key($_POST['taxonomy'])  :   '';
            if(empty($taxonomy))
                die();
                
            $objects_per_page   =   get_user_meta($userdata->ID, 'edit_'. $taxonomy .'_per_page', true);
            if(empty($objects_per_page))
                $objects_per_page   =   get_option('posts_per_page');

            $current_page   =   isset($_POST['paged'])  ?   intval($_POST['paged']) :   1;
            
            $insert_at_index  =   ($current_page -1 ) * $objects_per_page;
            
            $args   =   array(
                                'taxonomy'          =>  $taxonomy,
                                'hide_empty'        =>  false,
                                'orderby'           =>  'term_order',
                                'order'             =>  'ASC',
                                'fields'            =>  'ids'
                                );
                
            $existing_terms = get_terms( $args  );
            
            //exclude the items in the list  $curent_list_ids
            foreach ($curent_list_ids as $key => $term_id) 
                {
                    if(in_array($term_id, $existing_terms))
                        {
                            unset($existing_terms[ array_search($term_id, $existing_terms) ]);   
                        }
                }
            
            //reindex
            $existing_terms =   array_values($existing_terms);
            array_splice( $existing_terms, $insert_at_index, 0, $curent_list_ids );
            
            
            //save the sort indexes
            foreach ($existing_terms as $position => $term_id) 
                {
                    $wpdb->update(  
                                    $wpdb->terms, 
                                    array(
                                            'term_order' => $position), 
                                            array(
                                                    'term_id' => intval($term_id)
                                                    )
                                    );
                }
            
            do_action('atto/update-order');
            do_action('atto/update-order-default-interface');
            
            die();
            
        }
        
                
?>