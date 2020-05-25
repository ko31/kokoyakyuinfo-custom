<?php
/**
 * @package snow-monkey
 * @author inc2734
 * @license GPL-2.0+
 * @version 10.2.0
 */

use Framework\Helper;

$eyecatch_position = 'post' === get_post_type() ? get_theme_mod( 'archive-eyecatch' ) : false;
?>

<div class="c-entry">
	<?php
	if ( 'title-on-page-header' !== $eyecatch_position ) {
		Helper::get_template_part( 'template-parts/archive/entry/header/header', get_post_type() );
	}
	?>

	<?php
	if ( $_channel_id = get_query_var( 'channel_id' ) ) :
		$_channel_site_url = get_post_meta( $_channel_id, '_fc_channel_site_url', true );
		?>
        <div class="wp-block-snow-monkey-blocks-box smb-box" style="border-width:1px">
            <div class="smb-box__body">
                <ul>
                    <li><a href="<?php echo esc_url( $_channel_site_url ); ?>" target="_blank"
                                   rel="noreferrer noopener"><?php echo get_the_title( $_channel_id ); ?></a></li>
                </ul>
            </div>
        </div>
	<?php
	endif;
	?>

    <div class="c-entry__body">
		<?php
		if ( 'content-top' === $eyecatch_position ) {
			Helper::get_template_part( 'template-parts/archive/eyecatch' );
		}

		Helper::get_template_part( 'template-parts/archive/entry/content/content', get_post_type() );
		?>
    </div>
</div>
