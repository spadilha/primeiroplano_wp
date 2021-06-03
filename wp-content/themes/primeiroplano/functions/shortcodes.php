<?php

add_shortcode('topic', 'spa_topic');
function spa_topic($atts, $content = null) {
    extract(
        shortcode_atts(array(
                "titulo" => '',
        ),
        $atts
    ));

    $content = spa_content_helper($content);

    $titulo = ($titulo <> '') ? esc_attr($titulo) : '';

    $output = "<dl><dt>{$titulo}</dt><dd>";
    $output .= do_shortcode($content);
    $output .= "</dd></dl>";

    return $output;
}


add_shortcode('row', 'spa_row');
function spa_row($atts, $content = null) {

    $output = "<div class='row'>";
    $output .= do_shortcode($content);
    $output .= "</div>";

    return $output;
}



add_shortcode('col', 'spa_col');
function spa_col($atts, $content = null) {
    extract(shortcode_atts(array(
                "type" => 'shadow',
                "id" => '',
                "class" => ''
            ), $atts));

    $id = ($id <> '') ? " id='" . esc_attr( $id ) . "'" : '';
    $class = ($class <> '') ? esc_attr( ' ' . $class ) : '';

    $output = "<div{$id} class='col{$class}'>";
    $output .= do_shortcode($content);
    $output .= "</div>";

    return $output;
}


add_shortcode('boxazul', 'spa_box');
function spa_box($atts, $content = null) {
    extract(shortcode_atts(array(
                "title" => '',
            ), $atts));

    $content = spa_content_helper($content);

    $title = ($title <> '') ? esc_attr( ' ' . $title ) : '';


    $output = "<div class='textbox boxazul'>";
    $output .= "<h2>{$title}</h2>";
    $output .= "<article>" . do_shortcode($content) . "</article>";
    $output .= "</div>";

    return $output;
}



function spa_delete_htmltags($content,$paragraph_tag=false,$br_tag=false){
    $content = preg_replace('#^<\/p>|^<br \/>|<p>$#', '', $content);
    $content = preg_replace('#<br \/>#', '', $content);
    if ( $paragraph_tag ) $content = preg_replace('#<p>|</p>#', '', $content);
    return trim($content);
}


function spa_content_helper($content,$paragraph_tag=false,$br_tag=false){
    return spa_delete_htmltags( do_shortcode(shortcode_unautop($content)), $paragraph_tag, $br_tag );
}


?>