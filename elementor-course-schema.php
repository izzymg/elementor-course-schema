<?php
/**
 * Plugin Name: Elementor Course Schema
 * Description: Elementor widget: Adds course schema structured data JSON 
 * Version:     1.0.0
 * Author:      Izzy MG
 * Author URI:  https://izzymg.dev
 * Text Domain: elementor-course-schema
 */

function register_course_schema_widget( $widgets_manager ) {

	require_once( __DIR__ . '/widgets/course-schema-widget.php' );

	$widgets_manager->register( new \Elementor_Course_Schema_Widget() );

}
add_action( 'elementor/widgets/register', 'register_course_schema_widget' );
