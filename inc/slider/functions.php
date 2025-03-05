<?php

function enqueue_slider_assets() {
    wp_enqueue_style('slider-style', get_template_directory_uri() . '/inc/slider/slider.css', array('theme_css', 'custom_css'));
    // wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);
    wp_enqueue_script('slider-script', get_template_directory_uri() . '/inc/slider/slider.js', array('jquery', 'theme_js_6'), null, true);

    // Передаем AJAX URL в JS
    wp_localize_script('slider-script', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_slider_assets');




add_theme_support('post-thumbnails');

function create_slider_post_type() {
    register_post_type('slider',
        array(
            'labels'      => array(
                'name'          => __('Слайдер', 'textdomain'),
                'singular_name' => __('Слайд', 'textdomain'),
            ),
            'public'      => true,
            'has_archive' => false,
            'supports'    => array('title', 'editor', 'thumbnail'),
            'menu_icon'   => 'dashicons-images-alt2',
            'show_in_rest'=> true
        )
    );
}
add_action('init', 'create_slider_post_type');




function get_slide_content() {
    if (isset($_POST['post_id'])) {
        $post_id = intval($_POST['post_id']);
        $post = get_post($post_id);

        if ($post) {
            echo wp_kses_post($post->post_content);
        }
    }
    wp_die();
}
add_action('wp_ajax_get_slide_content', 'get_slide_content');
add_action('wp_ajax_nopriv_get_slide_content', 'get_slide_content');
