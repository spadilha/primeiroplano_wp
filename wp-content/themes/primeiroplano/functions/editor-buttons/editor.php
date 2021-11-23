<?php

/* CUSTOM TinyMCE OPTIONS */
add_filter('tiny_mce_before_init', 'myformatTinyMCE' );
function myformatTinyMCE($settings) {

    /*  Stop TinyMCE removing tags (span, etc) from editor */
    $settings['valid_elements'] = '*[*]';
    $settings['extended_valid_elements'] = '*[*]';
    $settings['verify_html'] = false;
    $settings['block_formats'] = 'Paragraph=p;Heading 1=h1;Heading 2=h2;Heading 3=h3;Heading 4=h4;Heading 5=h5;';

    $custom_colours = '
        "E7521C", "Laranja",
        "ef89a9", "Rosa",
        "26aa67", "Verde",
        "fdce16", "Amarelo",
    ';

    // build colour grid default+custom colors
    $settings['textcolor_map'] = '['.$custom_colours.']';
    $init['textcolor_cols'] = 5;
    $settings['textcolor_rows'] = 3;


    $style_formats = array(
        array(
            'title'   => 'Page Title',
            'block'   => 'h1',
            'classes' => 'page-title',
            'wrapper' => false,
        ),
        array(
            'title'   => 'Semi-bold',
            'inline'   => 'span',
            'styles' => array(
                'font-weight' => '600'
            ),
            'wrapper' => true,
        ),
    );
    $settings['style_formats'] = json_encode( $style_formats );

    $settings['toolbar1'] = 'bold, italic, underline, strikethrough, bullist, numlist, blockquote, alignjustify, alignleft, aligncenter, alignright, link, unlink, undo, redo, wp_adv, fullscreen';

    $settings['toolbar2'] = 'formatselect, styleselect, forecolor, pastetext, removeformat, outdent, indent, table, quebraLinha, boxMenorAzul';

    // $settings['style_formats'] = array(
    //     array(
    //       'title'=> 'Image Left',
    //       'selector'=> 'img',
    //       'styles'=> array(
    //         'float'=> 'left',
    //         'margin'=> '0 10px 0 10px'
    //       )
    //     ),
    //     array(
    //       'title'=> 'Image Right',
    //       'selector'=> 'img',
    //       'styles'=> array(
    //         'float'=> 'right',
    //         'margin'=> '0 0 10px 10px'
    //         )
    //     )
    // );
    return $settings;
}

// CUSTOM TinyMCE FOR ADVANCED CUSTOM FIELDS
add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );
function my_toolbars( $toolbars ){

    // Edit the "Full" toolbar
    $toolbars['Full' ][1] = array('bold', 'italic', 'underline', 'strikethrough', 'bullist', 'numlist', 'blockquote', 'alignjustify', 'alignleft', 'aligncenter', 'alignright', 'link', 'unlink', 'undo', 'redo', 'wp_adv', 'fullscreen' );

    $toolbars['Full' ][2] = array('formatselect', 'styleselect', 'forecolor', 'pastetext', 'removeformat', 'outdent', 'indent', 'table', 'quebraLinha', 'boxMenorAzul' );

    return $toolbars;
}



/* ADD BUTTONS */
add_action( 'init', 'spa_buttons' );
function spa_buttons() {
    add_filter( "mce_external_plugins", "spa_add_buttons" );
    add_filter( 'mce_buttons', 'spa_register_buttons' );
}
function spa_add_buttons( $plugin_array ) {
    $plugin_array['spa'] = get_template_directory_uri() . '/functions/editor-buttons/plugin.js';
    return $plugin_array;
}
function spa_register_buttons( $buttons ) {

    array_push( $buttons,'quebraLinha' );
    array_push( $buttons,'boxMenorAzul' );

    return $buttons;
}


/* ADD CSS TO ADMIN */
add_action('admin_head', 'admin_css');
function admin_css() {
   echo '<style type="text/css">

            .mce-btn i {font-family: dashicons; font-size: 20px; font-weight:400;}

            .mce-quebraLinha i:before {content:"\f460"; color:#686648;}
            .mce-boxMenorAzul i:before {content:"\f125"; color:#6497ae;}


            .acf-gallery {height: 500px !important;}

            .acf-repeater .acf-row:nth-child(even) .order, .acf-repeater .acf-row:nth-child(even) .remove {background: #e1e1e1; color:#333;}


         </style>';
}


?>