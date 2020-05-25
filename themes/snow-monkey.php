<?php
/**
 * Show table of contents in post automatically.
 */
add_filter( 'snow_monkey_display_contents_outline', function () {
	return kouka_has_table_of_contents();
} );

/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 4.2.13
 */

add_action(
	'snow_monkey_entry_meta_items',
	function () {
		remove_action( 'snow_monkey_entry_meta_items', 'snow_monkey_entry_meta_items_author', 10 );


//		if ( 'modified-date' === get_theme_mod( 'post-date' ) ) {
//			ob_start();
//			snow_monkey_entry_meta_items_modified();
//			$modified = ob_get_clean();
//
//			if ( $modified ) {
//				remove_action( 'snow_monkey_entry_meta_items', 'snow_monkey_entry_meta_items_published', 10 );
//			}
//		} elseif ( 'modified-date-high' === get_theme_mod( 'post-date' ) ) {
//			remove_action( 'snow_monkey_entry_meta_items', 'snow_monkey_entry_meta_items_published', 10 );
//			remove_action( 'snow_monkey_entry_meta_items', 'snow_monkey_entry_meta_items_modified', 20 );
//			add_action( 'snow_monkey_entry_meta_items', 'snow_monkey_entry_meta_items_modified', 10 );
//			add_action( 'snow_monkey_entry_meta_items', 'snow_monkey_entry_meta_items_published_no_time', 20 );
//		}
	},
	9
);