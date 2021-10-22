<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.8.0
 */

use Framework\Helper;
?>

<?php do_action( 'snow_monkey_before_entry_content' ); ?>

<div class="c-entry__content p-entry-content">
	<?php do_action( 'snow_monkey_prepend_entry_content' ); ?>

	<?php
	// Display the description of feed item.
	$item_description   = get_post_meta( get_the_ID(), '_fc_item_description', true );
	if ( $item_description ):
		$item_permalink = get_post_meta( get_the_ID(), '_fc_item_permalink', true );
		$item_title     = get_post_meta( get_the_ID(), '_fc_item_title', true );
		$item_enclosure = get_post_meta( get_the_ID(), '_fc_item_enclosure', true );
		?>
        <blockquote class="wp-block-quote">
			<?php
			if ( $item_enclosure ):
				?>
                <img src="<?php echo esc_url( $item_enclosure ); ?>" alt="<?php echo esc_html( $item_title ); ?>"/>
			<?php
			endif;
			?>
	        <?php
            // Exclude the item that is made by feed43.
	        if ( strpos( $item_description, 'feed43.com' ) === false ):
		        ?>
                <p><?php echo esc_html( strip_tags( $item_description ) ); ?></p>
	        <?php
	        endif;
	        ?>
            <cite>元記事リンク：<a href="<?php echo esc_url( $item_permalink ); ?>" target="_blank"
                     rel="noreferrer noopener"><?php echo esc_html( $item_title ); ?></a>
            </cite>
        </blockquote>
	<?php
	endif;
	?>

	<?php Helper::get_template_part( 'template-parts/content/link-pages' ); ?>

	<?php do_action( 'snow_monkey_append_entry_content' ); ?>
</div>

<?php do_action( 'snow_monkey_after_entry_content' ); ?>
