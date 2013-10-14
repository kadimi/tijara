<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;
// $rating = esc_attr( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) );
?>
<li id="li-comment-<?php comment_ID() ?>">
	<div id="comment-<?php comment_ID(); ?>" class="comment_container">

		<?php echo get_avatar( $GLOBALS['comment'], $size='60' ); ?>

		<div class="comment-text">

			<?php if ($GLOBALS['comment']->comment_approved == '0') : ?>
				<p class="meta"><em><?php _e( 'Your comment is awaiting approval', 'woocommerce' ); ?></em></p>
			<?php else : ?>
				<p class="meta">
					<strong itemprop="author"><?php comment_author(); ?></strong> <?php

						if ( get_option('woocommerce_review_rating_verification_label') == 'yes' )
							if ( woocommerce_customer_bought_product( $GLOBALS['comment']->comment_author_email, $GLOBALS['comment']->user_id, $post->ID ) )
								echo '<em class="verified">(' . __( 'verified owner', 'woocommerce' ) . ')</em> ';

					?>&ndash; <time itemprop="datePublished" datetime="<?php echo get_comment_date('c'); ?>"><?php echo get_comment_date(__( get_option('date_format'), 'woocommerce' )); ?></time>:
				</p>
			<?php endif; ?>

				<div itemprop="description" class="description">
					<?php comment_text(); ?>
	
					<?php 
					global $ratings_labels;
					if ( get_option('woocommerce_enable_review_rating') == 'yes' ) : 
						for($i=1; $i <= count($ratings_labels); $i++):
							$rating = esc_attr( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating_' . $i, true ) );
					?>
						<div style="background:rgba(0,0,0,0);width:100px;margin:5px;padding:5px" class="alignleft">
							<div><?php echo $ratings_labels[$i - 1]; ?></div>
							<div class="star-rating alignleft" title="<?php echo sprintf(__( 'Rated %d out of 5', 'woocommerce' ), $rating) ?>"><span style="width:<?php echo ( intval( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating_'.$i, true ) ) / 5 ) * 100; ?>%"><strong ><?php echo intval( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating_'.$i, true ) ); ?></strong> <?php _e( 'out of 5', 'woocommerce' ); ?></span>
							</div>
						</div>
						<?php endfor; ?>
					<?php endif; ?>

				</div>
				<div class="clear"></div>
			</div>
		<div class="clear"></div>
	</div>
