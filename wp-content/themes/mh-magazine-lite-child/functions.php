<?php
add_action('wp_enqueue_scripts', 'mh_magazine_lite_child_enqueue_styles');
function mh_magazine_lite_child_enqueue_styles()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

add_action('wp_logout','ps_redirect_after_logout');
function ps_redirect_after_logout(){
    wp_redirect( '/login' );
    exit();
}

if (!function_exists('mh_magazine_lite_child_widgets_init')) {
    function mh_magazine_lite_child_widgets_init() {
        register_sidebar(array('name' => esc_html__('Second Sidebar', 'mh-magazine-lite'), 'id' => 'sidebar-posts', 'description' => esc_html__('Widget area (sidebar left/right) on single posts, pages and archives.', 'mh-magazine-lite'), 'before_widget' => '<div id="%1$s" class="mh-widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h4 class="mh-widget-title"><span class="mh-widget-title-inner">', 'after_title' => '</span></h4>'));
    }
}
add_action('widgets_init', 'mh_magazine_lite_child_widgets_init');


if (!function_exists('mh_magazine_lite_child_image_sizes')) {
    function mh_magazine_lite_child_image_sizes() {
        add_image_size('mh-magazine-lite-post', 200, 150, true);
    }
}
add_action('after_setup_theme', 'mh_magazine_lite_child_image_sizes');


?>