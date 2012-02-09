<?php $this->load->view('admin/common/header.include.php'); ?>

		<h2>Orders</h2>
		
		<div class="clearfix">
			
			<div class="left" style="float: left;">
				
				Change this from Products to Order_Products (extend?)
				<table>
					<thead>
						<th>&nbsp;</th>
						<th>Code</th>
						<th>Name</th>
						<th>Price</th>
					</thead>
					<tbody>
						<?php foreach($order->items() as $item): ?>
						<tr>
							<td><?php echo $item->image(); ?></td>
							<td><?php echo $item->code(); ?></td>
							<td><?php echo $item->name(); ?></td>
							<td><?php echo $item->price(); ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			
			<pre><?php //print_r($order); ?></pre>
			</div>
			
			<div style="float: right; width: 305px;">
			
				<h3 style="padding: 0 0 0.5em 0.25em">Delivery Address</h3>
				<div style="width: 265px; background: #fff url(/skins/core/images/test.png) repeat-x top left; box-shadow: 1px 3px 5px #cecece; margin-bottom: 2.5em; border: solid 4px #fff;">
			
					<div style="padding: 22px 12px 8px; line-height: 1.5em;">
						<?php echo $order->delivery_address(); ?>
					</div>
			
				</div>
			
				<form method="post" action="<?php echo $this->uri->uri_string(); ?>">
					<fieldset>
					
						<div class="row">
							<label for="order_status">Order Status</label>
							<span><select name="order_status" id="order_status">
								<option>Processing</option>
								<option>Shipping Delayed</option>
								<option>Shipped</option>
								<option>Completed</option>
							</select></span>
						</div>
					
						<div class="row">
							<label for="order_tracking_date">Expected Shipping Date</label>
							<span><input type="text" class="date-picker" name="order_tracking_date" id="order_tracking_date" value=""></span>
						</div>
					
						<div class="row">
							<label for="order_tracking_code">Tracking Code</label>
							<span><input type="text" name="order_tracking_code" id="order_tracking_code" value="JD0002298912327410"></span>
						</div>
					
						<div class="button-row">
							<input type="submit" value="Update">
						</div>

					</fieldset>
				</form>
			
			</div>
		
		</div>
		
<?php $this->load->view('admin/common/footer.include.php'); ?>