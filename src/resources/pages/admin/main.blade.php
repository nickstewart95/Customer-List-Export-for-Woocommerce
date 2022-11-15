<div class="wrap">
	<div style="display: flex; justify-content: space-between; align-items: center;">
		<h3>Customer List Export for Woocommerce</h3>
		<a href="{{ admin_url() }}admin.php?page=customer-list-export&source={{ $source }}&a=export" class="button button-primary button-large">Export to CSV</a>
	</div>
	<p>This plugin pulls all orders from WooCommerce and then builds out the meta data to create the customer list. The filter works by either creating a hash of the billing or shipping last name and address (address_1 and city) and then removing any duplicates.</p>
	<p>Created by <a href="https://nickstewart.me/" target="_blank">Nick Stewart</a></p>
	<hr />
	<ul class="subsubsub">
		<li>Filter By:</li>
		<li><a href="{{ admin_url() }}admin.php?page=customer-list-export&source=billing">Billing</a></li>
		<li><a href="{{ admin_url() }}admin.php?page=customer-list-export&source=shipping">Shipping</a></li>
	</ul>
	<p style="clear: both;"><strong>{{ count($customers) }}</strong> results, using {{ $source }} information.</p>
	<table class="wp-list-table widefat fixed striped table-view-list">
		<thead>
			<tr>
				<th scope="col" id="first_name" class="manage-column column-type">First Name</th>
				<th scope="col" id="last_name" class="manage-column column-type">Last Name</th>
				<th scope="col" id="address_1" class="manage-column column-type">Address 1</th>
				<th scope="col" id="address_2" class="manage-column column-type">Address 2</th>
				<th scope="col" id="city" class="manage-column column-type">City</th>
				<th scope="col" id="state" class="manage-column column-type">State</th>
				<th scope="col" id="zip" class="manage-column column-type">ZIP</th>
			</tr>
		</thead>
		<tbody>
			@foreach($customers as $customer)
			<tr>
					<td>{{ $customer['first_name'] }}</td>
					<td>{{ $customer['last_name'] }}</td>
					<td>{{ $customer['address_1'] }}</td>
					<td>{{ $customer['address_2'] }}</td>
					<td>{{ $customer['city'] }}</td>
					<td>{{ $customer['state'] }}</td>
					<td>{{ $customer['zip'] }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>