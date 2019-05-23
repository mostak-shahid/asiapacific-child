<?php
function moslatest_metaboxes() {
    global $project_array;
    $forms = get_formadable_form_list();
    $pages_id = get_all_pages_list_with_id ();
    $pages_link = get_all_pages_list_with_link ();
    $prefix = '_mosacademy_child_';
    $class_details = new_cmb2_box(array(
        'id' => $prefix.'class_details',
        'title' => __( 'Class Details', 'cmb2' ),
        'object_types'  => array( 'class' ), // Post type 
    ));    
    $class_details->add_field( array(
        'name'             => 'Day',
        'desc'             => 'Select an option',
        'id'               => $prefix.'calass_day',
        'type'             => 'select',
        'default'          => 'custom',
        'options'          => array(
            'sun' => __( 'Sunday', 'cmb2' ),
            'mon'   => __( 'Monday', 'cmb2' ),
            'tue'     => __( 'Tuesday', 'cmb2' ),
            'wed'     => __( 'Wednesday', 'cmb2' ),
            'thu'     => __( 'Thursday', 'cmb2' ),
            'fri'     => __( 'Friday', 'cmb2' ),
            'sat'     => __( 'Saturday', 'cmb2' ),
        ),
    )); 
    $class_details->add_field( array(
        'name' => 'Start From',
        'id' => $prefix.'calass_start',
        'type' => 'text_time'
    ));
    $class_details->add_field( array(
        'name' => 'End at',
        'id' => $prefix.'calass_end',
        'type' => 'text_time'
    ));
    /*$class_details->add_field( array(
        'name'           => 'Category',
        'id'             => $prefix.'class_cat',
        'taxonomy'       => 'class-category', //Enter Taxonomy Slug
        'type'           => 'taxonomy_select',
        'remove_default' => false // Removes the default metabox provided by WP core.
        // Optionally override the args sent to the WordPress get_terms function.
        // 'query_args' => array(
        //     // 'orderby' => 'slug',
        //     // 'hide_empty' => true,
        // ),
    ) );*/
    $price_details = new_cmb2_box(array(
        'id' => $prefix.'price_details',
        'title' => __( 'Price Details', 'cmb2' ),
        'object_types'  => array( 'page' ), // Post type 
    )); 
    $price_details_id = $price_details->add_field( array(
        'id'   => $prefix . 'price_details_group',
        'type' => 'group',
    )); 

    $price_details->add_group_field( $price_details_id, array(
        'name' => 'Price Title',
        'id'   => $prefix . 'price_title',
        'type' => 'text',
    )); 
    $price_details->add_group_field( $price_details_id, array(
        'name'    => 'Price Description',
        'id'      => $prefix . 'price_details',
        'type'    => 'textarea',
    ));
}
add_action('cmb2_admin_init', 'moslatest_metaboxes');