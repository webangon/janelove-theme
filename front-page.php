<?php
/**
 *Template Name: Front page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */
get_header(); 
do_action('jl_hero');
do_action('jl_popular_topics');
do_action('jl_new_course');
do_action('jl_top_rated');
do_action('jl_counter');
do_action('jl_author');
get_footer();

