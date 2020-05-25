<?php
add_action( 'init', function () {
	register_post_type( 'blog', [
		'has_archive'  => true,
		'public'       => true,
		'supports'     => [ 'title', 'editor', 'thumbnail', 'author' ],
		'label'        => 'ブログ',
		'menu_icon'    => 'dashicons-media-default',
		'show_in_rest' => true,
		'rewrite'      => [
			'with_front' => false
		],
	] );

	register_taxonomy( 'blog-cat', [ 'blog' ], [
		'label'             => 'カテゴリー',
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'rewrite'           => [
			'hierarchical' => true,
		],
		'show_in_rest'      => true,
	] );
} );

