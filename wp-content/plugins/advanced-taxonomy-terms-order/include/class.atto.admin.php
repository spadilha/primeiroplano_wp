<?php
    
    if ( ! defined( 'ABSPATH' ) ) { exit;}
    
    class ATTO_admin 
        {
            var $functions;
            var $licence;
            
            var $interface;
            var $options_interface;
            
            /**
            * 
            * Run on class construct
            * 
            */
            function __construct( ) 
                {
                    include (ATTO_PATH . '/include/class.atto.interface.php');
                    include (ATTO_PATH . '/include/class.atto.terms_walker.php');
                    include (ATTO_PATH . '/include/class.atto.options.php');
                    
                    $this->functions            =   new ATTO_functions();
                    
                    $this->licence              =   new ATTO_licence();
                    
                    $this->options_interface    =   new ATTO_options_interface();
                    $this->interface            =   new ATTO_interface();
                    
                    $this->_init();
                    
                     
                }
            
                
            function _init()
                {
                    add_action('admin_menu',        array( $this,       '_plugin_menus'), 99    );
                    add_action('admin_notices' ,    array( $this,       'admin_notices'));
                    
                    add_action('admin_notices',     array($this,        'admin_no_key_notices'));
                }
                
                
            function _plugin_menus()
                {
                    
                    add_action('admin_print_styles' , array ($this, 'admin_print_general_styles')); 
                     
                    $hookID =   add_options_page('Taxonomy Terms Order', '<img class="menu_tto" src="'. ATTO_URL .'/images/menu-icon.png" alt="" />Taxonomy Terms Order', 'manage_options', 'to-options', array( $this->options_interface, 'options_interface') );
                    
                    add_action('admin_print_styles-' . $hookID , array($this->options_interface,  'admin_styles' ) );
                    
                    
                    if( $this->licence->licence_key_verify()  === FALSE )
                        return;
                                                
                    $options = $this->functions->get_settings();
                    
                    if(isset($options['capability']) && !empty($options['capability']))
                            {
                                $capability = $options['capability'];
                            }
                        else if (is_numeric($options['level']))
                            {
                                //maintain the old user level compatibility
                                $capability = $this->functions->userdata_get_user_level();
                            }
                            else
                                {
                                    $capability = 'manage_options';  
                                }
                    
                    //put a menu within all custom types if apply
                    $post_types = get_post_types();
                    foreach( $post_types as $post_type) 
                        {
                                
                            //check if there are any taxonomy for this post type
                            $post_type_taxonomies = get_object_taxonomies($post_type);
                                  
                            if (count($post_type_taxonomies) == 0)
                                continue;                
                            
                            $menu_title =   apply_filters('atto/admin/menu_title', __('Taxonomy Order', 'atto'), $post_type);
                            
                            if ($post_type == 'post')
                                $hookID =   add_submenu_page('edit.php', $menu_title, $menu_title, $capability, 'to-interface-'.$post_type, array($this->interface, 'admin_interface') );
                                elseif ($post_type == 'attachment')
                                $hookID =   add_submenu_page('upload.php', $menu_title, $menu_title, $capability, 'to-interface-'.$post_type, array($this->interface, 'admin_interface') );
                                elseif($post_type == 'shopp_product'   &&  is_plugin_active('shopp/Shopp.php'))
                                    {
                                        $hookID =   add_submenu_page('shopp-products', $menu_title, $menu_title, $capability, 'to-interface-'.$post_type, array($this->interface, 'admin_interface') );
                                    }
                                else
                                $hookID =   add_submenu_page('edit.php?post_type='.$post_type, $menu_title, $menu_title, $capability, 'to-interface-'.$post_type, array($this->interface, 'admin_interface') );
                                
                            add_action('admin_print_styles-' . $hookID , array($this->interface,  'admin_styles' ) );
                            add_action('admin_print_scripts-' . $hookID , array($this->interface, 'admin_scripts' ) );
                        }   
                    
                }
                
                
            function admin_print_general_styles()
                {
                    wp_register_style('ATTO_GeneralStyleSheet', ATTO_URL . '/css/general.css');
                    wp_enqueue_style( 'ATTO_GeneralStyleSheet');    
                }    
                
                
                
            function admin_no_key_notices()
                {
                    
                    if( $this->licence->licence_key_verify()  === TRUE )
                        return;
                    
                    if ( !current_user_can('manage_options'))
                        return;
                    
                    $screen = get_current_screen();
                        
                    if(is_multisite()   &&  is_network_admin())
                        {

                        }
                        else
                        {
                               
                            ?><div class="error fade"><p><?php _e( "Advanced Taxonomy Terms Order plugin is inactive, please enter your", 'atto' ) ?> <a href="options-general.php?page=to-options"><?php _e( "Licence Key", 'atto' ) ?></a></p></div><?php
                        }
                }    
                
                
            function admin_notices()
                {
                    global $atto_interface_messages;
            
                    if(!is_array($atto_interface_messages))
                        return;
                              
                    if(count($atto_interface_messages) > 0)
                        {
                            foreach ($atto_interface_messages  as  $message)
                                {
                                    echo "<div class='". $message['type'] ." fade'><p>". $message['text']  ."</p></div>";
                                }
                        }

                }    
                
                
        
            
        } 
    
    
    
?>