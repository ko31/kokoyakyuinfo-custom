<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 7.0.0
 */

use Framework\Helper;

// 検索結果のレイアウトを simple 固定
$entries_layout = 'simple';
?>

<div class="c-entry__content p-entry-content">
	<div class="p-archive">
		<ul class="c-entries c-entries--<?php echo esc_attr( $entries_layout ); ?>">
			<?php while ( have_posts() ) : ?>
				<?php the_post(); ?>
				<li class="c-entries__item">
					<?php
                    // 投稿タイプによって読み込むテンプレートファイルを切り替える
                    $_post_type = get_post_type(get_the_ID());

					Helper::get_template_part(
						'template-parts/loop/entry-summary',
						$_post_type,
						[
							'_entries_layout' => $entries_layout,
						]
					);
					?>
				</li>
			<?php endwhile; ?>
		</ul>
	</div>

	<?php
	if ( ! empty( $wp_query->max_num_pages ) && $wp_query->max_num_pages >= 2 ) {
		Helper::get_template_part( 'template-parts/archive/pagination' );
	}
	?>
</div>
