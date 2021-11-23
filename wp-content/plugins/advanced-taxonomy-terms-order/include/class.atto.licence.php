<?php   
    
    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
    
    /**
    * V2.2       
    */
    class ATTO_licence
        {
         
            function __construct()
                {
                    $last_checked = (int)get_site_option( 'atto_last_checked' );
                    if( time() < ( $last_checked + ( ( 86400 * 2 )  + rand ( 1, 43200) ) ))
                        {
                            return;
                        }
                    
                    update_site_option( 'atto_last_checked', time() );
                    
                    $this->licence_deactivation_check();   
                }
                
                
            /**
            * Retrieve licence details
            * 
            */
            public function get_licence_data()
                {
                    $licence_data = get_site_option('atto_licence');
                    
                    $default =   array(
                                            'key'               =>  '',
                                            'last_check'        =>  '',
                                            'licence_status'    =>  '',
                                            'licence_expire'    =>  ''
                                            );    
                    $licence_data           =   wp_parse_args( $licence_data, $default );
                    
                    return $licence_data;
                }
                
                
            /**
            * Reset license data
            *     
            * @param mixed $licence_data
            */
            public function reset_licence_data( $licence_data )
                {
                    if  ( ! is_array( $licence_data ) ) 
                        $licence_data   =   array();
                        
                    $licence_data['key']                =   '';
                    $licence_data['last_check']         =   time();
                    $licence_data['licence_status']     =   '';
                    $licence_data['licence_expire']     =   '';
                    
                    return $licence_data;
                }
                
                
            /**
            * Set licence data
            *     
            * @param mixed $licence_data
            */
            public function update_licence_data( $licence_data )
                {
                    update_site_option('atto_licence', $licence_data);   
                }
                
                
            public function licence_key_verify()
                {
                    
                    if( $this->is_local_instance() )
                        return TRUE;
                        
                    $licence_data = $this->get_licence_data();
                             
                    if( ! isset ( $licence_data['key'] ) || $licence_data['key'] == '' )
                        return FALSE;
                        
                    return TRUE;
                }
                
            function is_local_instance()
                {
                    return false;
                    
                    if( defined('ATTO_REQUIRE_KEY') &&  ATTO_REQUIRE_KEY    === TRUE    )
                        return FALSE;
                                            
                    $instance   =   trailingslashit(ATTO_INSTANCE);
                    if(
                            stripos($instance, base64_decode('bG9jYWxob3N0Lw==')) !== FALSE
                        ||  stripos($instance, base64_decode('MTI3LjAuMC4xLw==')) !== FALSE
                        ||  stripos($instance, base64_decode('LmRldg==')) !== FALSE
                        ||  stripos($instance, base64_decode('c3RhZ2luZy53cGVuZ2luZS5jb20=')) !== FALSE
                        )
                        {
                            return TRUE;   
                        }
                        
                    return FALSE;
                    
                }
                
                
            function licence_deactivation_check()
                {

                    if( ! $this->licence_key_verify() ||  $this->is_local_instance()  === TRUE)
                        return;
                    
                    if ( !  $this->create_lock( 'ATTO__API_status-check', 50 ) )
                        return;
                        
                    if ( empty ( get_site_option( 'atto_last_checked' ) ) )
                        return;
                                            
                    $licence_data  = $this->get_licence_data();
                    $licence_key   = $licence_data['key'];
                    
                    if ( empty ( $licence_key ) )
                        {
                            $licence_data['last_check']   = time();
                            $this->update_licence_data( $licence_data );
                            $this->release_lock( 'ATTO__API_status-check' );
                            return;
                        }
                    
                    global $wp_version;
                                        
                    $args = array(
                                                'woo_sl_action'         => 'status-check',
                                                'licence_key'           => $licence_key,
                                                'product_unique_id'     => ATTO_PRODUCT_ID,
                                                'domain'                => ATTO_INSTANCE
                                            );
                    $request_uri    = ATTO_UPDATE_API_URL . '?' . http_build_query( $args , '', '&');
                    $data           = wp_remote_get( $request_uri,  array(
                                                                            'timeout'     => 5,
                                                                            'user-agent'  => 'WordPress/' . $wp_version . '; ATTO/' . ATTO_VERSION .'; ' . get_bloginfo( 'url' ),
                                                                            ) );
                    
                    if(is_wp_error( $data ) || $data['response']['code'] != 200)
                        {
                            $licence_data['last_check']   = time();    
                            $this->update_licence_data( $licence_data );
                            $this->release_lock( 'ATTO__API_status-check' );
                            return;
                        }
                    
                    $response_block = json_decode($data['body']);
                    
                    if(!is_array($response_block) || count($response_block) < 1)
                        {
                            $licence_data['last_check']   = time();    
                            $this->update_licence_data( $licence_data );
                            $this->release_lock( 'ATTO__API_status-check' );
                            return;
                        }
                        
                    $response_block = $response_block[count($response_block) - 1];
                    if (is_object($response_block))
                        {                            
                            if ( in_array ( $response_block->status_code, array ( 'e312', 's203', 'e204', 'e002', 'e003' ) ) )
                                {
                                    $licence_data   =   $this->reset_licence_data( $licence_data );
                                }
                                else
                                {
                                    $licence_data['licence_status']         = isset( $response_block->licence_status ) ?    $response_block->licence_status :   ''  ;
                                    $licence_data['licence_expire']         = isset( $response_block->licence_expire ) ?    $response_block->licence_expire :   ''  ;   
                                    $licence_data['_sl_new_version']        = isset( $response_block->_sl_new_version ) ?   $response_block->_sl_new_version :   ''  ;
                                    $licence_data['network_message']        = isset( $response_block->network_message ) ?   $response_block->network_message :   ''  ;   
                                }
                                
                            if($response_block->status == 'error')
                                {
                                    $licence_data   =   $this->reset_licence_data( $licence_data );
                                } 
                        }
                    
                    $licence_data['last_check']   = time();    
                    $this->update_licence_data( $licence_data );
                    $this->release_lock( 'ATTO__API_status-check' );
                }
            
            
                
            /**
            * Create a Lock functionality using the MySql 
            * 
            * @param mixed $lock_name
            * @param mixed $release_timeout
            * 
            * @return bool False if a lock couldn't be created or if the lock is still valid. True otherwise.
            */
            function create_lock( $lock_name, $release_timeout = null ) 
                {
                
                    global $wpdb, $blog_id;
                    
                    if ( ! $release_timeout ) {
                        $release_timeout = 10;
                    }
                    $lock_option = $lock_name . '.lock';
                    
                    if (    is_multisite()  )
                        {
                            // Try to lock.
                            $lock_result = $wpdb->query( $wpdb->prepare( "INSERT INTO `". $wpdb->sitemeta ."` (`site_id`, `meta_key`, `meta_value`) 
                                                                            SELECT %s, %s, %s FROM DUAL
                                                                            WHERE NOT EXISTS (SELECT * FROM `". $wpdb->sitemeta ."` 
                                                                                  WHERE `meta_key` = %s AND `meta_value` != '') 
                                                                            LIMIT 1", $blog_id, $lock_option, time(), $lock_option) );
                        }
                        else
                        {
                            // Try to lock.
                            $lock_result = $wpdb->query( $wpdb->prepare( "INSERT IGNORE INTO `". $wpdb->options ."` (`option_name`, `option_value`, `autoload`) 
                                                                            VALUES (%s, %s, 'no') /* LOCK */", $lock_option, time() ));   
                        }
                    
                                        
                    if ( ! $lock_result ) 
                        {
                            $lock_result    =   $this->get_lock( $lock_option );

                            // If a lock couldn't be created, and there isn't a lock, bail.
                            if ( ! $lock_result ) {
                                return false;
                            }

                            // Check to see if the lock is still valid. If it is, bail.
                            if ( $lock_result > ( time() - $release_timeout ) ) {
                                return false;
                            }

                            // There must exist an expired lock, clear it and re-gain it.
                            $this->release_lock( $lock_name );

                            return $this->create_lock( $lock_name, $release_timeout );
                        }

                    // Update the lock, as by this point we've definitely got a lock, just need to fire the actions.
                    $this->update_lock( $lock_option, time() );

                    return true;
                
                }


            /**
            * Retrieve a lock value
            * 
            * @param mixed $lock_name
            * @param mixed $return_full_row
            */
            private function get_lock( $lock_name, $return_full_row =   FALSE )
                {
                
                    global $wpdb;
                    
                    if (    is_multisite()  )
                        {
                            $mysq_query =   $wpdb->get_row( $wpdb->prepare("SELECT `site_id`, `meta_key`, `meta_value` FROM  `". $wpdb->sitemeta ."`
                                                                            WHERE `meta_key`    =   %s", $lock_name ) );

                            if ( $return_full_row   === TRUE )
                                return $mysq_query;
                                
                            if ( is_object($mysq_query) && isset ( $mysq_query->meta_value ) )
                                return $mysq_query->meta_value;
                        }
                        else
                        {
                            $mysq_query =   $wpdb->get_row( $wpdb->prepare("SELECT `option_name`, `option_value` FROM  `". $wpdb->options ."`
                                                                            WHERE `option_name`    =   %s", $lock_name ) );

                            if ( $return_full_row   === TRUE )
                                return $mysq_query;
                                
                            if ( is_object($mysq_query) && isset ( $mysq_query->option_value ) )
                                return $mysq_query->option_value;   
                            
                        }
                        
                    return FALSE;
                
                }


            /**
            * Update lock value
            *     
            * @param mixed $lock_name
            * @param mixed $lock_value
            */
            private function update_lock( $lock_name, $lock_value )
                {
                
                    global $wpdb;
                    
                    if (    is_multisite()  )
                        {
                            $mysq_query =   $wpdb->query( $wpdb->prepare("UPDATE `". $wpdb->sitemeta ."` 
                                                                            SET meta_value = %s
                                                                            WHERE meta_key = %s", $lock_value, $lock_name) );
                        }
                        else
                        {
                            $mysq_query =   $wpdb->query( $wpdb->prepare("UPDATE `". $wpdb->options ."` 
                                                                            SET option_value = %s
                                                                            WHERE option_name = %s", $lock_value, $lock_name) );
                        }
                    
                    
                    return $mysq_query;
                    
                }


            /**
            * Releases an upgrader lock.
            *
            * @param string $lock_name The name of this unique lock.
            * @return bool True if the lock was successfully released. False on failure.
            */
            function release_lock( $lock_name ) 
                {
                
                    global $wpdb;
                    
                    $lock_option = $lock_name . '.lock';
                    
                    if (    is_multisite()  )
                        {
                            $mysq_query =   $wpdb->query( $wpdb->prepare( "DELETE FROM `". $wpdb->sitemeta ."` 
                                                                            WHERE meta_key = %s", $lock_option ) );
                        }
                        else
                        {
                            $mysq_query =   $wpdb->query( $wpdb->prepare( "DELETE FROM `". $wpdb->options ."` 
                                                                            WHERE option_name = %s", $lock_option ) );
                        }
                    
                    return $mysq_query;
                    
                }
            
        }
            

        
    
?>