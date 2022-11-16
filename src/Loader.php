<?php

namespace CustomerListExport;

use Jenssegers\Blade\Blade as Blade;
use PhpCsv\Generator as Generator;

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
	}

	public function initActions() {
		// Enqueue styles and scripts
		add_action('admin_enqueue_scripts', function () {
			if ($_GET['page'] == 'customer-list-export') {
				wp_enqueue_style(
					'customer-export-styles',
					$this->pluginBaseUrl . 'src/resources/css/style.css',
				);

				wp_enqueue_script(
					'customer-export-fancy-table',
					$this->pluginBaseUrl . 'src/resources/js/fancyTable.min.js',
				);

				wp_enqueue_script(
					'customer-export-scripts',
					$this->pluginBaseUrl . 'src/resources/js/script.js',
				);
			}
		});

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

		// Export download
		add_action('init', function () {
			$source = 'billing';
			if ($_GET['source'] == 'shipping') {
				$source = 'shipping';
			}

			if (
				$_GET['page'] == 'customer-list-export' &&
				$_GET['a'] == 'export'
			) {
				$customers = new Customers();
				$customers = $customers->fetchData($source);

				$this->createCSV($customers, $source);
				die();
			}
		});
	}

	public function exportListPage() {
		$blade = $GLOBALS['blade'];

		$source = 'billing';
		if ($_GET['source'] == 'shipping') {
			$source = 'shipping';
		}

		$customers = new Customers();
		$customers = $customers->fetchData($source);

		echo $blade->render('admin.main', [
			'customers' => $customers,
			'source' => $source,
		]);
	}

	private function createCSV($customers, $source) {
		$file_name = "{$source}_customer_export.csv";
		$headers = [
			'First Name',
			'Last Name',
			'Email Address',
			'Address 1',
			'Address 2',
			'City',
			'State',
			'ZIP',
			'Has Subscription',
		];

		$customers = array_map(function ($data) {
			return [
				$data['first_name'],
				$data['last_name'],
				$data['email'],
				$data['address_1'],
				$data['address_2'],
				$data['city'],
				$data['state'],
				$data['zip'],
				$data['has_subscription'],
			];
		}, $customers);

		$object = new Generator();
		$object->setArray($customers, $headers);
		$object->makeCsv();
		$object->exportCsv($file_name, true);
	}
}
