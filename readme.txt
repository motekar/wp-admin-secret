=== Admin Secret ===
Contributors: Fadlee
Donate link: https://fadlee.my.id
Tags: security, admin, login, authentication
Requires at least: 5.6
Requires PHP: 7.0
Tested up to: 6.5
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Protect and hide your WordPress login page and admin area by requiring a secret path to access the login page.

== Description ==

Admin Secret is a WordPress plugin that enhances security by adding an extra layer of authentication to the WordPress login page and admin area. It requires users to access a specific secret path to reach the login page, ensuring that unauthorized access attempts are blocked.

= Features =

– Requires a secret path to access the WordPress login page.
– Sets a secure cookie upon accessing the secret path for session management.
– Clears the secret cookie on user logout.
– Restricts access to login and admin pages without the secret cookie.
– Provides a settings page to configure the secret key.

== Installation ==

1. Upload the plugin folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Visit the "Admin Secret Settings" page under the Settings menu to configure your secret key.

== Frequently Asked Questions ==

= What should I do if I forget the secret key? =

If you forget the secret key and are locked out of the login page:
1. Disable the plugin by renaming or removing the plugin folder in `wp-content/plugins`.
2. Reinstall and reactivate the "Admin Secret" plugin through the Plugins menu in WordPress.
3. Visit the "Admin Secret Settings" page under the Settings menu to reset your secret key.

== Screenshots ==

1. Plugin settings page – Screenshot of the Admin Secret Settings page.

== Changelog ==

= 1.0.0 =
* Initial release

== Upgrade Notice ==

= 1.0.0 =
Upgrade to the initial version of Admin Secret for enhanced security features.

== Support ==

For support or inquiries, please contact [Your Name](https://yourwebsite.com/contact/).
