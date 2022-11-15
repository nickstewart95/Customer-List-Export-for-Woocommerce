=== Customer List Export for Woocommerce ===
Author: Nick Stewart
Author URI: https://nickstewart.me
Tags: customer, export, woocommerce, address
Requires at least: 5.3
Tested up to: 6.0
Stable tag: 1.0.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Export a customer list with addresses from WooCommerce

== Description ==

This plugin allows you to export a CSV of customers and their associated addresses, with the ability to filter the export based on order status and address option (billing or shipping).

== Frequently Asked Questions ==

= What format is the export? =

A CSV

= Can you filter the data? =

The data can be filtered by billing address or shipping address

= How are duplicates account for? =

A hash is created with either the billing or shipping address so only one hash can appear in the results. Address ssuffixes are also normalized to prevent duplicates

= Where does the has subscription come from? =

The plugin pulls a list of active subscribers using the WooCommerce Subscriptions plugin and compares it with the order user id.

== Screenshots ==

screenshot-1.png

== Changelog ==

= 1.0 =

- The plugin creation
