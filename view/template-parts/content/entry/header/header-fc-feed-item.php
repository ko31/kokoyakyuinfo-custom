<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 13.0.0
 */

use Framework\Helper;

$args = wp_parse_args(
	// phpcs:disable VariableAnalysis.CodeAnalysis.VariableAnalysis.UndefinedVariable
	$args,
	// phpcs:enable
	[
		'_display_title_top_widget_area' => false,
		'_display_entry_meta'            => false,
	]
);
?>

<header class="c-entry__header">
	<?php
	if ( $args['_display_title_top_widget_area'] ) {
		if ( Helper::is_active_sidebar( 'title-top-widget-area' ) ) {
			Helper::get_template_part(
				'template-parts/widget-area/title-top',
				$args['_name']
			);
		}
	}
	?>

	<h1 class="c-entry__title"><?php the_title(); ?></h1>

	<?php if ( $args['_display_entry_meta'] ) : ?>
		<div class="c-entry__meta">
			<?php
			Helper::get_template_part(
				'template-parts/content/entry-meta',
				$args['_name']
			);
			?>
		</div>
	<?php endif; ?>

    <div class="c-entry__meta">
        <ul class="c-meta">
	        <?php
	        // Display the published date of feed item.
	        $item_published = get_post_meta( get_the_ID(), '_fc_item_published', true );
	        if ( $item_published ):
		        $datetime = new DateTime($item_published);
		        $datetime->setTimeZone( new DateTimeZone(wp_timezone_string()));
		        ?>
                <li class="c-meta__item c-meta__item--published">
                    <i class="far fa-clock" aria-hidden="true"></i>
                    <span class="screen-reader-text">投稿日</span>
                    <time datetime="<?php echo esc_attr( $datetime->format(DateTime::ISO8601) ); ?>"><?php echo esc_html( $datetime->format('Y-m-d') ); ?></time>
                </li>
	        <?php
	        endif;
	        ?>
	        <?php
	        // Display the permalink of feed item.
	        $item_channel_id = get_post_meta( get_the_ID(), '_fc_feed_channel_id', true );
	        $item_channel    = get_the_title( $item_channel_id );
	        if ($item_channel):
		        ?>
                <li class="c-meta__item c-meta__item--author">
			        <?php
			        $attr = [
				        'alt'     => esc_attr( $item_channel ),
				        'onclick' => "location.href='" . sprintf( '%s?channel_id=%s', get_post_type_archive_link( 'fc-feed-item' ), $item_channel_id ) . "'; return false;",
			        ];
			        echo get_the_post_thumbnail( $item_channel_id, 'thumbnail', $attr );
			        ?>
			        <?php //TODO: 配信元のリンクを見立たせる ?>
                    <span class="channel-cloud-link"
                          onclick="location.href='<?php printf( '%s?channel_id=%s', get_post_type_archive_link( 'fc-feed-item' ), $item_channel_id ); ?>'; return false;"><?php echo esc_html( $item_channel ); ?></span>
                </li>
	        <?php
	        endif;
	        ?>
	        <?php
	        // Display the terms of feed item.
	        $item_terms = get_the_terms( get_the_ID(), 'fc-feed-item-tag' );
	        if ( $item_terms ):
		        ?>
                <li class="c-meta__item c-meta__item--published">
			        <?php if ( $item_terms ) : ?>
				        <?php foreach ( $item_terms as $_term ) : ?>
                            <span class="tag-cloud-link"><a
                                        href="<?php echo get_term_link( $_term->slug, 'fc-feed-item-tag' ); ?>"><?php echo esc_html( $_term->name ); ?></a></span>
				        <?php endforeach; ?>
			        <?php endif; ?>
                </li>
	        <?php
	        endif;
	        ?>
        </ul>
    </div>
</header>
