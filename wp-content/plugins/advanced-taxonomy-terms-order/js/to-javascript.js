
    
    var ATTO = {
    
        change_taxonomy: function(element)
            {
                jQuery('#to_form').submit();
            },
            
        interface_reverse_order :   function()
                {
                    //keep the height to prevent browser scroll
                    jQuery("#sortable").css('min-height', 'inherit');
                    jQuery("#sortable").css('min-height', jQuery("#sortable").height() + 'px');
                    
                    jQuery("#sortable").append(jQuery('#sortable > li').hide().get().reverse());
                    jQuery('#sortable > li').slideDown(100);
                },
                
            interface_title_order :   function( order_type )
                {
                    //keep the height to prevent browser scroll
                    jQuery("#sortable").css('min-height', 'inherit');
                    jQuery("#sortable").css('min-height', jQuery("#sortable").height() + 'px');
                    
                    ATTO._sortabl_level_sort( '#sortable', '#sortable > li', order_type);
                },
                
            _sortabl_level_sort : function ( $sortable_list, $sortable_li, order_type )
                {
                    var $sortable_list = jQuery( $sortable_list ),
                        $sortable_li = jQuery( $sortable_li );
                        
                    jQuery.each ( $sortable_li, function ( index, value ) {
                        var child_elements = jQuery( value).find(' > ul > li');
                        if ( child_elements.length > 0 )
                            ATTO._sortabl_level_sort( jQuery( value).find(' > ul'), jQuery( value).find(' > ul > li'), order_type);
                    })
                         
                    $sortable_li.sort(function(a,b){
                        var an = jQuery(a).find('.pnfo').html().toLowerCase(),
                            bn = jQuery(b).find('.pnfo').html().toLowerCase();
                        
                        if(order_type == 'ASC')
                            {
                                if(an > bn) 
                                    {
                                        return 1;
                                    }
                                if(an < bn) 
                                    {
                                        return -1;
                                    }
                            }
                            
                        if(order_type == 'DESC')
                            {
                                if(an < bn) 
                                    {
                                        return 1;
                                    }
                                if(an > bn) 
                                    {
                                        return -1;
                                    }
                            }
                        
                        return 0;
                    });

                    $sortable_li.detach().hide().appendTo($sortable_list).slideDown(100);                        
                },
                
            interface_id_order :   function(order_type)
                {
                    //keep the height to prevent browser scroll
                    jQuery("#sortable").css('min-height', 'inherit');
                    jQuery("#sortable").css('min-height', jQuery("#sortable").height() + 'px');
                            
                    var $sortable_list = jQuery('#sortable'),
                        $sortable_li = jQuery('#sortable > li');

                    $sortable_li.sort(function(a,b){
                        var an = parseInt ( jQuery(a).attr('id').toLowerCase().replace("item_", "") ),
                            bn = parseInt ( jQuery(b).attr('id').toLowerCase().replace("item_", "") );

                        if(order_type == 'ASC')
                            {
                                if(an > bn) 
                                    {
                                        return 1;
                                    }
                                if(an < bn) 
                                    {
                                        return -1;
                                    }
                            }
                            
                        if(order_type == 'DESC')
                            {
                                if(an < bn) 
                                    {
                                        return 1;
                                    }
                                if(an > bn) 
                                    {
                                        return -1;
                                    }
                            }
                        
                        return 0;
                    });

                    $sortable_li.detach().hide().appendTo($sortable_list).slideDown(100);
                }
        
    }