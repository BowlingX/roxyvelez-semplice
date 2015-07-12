<?php

function roxy_scripts()
{
    wp_enqueue_style('style-name', get_stylesheet_directory_uri() . '/build/styles.css');
    wp_enqueue_script('script-name', get_stylesheet_directory_uri() . '/build/App.js', array(), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'roxy_scripts');