# wp-check-is-admin-request

Check if request is made from WordPress backend

It is not so easy to check if a request was made from the backend or not. This post shows my solution for that, which I build recently.
The problem with is_admin()

The plugin Lazy Loading Responsive Images needs to check if a request was made in the backend, to modify only image markup at the front end. The function is_admin() checks if a backend page was called – this was the first solution used in the plugin.

But then a user came across a problem with that: the function returns true for AJAX requests because they use the wp-admin/admin-ajax.php. That means the lazy loading plugin did not work for front end content which is added via AJAX because is_admin() returns true.

Check if request is made from WordPress backend
July 21, 2017

It is not so easy to check if a request was made from the backend or not. This post shows my solution for that, which I build recently.
The problem with is_admin()

The plugin Lazy Loading Responsive Images needs to check if a request was made in the backend, to modify only image markup at the front end. The function is_admin() checks if a backend page was called – this was the first solution used in the plugin.

But then a user came across a problem with that: the function returns true for AJAX requests because they use the wp-admin/admin-ajax.php. That means the lazy loading plugin did not work for front end content which is added via AJAX because is_admin() returns true.
The solution

With that in mind, the solution has to check for AJAX requests somewhere. The first try of a function to replace the is_admin() calls looked like the following (kindly directly supplied by the user zitrusblau with the issue report):

```
<?php
function is_admin_request() {
	if ( function_exists( 'wp_doing_ajax' ) ) {
		return is_admin() && ! wp_doing_ajax();
	} else {
		return is_admin() && ! ( defined( 'DOING_AJAX' ) && DOING_AJAX );
	}
}
```
That worked for the front end, but the same user later found a new issue with that: the plugin now lazy loads the post thumbnail feature in the backend. With that, a newly chosen featured image did not show up in the meta box directly, but only after saving the post.
