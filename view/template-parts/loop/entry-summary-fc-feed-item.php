<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 7.0.0
 */

use Framework\Helper;

// Feed item 情報を取得
$item_permalink = get_post_meta( get_the_ID(), '_fc_item_permalink', true );
?>

<?php //TODO: 外部リンクアイコンを表示したい ?>
<a href="<?php echo esc_url($item_permalink); ?>" target="_blank" rel="noopener noreferrer">
	<section class="c-entry-summary c-entry-summary--post">

		<div class="c-entry-summary__body">
            <header class="c-entry-summary__header">
				<?php Helper::get_template_part( 'template-parts/loop/entry-summary/title/title', 'fc-feed-item' ); ?>
            </header>

			<?php Helper::get_template_part( 'template-parts/loop/entry-summary/meta/meta', 'fc-feed-item' ); ?>
		</div>
	</section>
</a>
