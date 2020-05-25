<?php
/**
 * Plugin name: kokoyakyuinfo-custom
 * Description: The extension plugin for kokoyakyu.info
 * Version: 0.1.0
 *
 * @package kokoyakyuinfo-custom
 * @author ko31
 * @license GPL-2.0+
 */

/**
 * Snow Monkey 以外のテーマを利用している場合は有効化してもカスタマイズが反映されないようにする
 */
$theme = wp_get_theme();
if ( 'snow-monkey' !== $theme->template && 'snow-monkey/resources' !== $theme->template ) {
	return;
}

/**
 * Snow Monkey テンプレートのルートディレクトリにプラグイン配下も追加
 */
add_filter(
	'snow_monkey_template_part_root_hierarchy',
	function ( $hierarchy ) {
		$hierarchy[] = untrailingslashit( __DIR__ ) . '/view';

		return $hierarchy;
	}
);

/**
 * Include custom libraries.
 */
foreach ( [ 'inc', 'plugins', 'themes' ] as $dir_name ) {
	$dir = __DIR__ . '/' . $dir_name;
	if ( is_dir( $dir ) ) {
		foreach ( scandir( $dir ) as $file ) {
			if ( preg_match( '#^[^._].*\.php$#u', $file ) ) {
				require $dir . '/' . $file;
			}
		}
	}
}

/**
 * Get plugin version.
 *
 * @return mixed
 */
function kki_version() {
	$data = get_file_data( __FILE__, [ 'version' => 'Version' ] );

	return $data['version'];
}
