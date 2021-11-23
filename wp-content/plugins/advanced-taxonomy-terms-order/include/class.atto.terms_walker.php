<?php


    class ATTO_Terms_Walker extends Walker 
        {

            var $db_fields = array ('parent' => 'parent', 'id' => 'term_id');


            function start_lvl(&$output, $depth = 0, $args = array()) 
                {
                    extract($args, EXTR_SKIP);
                    
                    $indent = str_repeat("\t", $depth);
                    $output .= "\n$indent<ul class='children sortable'>\n";
                }


            function end_lvl(&$output, $depth = 0, $args = array()) 
                {
                    extract($args, EXTR_SKIP);
                        
                    $indent = str_repeat("\t", $depth);
                    $output .= "$indent</ul>\n";
                }


            function start_el(&$output, $term, $depth = 0, $args = array(), $current_object_id = 0) 
                {
                    if ( $depth )
                        $indent = str_repeat("\t", $depth);
                    else
                        $indent = '';

                    //extract($args, EXTR_SKIP);
                    $post_type = isset($_GET['post_type']) ? sanitize_key($_GET['post_type']) : 'post'; 
                    $taxonomy = get_taxonomy($term->term_taxonomy_id);
                    $output .= $indent . '<li class="tt_li" id="item_'.$term->term_id.'"><div class="item"><div class="options"><span class="edit"><a href="'. admin_url( 'edit-tags.php') .'?action=edit&taxonomy='. $term->taxonomy .'&tag_ID='.$term->term_id.'&post_type='. $post_type .'">Edit</a></span></div><span class="pnfo">'.apply_filters( 'term_name', $term->name, $term->term_id ).' ('.$term->term_id.')</span></div>';
                }


            function end_el(&$output, $post_type, $depth = 0, $args = array()) 
                {
                    $output .= "</li>\n";
                }

        }

?>