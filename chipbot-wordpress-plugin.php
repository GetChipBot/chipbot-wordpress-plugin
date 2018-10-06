<?php
/*
Plugin Name: ChipBot
Plugin URI: https://getchipbot.com/product?utm_source=wordpress&utm_medium=plugin-link
description: ChipBot analyzes your customer's behavior while giving them support and engagement. Fully Automated.
Author: GetChipBot.com
Author URI: https://getchipbot.com?utm_source=wordpress&utm_medium=author-link
Version: 1.0.1
*/

class ChipBotWordpressPlugin
{
    public function __construct()
    {
        add_action('admin_menu', array($this, 'create_plugin_settings_page'));
        add_action('admin_init', array($this, 'init'));
        add_action('wp_head', array($this, 'script'));
    }

    public function script() {
        $aid = get_option('chipbot_account_id');

        if (trim($aid) !== '') {
            echo '<script src="https://static.getchipbot.com/edge/p/chipbot.js?id=' . get_option('chipbot_account_id') . '" async></script>';
        }
    }

    public function init()
    {
        register_setting('settings_group', 'chipbot_account_id');
    }

    public function create_plugin_settings_page()
    {
        $page_title = 'ChipBot Settings';
        $menu_title = 'ChipBot';
        $capability = 'manage_options';
        $slug = 'getchipbot-com';
        $callback = array($this, 'plugin_settings_page_content');
        $icon = 'https://static.getchipbot.com/shared/images/cb-square-logo-dark-rounded-16px.svg';
        $position = 100;

        add_menu_page($page_title, $menu_title, $capability, $slug, $callback, $icon, $position);
    }

    public function plugin_settings_page_content()
    {
        include(plugin_dir_path(__FILE__) . '/settings.php');
    }
}

new ChipBotWordpressPlugin();