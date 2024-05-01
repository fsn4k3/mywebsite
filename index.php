<?php

function cwpai_enqueue_styles() {
    wp_enqueue_style('cwpai-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'cwpai_enqueue_styles');

function cwpai_setup_theme() {
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'cwpai_setup_theme');

function cwpai_register_menus() {
    register_nav_menus(array(
        'header-menu' => __('Header Menu', 'codewp'),
        'footer-menu' => __('Footer Menu', 'codewp')
    ));
}
add_action('init', 'cwpai_register_menus');

function cwpai_theme_scripts() {
    wp_enqueue_script('cwpai-script', get_template_directory_uri() . '/js/custom.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'cwpai_theme_scripts');

get_header();

if (have_posts()) : 
    while (have_posts()) : the_post();
        the_content();
    endwhile;
else :
    echo '<p>' . __('Sorry, no posts matched your criteria.', 'codewp') . '</p>';
endif;

get_footer();
