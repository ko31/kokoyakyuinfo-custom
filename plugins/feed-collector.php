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

/**
 * When new feed item saves, analyze specific nouns from the post_title, and save them to term.
 *
 * @param int $post_ID Post ID.
 * @param WP_Post $post Post object.
 * @param bool $update Whether this is an existing post being updated.
 */
add_action( 'wp_insert_post', function ( $post_ID, $post, $update ) {
	if ( wp_is_post_revision( $post_ID ) ) {
		return;
	}

	if ( $post->post_type !== 'fc-feed-item' ) {
		return;
	}

	// @link https://labs.goo.ne.jp/api/jp/named-entity-extraction/
	$endpoint_url = 'https://labs.goo.ne.jp/api/entity';

	// Get application ID from option data.
	$app_id = get_option( 'goo_entity_app_id' );
	if ( empty( $app_id ) ) {
		return;
	}

	$args     = [
		'body' => [
			'app_id'   => $app_id,
			'sentence' => $post->post_title,
		],
	];
	$response = wp_remote_post( $endpoint_url, $args );
	if ( is_wp_error( $response ) ) {
		return;
	}

	$data = json_decode( $response['body'], true );
	if ( is_array( $data['ne_list'] ) ) {
		$terms = [];
		foreach ( $data['ne_list'] as $item ) {
			$terms[] = (string) $item[0];
		}
		if ( $terms ) {
			wp_set_object_terms( $post_ID, $terms, 'fc-feed-item-tag' );
		}
	}
}, 10, 3 );
