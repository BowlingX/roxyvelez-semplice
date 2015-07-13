<?php

function roxy_scripts()
{
    wp_enqueue_style('style-app', get_stylesheet_directory_uri() . '/build/App.css');
    wp_enqueue_script('app', get_stylesheet_directory_uri() . '/build/App.js');
    wp_enqueue_script('vimeo', 'https://f.vimeocdn.com/js/froogaloop2.min.js');
}

add_action('wp_enqueue_scripts', 'roxy_scripts');