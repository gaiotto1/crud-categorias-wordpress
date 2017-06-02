<?php

add_theme_support( 'post-thumbnails' );

//CRIA O POST TYPE “Posts Redes Sociais”

add_action('init','create_post_type_redes_sociais');

function create_post_type_redes_sociais(){

	register_taxonomy('categoria-redes-sociais',array('redes-sociais'), array(
		'hierarchical' => true,
		'show_ui' => true,
		'query_var' => true,
		'show_in_nav_menus' => true,
	));

	$args = array(
		'label' => 'Posts Redes Sociais',
		'show_ui' => true,
		'public' => true,
		'supports' => array('title','editor'),
		'rewrite' => array( 'slug' => 'posts-redes-sociais', 'with_front' => false ),
		'taxonomies' => array('categoria-redes-sociais'),
		'has_archive' => true
	 );
	 register_post_type('posts-redes-sociais',$args);
}
