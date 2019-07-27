<?php
// CHECK IS ADMIN REQUEST
function is_admin_request() {
	$current_url = home_url( add_query_arg( null, null ) );
	$admin_url = strtolower( admin_url() );
	$referrer  = strtolower( wp_get_referer() );
	if ( 0 === strpos( $current_url, $admin_url ) ) {
		if ( 0 === strpos( $referrer, $admin_url ) ) {
			return true;
		} else {
			if ( function_exists( 'wp_doing_ajax' ) ) {
				return ! wp_doing_ajax();
			} else {
				return ! ( defined( 'DOING_AJAX' ) && DOING_AJAX );
			}
		}
	} else {
		return false;
	}
}
