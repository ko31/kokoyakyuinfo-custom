<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 6.0.0
 */

// Feed item 情報を取得
$item_permalink  = get_post_meta( get_the_ID(), '_fc_item_permalink', true );
$item_channel_id = get_post_meta( get_the_ID(), '_fc_feed_channel_id', true );
$item_channel    = get_the_title( $item_channel_id );
$item_terms      = get_the_terms( get_the_ID(), 'fc-feed-item-tag' );
?>

<div class="c-entry-summary__meta">
    <ul class="c-meta">
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
        <li class="c-meta__item c-meta__item--published">
			<?php //TODO: 時間もあったほうがいいかも ?>
			<?php //the_time( get_option( 'date_format' ).' '. get_option( 'time_format' )  ); ?>
			<?php the_time( get_option( 'date_format' ) ); ?>
        </li>
        <li class="c-meta__item c-meta__item--published">
			<?php if ( $item_terms ) : ?>
				<?php foreach ( $item_terms as $_term ) : ?>
                    <span class="tag-cloud-link"
                          onclick="location.href='<?php echo get_term_link( $_term->slug, 'fc-feed-item-tag' ); ?>'; return false;"><?php echo esc_html( $_term->name ); ?></span>
				<?php endforeach; ?>
			<?php endif; ?>
        </li>
    </ul>
</div>
