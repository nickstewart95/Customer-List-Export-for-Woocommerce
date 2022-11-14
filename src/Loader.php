<?php

namespace CustomerListExport;

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

	public function init() {
		$this->initActions();
		$this->initFilters();
	}

	public function initActions() {
		//
	}

	public function initFilters() {
		//
	}
}
