<?php

/**
 * Change query vars
 */
add_filter( 'query_vars', function ( $qvars ) {
	$qvars[] = 'channel_id';

	return $qvars;
} );

/**
 * Change main query
 */
add_action( 'pre_get_posts', function ( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	// Feed item アーカイブ
	if ( $query->is_post_type_archive( 'fc-feed-item' ) ) {

		// クエリパラメータに Feed channel があるときは絞り込みする
		if ( $channel_id = get_query_var( 'channel_id' ) ) {
			$query->set( 'meta_query', [
				'feed_channel' => [
					'key'     => '_fc_feed_channel_id',
					'value'   => $channel_id,
					'compare' => '=',
				],
			] );
		}

		// 1ページの表示件数を指定
		$query->set( 'posts_per_page', 20 );

		return;
	}

} );
