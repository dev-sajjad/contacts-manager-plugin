<?php

namespace Contacts\Manager;

/**
 * Installer class, initialized on plugin activation
 */

class Installer
{
    /**
     * Run the installer
     * 
     * @return void
     */
    public function run()
    {
        $this->add_version();
        $this->create_table();
        $this->updateDefaultOptions();
    }

    /**
     * Add the plugin version to option database
     * 
     * @return void
     */
    public function add_version()
    {
        $installed = get_option('contacts_manager_installed');

        if (! $installed) {
            update_option('contacts_manager_installed', time());
        }

        update_option('contacts_manager_version', CONTACTS_MANAGER_VERSION);
    }

    /**
     * Create the database table(s) used by the plugin
     * 
     * @return void
     */
    public function create_table()
    {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        $create_table_query = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}contacts_manager_table` (
            `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `name` varchar(32) NOT NULL,
            `email` varchar(255) NOT NULL,
            `phone` varchar(20) NOT NULL,
            `address` varchar(255) NOT NULL,
            `created_at` timestamp NOT NULL,
            `updated_at` timestamp NOT NULL
        ) $charset_collate;";

        if (!function_exists('dbDelta')) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }
        dbDelta($create_table_query);
    }

    /**
     * Initialize the default option values for the plugin options
     */
    public function updateDefaultOptions(): void
    {
        if (false == get_option("contacts_manager_table_limit"))
            update_option("contacts_manager_table_limit", 10);
        if (false == get_option("contacts_manager_table_order_by"))
            update_option("contacts_manager_table_order_by", "id");
        if (false == get_option("contacts_manager_background_color"))
            update_option("contacts_manager_background_color", "#FFFFFF");
    }
}
