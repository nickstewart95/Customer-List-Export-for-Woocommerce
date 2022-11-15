<?php

namespace CustomerListExport;

class Customers {
	public $wpdb;

	public function __construct() {
		$this->wpdb = $GLOBALS['wpdb'];
	}

	public function fetchData($source = 'billing') {
		// Grab all the meta values
		$this->wpdb->query('SET SESSION group_concat_max_len = 10000');

		$query = " SELECT p.*, 
			GROUP_CONCAT(pm.meta_key ORDER BY pm.meta_key DESC SEPARATOR '||') as meta_keys, 
			GROUP_CONCAT(pm.meta_value ORDER BY pm.meta_key DESC SEPARATOR '||') as meta_values 
			FROM {$this->wpdb->posts} p 
			LEFT JOIN {$this->wpdb->postmeta} pm on pm.post_id = p.ID 
			WHERE p.post_type = 'shop_order'
			GROUP BY p.ID";

		$customers = $this->wpdb->get_results($query);

		$customers = array_map(function ($a) use ($source) {
			// Pull out the meta values
			$data = array_combine(
				explode('||', $a->meta_keys),
				array_map('maybe_unserialize', explode('||', $a->meta_values)),
			);

			// Set the fields we want
			if ($source == 'billing') {
				$data['first_name'] = $data['_billing_first_name'];
				$data['last_name'] = $data['_billing_last_name'];
				$data['address_1'] = $data['_billing_address_1'];
				$data['address_2'] = $data['_billing_address_2'];
				$data['city'] = $data['_billing_city'];
				$data['state'] = $data['_billing_state'];
				$data['zip'] = $data['_billing_postcode'];
			} else {
				$data['first_name'] = $data['_shipping_first_name'];
				$data['last_name'] = $data['_shipping_last_name'];
				$data['address_1'] = $data['_shipping_address_1'];
				$data['address_2'] = $data['_shipping_address_2'];
				$data['city'] = $data['_shipping_city'];
				$data['state'] = $data['_shipping_state'];
				$data['zip'] = $data['_shipping_postcode'];
			}

			// Create a hash for easy compare
			$hash = $data['last_name'] . $data['address_1'] . $data['city'];
			$hash = md5(strtolower($hash));
			$data['hash'] = $hash;

			return $data;
		}, $customers);

		// Remove duplicates
		$processed = [];
		$customers = array_filter($customers, function ($data) use (
			&$processed
		) {
			if (!in_array($data['hash'], $processed)) {
				$processed[] = $data['hash'];
				return true;
			} else {
				return false;
			}
		});

		return $customers;
	}
}
