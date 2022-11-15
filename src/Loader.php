<?php

namespace CustomerListExport;

use Jenssegers\Blade\Blade as Blade;

use CustomerListExport\Customers as Customers;
class Loader {
	protected $version;

	public $pluginBaseDir = null;
	public $pluginBaseUrl = null;
	public $dotenv = null;

	public function __construct($pluginBaseDir, $pluginBaseUrl) {
		$this->pluginBaseDir = $pluginBaseDir;
		$this->pluginBaseUrl = $pluginBaseUrl;
		$this->version = '1.0.0';
	}

	public static function initBladeViews() {
		$views = __DIR__ . '/resources/pages';
		$cache = __DIR__ . '/cache';

		return new Blade($views, $cache);
	}

	public function init() {
		$this->initActions();
		$this->initFilters();
	}

	public function initActions() {
		// Add the page to Wordpress
		add_action('admin_menu', function () {
			add_submenu_page(
				'woocommerce-marketing',
				'Customer List Export for Woocommerce',
				'Customer List Export',
				'view_woocommerce_reports',
				'customer-list-export',
				[$this, 'exportListPage'],
			);
		});
	}

	public function initFilters() {
		//
	}

	public function exportListPage() {
		$blade = $GLOBALS['blade'];

		$source = !empty($_GET['source'])
			? sanitize_key($_GET['source'])
			: 'billing';

		$action = !empty($_GET['a']) ? sanitize_key($_GET['a']) : false;

		$customers = new Customers();
		$customers = $customers->fetchData($source);

		if ($action == 'export') {
			//
		}

		echo $blade->render('admin.main', [
			'customers' => $customers,
			'source' => $source,
		]);
	}
}
