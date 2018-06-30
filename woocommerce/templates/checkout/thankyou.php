<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="woocommerce-order">

	<?php if ( $order ) : ?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e( 'Pay', 'woocommerce' ) ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php _e( 'My account', 'woocommerce' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>
			
			<style type="text/css">
				*{
					font-size: 15px;
					color: #0d0d0d;
				}
				.woocommerce-notice{
					margin-bottom:10px;
				}
				.order_details{
					margin-left:10px;
					margin-top:0px;
				}
				.order_details li{
					list-style:none;
				}
	        </style>
			
			<center>
				<h2 class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received">
					<?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); ?>
				</h2>
			</center>			
	
			<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

				<li class="woocommerce-order-overview__order order">
					<?php _e( 'Order number:', 'woocommerce' ); ?>
					<strong><?php echo $order->get_order_number(); ?></strong>
				</li>

				<li class="woocommerce-order-overview__order order">
					<?php $wing_tid = get_post_meta( $order->id, "wing_tid", true); ?>
					<?php _e( 'Wing Transaction:', 'woocommerce' ); ?>
					<strong><?php echo $wing_tid; ?></strong>
				</li>

				<li class="woocommerce-order-overview__date date">
					<?php _e( 'Date:', 'woocommerce' ); ?>
					<strong><?php echo wc_format_datetime( $order->get_date_created() ); ?></strong>
				</li>

				<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
					<li class="woocommerce-order-overview__email email">
						<?php _e( 'Email:', 'woocommerce' ); ?>
						<strong><?php echo $order->get_billing_email(); ?></strong>
					</li>
				<?php endif; ?>

				<li class="woocommerce-order-overview__total total hidden">
					<?php _e( 'Total:', 'woocommerce' ); ?>
					<strong><?php echo $order->get_formatted_order_total(); ?></strong>
				</li>

				<?php if ( $order->get_payment_method_title() ) : ?>
					<li class="woocommerce-order-overview__payment-method method hidden">
						<?php _e( 'Payment method:', 'woocommerce' ); ?>
						<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
					</li>
				<?php endif; ?>
				
				<li class="woocommerce-order-overview__address address">
					<?php $order1 = $order->get_address( 'billing' ); ?>
					<?php _e( 'Address :', 'woocommerce' ); ?>
					<?=  $order1['country'] ?>
					<?=  (!empty($order1['city'])? ", " . $order1['city']:"") ?> 
					<?=  (!empty($order1['state'])? ", " . $order1['state']:"") ?> 
					<?=  (!empty($order1['address_1'])? ", " . $order1['address_1']:"") ?> 
					<?=  (!empty($order1['address_2'])? ", " . $order1['address_2']:"") ?>
					<?=  (!empty($order1['postcode'])? ", " . $order1['postcode']:"") ?>
		
				</li>
				
				<?php if ( $show_shipping ) : ?>
				
				<li class="woocommerce-order-overview__address address">
					<?php $order1 = $order->get_address( 'shipping' ); ?>
					<?php _e( 'Shipping address :', 'woocommerce' ); ?>
					<?=  $order1['country'] ?>
					<?=  (!empty($order1['city'])? ", " . $order1['city']:"") ?> 
					<?=  (!empty($order1['state'])? ", " . $order1['state']:"") ?> 
					<?=  (!empty($order1['address_1'])? ", " . $order1['address_1']:"") ?> 
					<?=  (!empty($order1['address_2'])? ", " . $order1['address_2']:"") ?>
					<?=  (!empty($order1['postcode'])? ", " . $order1['postcode']:"") ?>
				</li>
				
				<?php endif; ?>

			</ul>









			
















		<?php endif; ?>

		<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
		<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

	<?php else : ?>

		<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>

	<?php endif; ?>

</div>