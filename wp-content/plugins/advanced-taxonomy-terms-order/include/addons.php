<?php

    //Polylang remove post_translations taxonomy from the list
    add_action ('atto/interface/post_type_taxonomies', 'atto_interface_post_type_taxonomies');
    function atto_interface_post_type_taxonomies( $post_type_taxonomies )
        {
            
            //exclude post_translations taxonomy when Polylang is active
            if ( !in_array( 'polylang/polylang.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
                return $post_type_taxonomies;
            
            if ( is_array($post_type_taxonomies) && count( $post_type_taxonomies ) > 0  &&  array_search('post_translations', $post_type_taxonomies) !== FALSE)
                {
                    unset( $post_type_taxonomies[ array_search('post_translations', $post_type_taxonomies) ]);
                }
            
            
            return $post_type_taxonomies;
            
        }
        
        
    /**
    * Co-Authors Plus fix
    */
    add_action ('atto/get_terms_orderby/ignore', 'atto__get_terms_orderby__ignore', 10, 3);
    function atto__get_terms_orderby__ignore( $ignore, $orderby, $args )
        {
            if( !function_exists('is_plugin_active') )
                include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
            
            if( !   is_plugin_active( 'co-authors-plus/co-authors-plus.php' ))
                return $ignore;
            
            if ( ! isset($args['taxonomy']) ||  count($args['taxonomy']) !==    1 ||    array_search('author', $args['taxonomy'])   === FALSE )
                return $ignore;    
                
            return TRUE;
            
        }
    add_action ('atto/terms_clauses/ignore', 'atto__terms_clauses__ignore', 10, 4);
    function atto__terms_clauses__ignore( $ignore, $pieces, $taxonomies, $args )
        {
            if( !function_exists('is_plugin_active') )
                include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
            
            if( !   is_plugin_active( 'co-authors-plus/co-authors-plus.php' ))
                return $ignore;
            
            if ( ! isset($args['taxonomy']) ||  count($args['taxonomy']) !==    1 ||    array_search('author', $args['taxonomy'])   === FALSE )
                return $ignore;    
                
            return TRUE;
            
        }
    

?>