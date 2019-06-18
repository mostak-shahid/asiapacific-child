<?php
// add_action( 'action_before_footer', 'bottom_section_fnc', 10, 1 );
// function bottom_section_fnc ($page_details) {
//  get_template_part( 'template-parts/section', 'bottom' );
// }

add_action( 'action_below_page', 'map_fnc', 10, 1 );
function map_fnc ($page_details) {
    if ($page_details['id'] == 32)
    get_template_part( 'template-parts/section', 'map' );
}

add_action( 'wp_head', 'remove_theme_actions' );
function remove_theme_actions () {
    // remove_action( 'action_after_gallery', 'gallery_link_func', 1 );
    remove_action( 'action_above_header', 'small_device_logo_fnc' );
}
add_action( 'action_before_banner_title', 'banner_layout_start', 99, 1 );
function banner_layout_start ($page_details) {
    echo '<div class="row">';
    echo '<div class="col-lg-6">';
}
add_action( 'action_after_banner_url', 'banner_layout_end', 1, 1 );
function banner_layout_end ($page_details) {
    echo '</div>';
    echo '</div>';
}
add_action( 'action_before_contact_form', 'contact_layout_start', 9, 1 );
function contact_layout_start ($page_details) {
    echo '<div class="row justify-content-center">';
    echo '<div class="col-lg-9">';
}
add_action( 'action_after_contact_form', 'contact_layout_end', 1, 1 );
function contact_layout_end ($page_details) {
    echo '</div>';
    echo '</div>';
}
add_action( 'action_before_gallery', 'gallery_link_func', 20, 1 );


add_action( 'init', 'child_text_layout_manager' );
function child_text_layout_manager () {
    global $mosacademy_options;
    //New Feed
    if ($mosacademy_options['sections-feed-text-layout'] == 'container-fliud-spacing') {
        add_action( 'action_before_feed', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_feed', 'start_row', 11, 1 );
        add_action( 'action_before_feed', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_feed', 'end_div', 10, 1 );
        add_action( 'action_after_feed', 'end_div', 11, 1 );
        add_action( 'action_after_feed', 'end_div', 12, 1 );   
    } elseif ($mosacademy_options['sections-feed-text-layout'] == 'container-fliud') {
        add_action( 'action_before_feed', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_feed', 'end_div', 10, 1 );
    } elseif ($mosacademy_options['sections-feed-text-layout'] == 'container-full') {
        add_action( 'action_before_feed', 'start_full_width', 10, 1 );
        add_action( 'action_after_feed', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_feed', 'start_container', 10, 1 );
        add_action( 'action_after_feed', 'end_div', 10, 1 );
    }
    //Lesson Times
    if ($mosacademy_options['sections-times-text-layout'] == 'container-fliud-spacing') {
        add_action( 'action_before_times', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_times', 'start_row', 11, 1 );
        add_action( 'action_before_times', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_times', 'end_div', 10, 1 );
        add_action( 'action_after_times', 'end_div', 11, 1 );
        add_action( 'action_after_times', 'end_div', 12, 1 );   
    } elseif ($mosacademy_options['sections-times-text-layout'] == 'container-fliud') {
        add_action( 'action_before_times', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_times', 'end_div', 10, 1 );
    } elseif ($mosacademy_options['sections-times-text-layout'] == 'container-full') {
        add_action( 'action_before_times', 'start_full_width', 10, 1 );
        add_action( 'action_after_times', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_times', 'start_container', 10, 1 );
        add_action( 'action_after_times', 'end_div', 10, 1 );
    }
    //Testimonial Section
    if ($mosacademy_options['sections-testimonial-text-layout'] == 'container-fliud-spacing') {
        add_action( 'action_before_testimonial', 'start_container_fluid', 10, 1 );
        add_action( 'action_before_testimonial', 'start_row', 11, 1 );
        add_action( 'action_before_testimonial', 'start_container_col_10', 12, 1 );

        add_action( 'action_after_testimonial', 'end_div', 10, 1 );
        add_action( 'action_after_testimonial', 'end_div', 11, 1 );
        add_action( 'action_after_testimonial', 'end_div', 12, 1 );   
    } elseif ($mosacademy_options['sections-testimonial-text-layout'] == 'container-fliud') {
        add_action( 'action_before_testimonial', 'start_container_fluid', 10, 1 );
        add_action( 'action_after_testimonial', 'end_div', 10, 1 );
    } elseif ($mosacademy_options['sections-testimonial-text-layout'] == 'container-full') {
        add_action( 'action_before_testimonial', 'start_full_width', 10, 1 );
        add_action( 'action_after_testimonial', 'end_div', 10, 1 );
    } else {
        add_action( 'action_before_testimonial', 'start_container', 10, 1 );
        add_action( 'action_after_testimonial', 'end_div', 10, 1 );
    }
}

// Add the custom columns to the class post type:
add_filter( 'manage_class_posts_columns', 'set_custom_edit_class_columns' );
function set_custom_edit_class_columns($columns) {
    // unset( $columns['author'] );
    $columns['class_date'] = __( 'Day', 'your_text_domain' );
    // $columns['publisher'] = __( 'Publisher', 'your_text_domain' );
    return $columns;
}

// Add the data to the custom columns for the class post type:
add_action( 'manage_class_posts_custom_column' , 'custom_class_column', 10, 2 );
function custom_class_column( $column, $post_id ) {
    $days = array(
        "sun" => "Sunday",
        "mon" => "Monday",
        "tue" => "Tuesday",
        "wed" => "Wednesday",
        "thu" => "Thursday",
        "fri" => "Friday",
        "sat" => "Saturday",    
    );
    switch ( $column ) {
        case 'class_date' :
            echo $days[get_post_meta( $post_id , '_mosacademy_child_calass_day' , true )] . " (" . get_post_meta( $post_id , '_mosacademy_child_calass_start' , true ) . " - " .get_post_meta( $post_id , '_mosacademy_child_calass_end' , true ) . ")"; 
            break;

    }
}



