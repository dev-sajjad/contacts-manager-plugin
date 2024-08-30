<?php

namespace Contacts\Manager\Admin;

/**
 * The Menu handler class.
 */
class Menu
{
    /**
     * Initializes the Menu class.
     */
    public function __construct()
    {
        add_action('admin_menu', [$this, 'admin_menu']);
    }

    /**
     * Registers the admin menu.
     */
    public function admin_menu()
    {
        add_menu_page(
            __('Contacts Manager', 'contacts-manager'),
            __('Contacts Manager', 'contacts-manager'),
            'manage_options',
            'contacts-manager',
            [$this, 'vueAppEntrypoint'],
            'dashicons-id-alt',
            25
        );
        add_submenu_page(
            'contacts-manager',
            __('Contacts Manager Settings', 'contacts-manager'),
            __('Settings', 'contacts-manager'),
            'manage_options',
            'contacts-manager#/settings',
            [$this, 'vueAppEntrypoint']
        );
    }

    /**
     * Creates an entrypoint for the Vue.js app
     */
    public function vueAppEntrypoint(): void
    {
?>
        <div id="app"></div>
<?php

        wp_enqueue_script('admin-vue-app');
    }
}
