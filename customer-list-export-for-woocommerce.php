<?php
/**
 * @wordpress-plugin
 * Plugin Name: Customer List Export for Woocommerce
 * Description: Export a customer list with addresses from WooCommerce
 * Version: 1.0.0
 * Author: Nick Stewart
 * Author URI: https://nickstewart.me
 */

if (!defined('WPINC')) {
	die();
}

require_once __DIR__ . '/vendor/autoload.php';

use CustomerListExport\Loader;

$plugin = new Loader(__DIR__, plugin_dir_url(__FILE__));
$plugin->init();

$GLOBALS['blade'] = Loader::initBladeViews();
