# wp-check-is-admin-request

Check if request is made from WordPress backend

It is not so easy to check if a request was made from the backend or not. This post shows my solution for that, which I build recently.
The problem with is_admin()

The plugin Lazy Loading Responsive Images needs to check if a request was made in the backend, to modify only image markup at the front end. The function is_admin() checks if a backend page was called – this was the first solution used in the plugin.

But then a user came across a problem with that: the function returns true for AJAX requests because they use the wp-admin/admin-ajax.php. That means the lazy loading plugin did not work for front end content which is added via AJAX because is_admin() returns true.
