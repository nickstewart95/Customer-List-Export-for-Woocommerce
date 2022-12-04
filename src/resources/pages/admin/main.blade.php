<div class="customer-list-export-plugin wrap">
	<div style="display: flex; justify-content: space-between; align-items: center;">
		<h3>Customer List Export for Woocommerce</h3>
		<a href="{{ admin_url() }}admin.php?page=customer-list-export&source={{ $source }}&a=export" class="button button-primary button-large">Export to CSV</a>
	</div>
	<p>This plugin pulls all orders from WooCommerce and then builds out the meta data to create the customer list. The filter works by either creating a hash of the billing or shipping last name and address (address_1 and city) and then removing any duplicates.</p>
	<p>Created by <a href="https://nickstewart.me/" target="_blank">Nick Stewart</a></p>
	<hr />
	<ul class="subsubsub {{ $source }}-active">
		<li>Filter By:</li>
		<li><a href="{{ admin_url() }}admin.php?page=customer-list-export&source=billing" class="billing">Billing</a></li>
		<li><a href="{{ admin_url() }}admin.php?page=customer-list-export&source=shipping" class="shipping">Shipping</a></li>
	</ul>
	<p style="clear: both;"><strong>{{ count($customers) }}</strong> results, using {{ $source }} information.</p>
	<table class="wp-list-table widefat fixed striped table-view-list customer-list-export-table">
		<thead>
			<tr>
				<th scope="col" id="first_name" class="manage-column column-type" data-sortas="case-insensitive">First Name</th>
				<th scope="col" id="last_name" class="manage-column column-type" data-sortas="case-insensitive">Last Name</th>
				<th scope="col" id="email" class="manage-column column-type" data-sortas="case-insensitive">Email</th>
				<th scope="col" id="address_1" class="manage-column column-type" data-sortas="case-insensitive">Address 1</th>
				<th scope="col" id="address_2" class="manage-column column-type" data-sortas="case-insensitive">Address 2</th>
				<th scope="col" id="city" class="manage-column column-type" data-sortas="case-insensitive">City</th>
				<th scope="col" id="state" class="manage-column column-type" data-sortas="case-insensitive">State</th>
				<th scope="col" id="zip" class="manage-column column-type" data-sortas="numeric">ZIP</th>
				<th scope="col" id="subscription" class="manage-column column-type" data-sortas="case-insensitive">Subscription?</th>
			</tr>
		</thead>
		<tbody>
			@foreach($customers as $customer)
			<tr>
					<td>{{ $customer['first_name'] }}</td>
					<td>{{ $customer['last_name'] }}</td>
					<td>{{ $customer['email'] }}</td>
					<td>{{ $customer['address_1'] }}</td>
					<td>{{ $customer['address_2'] }}</td>
					<td>{{ $customer['city'] }}</td>
					<td>{{ $customer['state'] }}</td>
					<td>{{ $customer['zip'] }}</td>
					<td>{{ $customer['has_subscription'] }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>