# Admin Secret WordPress Plugin

Protect and hide your WordPress login page and admin area by requiring a secret path to access the login page.

## Description

Admin Secret is a WordPress plugin that enhances security by adding an extra layer of authentication to the WordPress login page and admin area. It requires users to access a specific secret path to reach the login page, ensuring that unauthorized access attempts are blocked.

### Key Features

- Requires a secret path to access the WordPress login page.
- Sets a secure cookie upon accessing the secret path for session management.
- Clears the secret cookie on user logout.
- Restricts access to login and admin pages without the secret cookie.
- Provides a settings page to configure the secret key.

## Installation

1. Download the plugin zip file or clone the repository into your WordPress plugins directory.
2. Activate the "Admin Secret" plugin through the Plugins menu in WordPress.
3. Visit the "Admin Secret Settings" page under the Settings menu to configure your secret key.

## Usage

Once activated and configured, users must visit your specified secret path to access the WordPress login page. Upon successful access, a secure cookie is set, allowing access to the login page and admin area until logout.

## Settings

The plugin includes a settings page where you can set and manage your secret key. This key determines the secret path required to access the login page.

### Troubleshooting

If you forget the secret key and are locked out of the login page:
1. Disable the plugin by renaming or removing the plugin folder in `wp-content/plugins`.
2. Reinstall and reactivate the "Admin Secret" plugin through the Plugins menu in WordPress.
3. Visit the "Admin Secret Settings" page under the Settings menu to reset your secret key.

## Contributing

Contributions are welcome! If you have any suggestions, improvements, or issues, feel free to open an issue or pull request on GitHub.

## License

This plugin is licensed under the GPLv2 or later. See the [LICENSE](./LICENSE) file for more details.

## Author

- [Fadlee](https://fadlee.my.id)

## Support

For support or inquiries, please contact [fad.lee@hotmail.com](mailto:fad.lee@hotmail.com).
