<?php

function cwpai_custom_post_type() {
    register_post_type('cwpai_profile',
        array(
            'labels' => array(
                'name' => __('Profiles', 'codewp'),
                'singular_name' => __('Profile', 'codewp')
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor', 'thumbnail'),
            'rewrite' => array('slug' => 'profiles'),
        )
    );
}
add_action('init', 'cwpai_custom_post_type');

function cwpai_add_custom_meta_boxes() {
    add_meta_box(
        'cwpai_profile_details',
        __('Profile Details', 'codewp'),
        'cwpai_profile_details_callback',
        'cwpai_profile',
        'normal',
        'default'
    );
}
add_action('add_meta_boxes', 'cwpai_add_custom_meta_boxes');

function cwpai_profile_details_callback($post) {
    wp_nonce_field('cwpai_profile_save_meta_box_data', 'cwpai_profile_meta_box_nonce');
    $experience = get_post_meta($post->ID, '_cwpai_profile_experience', true);
    $certificates = get_post_meta($post->ID, '_cwpai_profile_certificates', true);
    $pictures = get_post_meta($post->ID, '_cwpai_profile_pictures', true);

    echo '<label for="cwpai_profile_experience">Experience</label>';
    echo '<textarea id="cwpai_profile_experience" name="cwpai_profile_experience" rows="5" cols="50">' . esc_textarea($experience) . '</textarea><br>';
    echo '<label for="cwpai_profile_certificates">Certificates</label>';
    echo '<textarea id="cwpai_profile_certificates" name="cwpai_profile_certificates" rows="5" cols="50">' . esc_textarea($certificates) . '</textarea><br>';
    echo '<label for="cwpai_profile_pictures">Pictures (URLs, separated by commas)</label>';
    echo '<input type="text" id="cwpai_profile_pictures" name="cwpai_profile_pictures" value="' . esc_attr($pictures) . '" size="50"><br>';
}

function cwpai_save_profile_meta_box_data($post_id) {
    if (!isset($_POST['cwpai_profile_meta_box_nonce']) || !wp_verify_nonce($_POST['cwpai_profile_meta_box_nonce'], 'cwpai_profile_save_meta_box_data')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (isset($_POST['cwpai_profile_experience']) && isset($_POST['cwpai_profile_certificates']) && isset($_POST['cwpai_profile_pictures'])) {
        update_post_meta($post_id, '_cwpai_profile_experience', sanitize_text_field($_POST['cwpai_profile_experience']));
        update_post_meta($post_id, '_cwpai_profile_certificates', sanitize_text_field($_POST['cwpai_profile_certificates']));
        update_post_meta($post_id, '_cwpai_profile_pictures', sanitize_text_field($_POST['cwpai_profile_pictures']));
    }
}
add_action('save_post', 'cwpai_save_profile_meta_box_data');
