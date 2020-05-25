<?php
/**
 * Filter the post type arguments of feed channel
 *
 * @param array $args
 */
add_filter( 'fc_feed_channel_register_post_type_args', function ( $args ) {

	// Feed channel の表示名を変更する
	$args['label']          = 'ニュース配信元';
	$args['labels']['name'] = 'ニュース配信元';

	return $args;
} );

/**
 * Filter the taxonomy arguments of feed channel
 *
 * @param array $args
 */
add_filter( 'fc_feed_channel_category_register_taxonomy_args', function ( $args ) {

	// Feed channel category の表示名を変更する
	$args['label'] = 'ニュースカテゴリー';

	return $args;
} );

/**
 * Filter the post type arguments of feed item
 *
 * @param array $args
 */
add_filter( 'fc_feed_item_register_post_type_args', function ( $args ) {

	// Feed item の表示名を変更する
	$args['label'] = '高校野球ニュース';

	return $args;
} );


/**
 * Filter the taxonomy arguments of feed item
 *
 * @param array $args
 */
add_filter( 'fc_feed_item_category_register_taxonomy_args', function ( $args ) {

	// Feed item タクソノミーのアーカイブを有効にする
	$args['label']   = 'ニュースタグ';
	$args['public']  = true;
	$args['rewrite'] = [
		'slug' => 'item-tag',
	];

	return $args;
} );
