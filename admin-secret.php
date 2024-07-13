<?php
/*
Plugin Name: Admin Secret
Description: Protect and hide your WordPress login page and admin area by requiring a secret path to access the login page.
Author: Fadlee
Author URI: https://fadlee.my.id
Version: 1.0
Requires at least: 5.6
Tested up to: 6.5
Requires PHP: 7.0
Text Domain: admin-secret
License: GPLv2 or later
*/

class AdminSecret {
    private static $instance;

    public static function get_instance() {
        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action( 'plugins_loaded', array( $this, 'setup_secret_access' ), 1 );
        add_action( 'wp_logout', array( $this, 'clear_admin_secret_cookie' ) );
        add_action( 'admin_menu', array( $this, 'admin_secret_add_settings_page' ) );
        add_action( 'admin_init', array( $this, 'admin_secret_register_settings' ) );
        add_action( 'secure_auth_redirect', array( $this, 'admin_secret_check_secure_cookie' ), 1 );
        add_action( 'login_init', array( $this, 'admin_secret_check_secure_cookie' ), 1 );
        add_action( 'template_redirect', array( $this, 'remove_default_redirect' ) );
        register_activation_hook( __FILE__, array( $this, 'set_admin_secret_cookie' ) );
    }

    public function get_admin_secret_key() {
        return get_option( 'admin_secret_key', 'secret' );
    }

    private function get_admin_secret_cookie_name() {
        return 'admin_secret_' . wp_hash( AUTH_SALT );
    }

    public function set_admin_secret_cookie() {
        setcookie( $this->get_admin_secret_cookie_name(), '1', 0, COOKIEPATH, COOKIE_DOMAIN );
    }

    public function clear_admin_secret_cookie() {
        setcookie( $this->get_admin_secret_cookie_name(), '', 0, COOKIEPATH, COOKIE_DOMAIN );
        wp_redirect( home_url() );
        exit();
    }

    public function setup_secret_access() {
        $secret_key = $this->get_admin_secret_key();
        $arr = explode( '/', trim( $_SERVER['REQUEST_URI'], '/' ) );
        $path = array_pop( $arr );

        if ( $path == $secret_key ) {
            $GLOBALS['cache_stop'] = 1;
            $this->set_admin_secret_cookie();
            header( 'Cache-Control: no-store, no-cache, must-revalidate, max-age=0' );
            header( 'Cache-Control: post-check=0, pre-check=0', false );
            header( 'Pragma: no-cache' );
            wp_redirect( wp_login_url() );
            exit();
        }
    }

    public function admin_secret_check_secure_cookie() {
        if ( isset( $_COOKIE[ $this->get_admin_secret_cookie_name() ] ) ) {
            return;
        }

        global $wp_query;
        $wp_query->set_404();
        status_header( 404 );

        // prevent fatal error on WP 5.9.1 & hide admin bar
        $GLOBALS['current_screen'] = new class {
            function in_admin() {
                return false;
            }
        };

        locate_template( ['404.php', 'index.php'], true, false );

        exit();
    }

    public function remove_default_redirect() {
        remove_action( 'template_redirect', 'wp_redirect_admin_locations', 1000 );
    }

    public function admin_secret_add_settings_page() {
        add_options_page(
            'Admin Secret Settings',
            'Admin Secret',
            'manage_options',
            'admin-secret-settings',
            array( $this, 'admin_secret_render_settings_page' )
        );
    }

    public function admin_secret_render_settings_page() {
        ?>
        <div class="wrap">
            <h1>Admin Secret Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields( 'admin_secret_settings' );
                do_settings_sections( 'admin-secret-settings' );
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    public function admin_secret_register_settings() {
        register_setting( 'admin_secret_settings', 'admin_secret_key' );

        add_settings_section(
            'admin_secret_settings_section',
            'Admin Secret Key',
            null,
            'admin-secret-settings'
        );

        add_settings_field(
            'admin_secret_key',
            'Secret Key',
            array( $this, 'admin_secret_key_render_field' ),
            'admin-secret-settings',
            'admin_secret_settings_section'
        );
    }

    public function admin_secret_key_render_field() {
        $secret_key = $this->get_admin_secret_key();
        echo '<input type="text" name="admin_secret_key" required value="' . esc_attr( $secret_key ) . '" />';
    }
}

AdminSecret::get_instance();
