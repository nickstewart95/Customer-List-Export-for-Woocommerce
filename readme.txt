=== Customer List Export for Woocommerce ===
Author: Nick Stewart
Author URI: https://nickstewart.me
Tags: customer, export, woocommerce, address
Requires at least: 5.3
Tested up to: 6.1.1
Stable tag: 1.1.1
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Export a customer list with addresses from WooCommerce

== Description ==

Customer List Export for WooCommerce allows you to export a CSV of customer data (name/address/if has subscription). In the front, the columns are sortable and there is a live search feature.

== Frequently Asked Questions ==

= How do I get to this plugin in WP-Admin? =

It is located in the Marketing tab of the WooCommerce group of tabs in the admin.

= What file format does the plugin export? =

A CSV file.

= Can the data be filtered? =

The data can be filtered by billing address or shipping address.

= How are duplicates accounted for? =

A hash is created with either the billing or shipping address so only one hash can appear in the results. Address ssuffixes are also normalized to prevent duplicates.

= Where does the subscription column come from? =

The plugin pulls a list of active subscribers using the WooCommerce Subscriptions plugin and compares it with the order user id.

== Screenshots ==

screenshot-1.png

== Changelog ==

= 1.1 =

- Plugin branding

= 1.0 =

- The plugin creation
