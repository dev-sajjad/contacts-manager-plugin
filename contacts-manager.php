<?php

/**
 * Plugin Name: Contacts Manager
 * Description: A simple plugin to manage contacts in WordPress.
 * Version: 1.0
 * Author: dev-sajjad
 * Author URI: https://github.com/dev-sajjad
 * Text Domain: contacts-manager
 * License: GPLv2 or later
 * 
 */

// Exit if accessed directly.
if (! defined('ABSPATH')) {
    exit;
}

/**
 * Composer autoload.
 */
require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main class for the plugin.
 */
final class Contacts_Manager
{
    /**
     * Plugin version.
     * 
     * @var string
     */
    const version = '1.0';

    private function __construct()
    {
        $this->define_constants();

        register_activation_hook(__FILE__, [$this, 'activate']);

        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    /**
     * Initializes a singleton instance.
     * 
     * @return \Contacts_Manager
     */
    public static function init()
    {
        static $instance = false;

        if (! $instance) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Defines the required plugin constants.
     * 
     * @return void
     */
    public function define_constants()
    {
        define('CONTACTS_MANAGER_VERSION', self::version);
        define('CONTACTS_MANAGER_FILE', __FILE__);
        define('CONTACTS_MANAGER_PATH', __DIR__);
        define('CONTACTS_MANAGER_URL', plugins_url('', CONTACTS_MANAGER_FILE));
        define('CONTACTS_MANAGER_ASSETS', CONTACTS_MANAGER_URL . '/assets');
    }

    /**
     * Initializes the plugin.
     * 
     * @return void
     */
    public function init_plugin()
    {
        new Contacts\Manager\Assets();

        $contacts_controller = new Contacts\Manager\ContactsController();

        if (defined('DOING_AJAX') && DOING_AJAX) {
            new Contacts\Manager\Ajax($contacts_controller);
        } elseif (is_admin()) {
            new Contacts\Manager\Admin();
        } else {
            new Contacts\Manager\Frontend($contacts_controller);
        }
    }

    /**
     * Do stuff upon plugin activation.
     *
     * @return void
     */
    public function activate()
    {
        // plugin activation function
        $installer = new Contacts\Manager\Installer();
        $installer->run();
    }
}

/**
 * Initializes the main plugin.
 * 
 * @return \Contacts_Manager
 */
function contacts_manager()
{
    return Contacts_Manager::init();
}

//kick-off the plugin
contacts_manager();
