<?php $this->load->view('admin/common/header.include.php'); ?>

		<h2>Orders</h2>
		
		<div class="clearfix">
			
			<div class="left" style="float: left;">
				
				<h3 style="padding: 0 0 0.5em 0.25em">Order Details</h3>
				
				<table>
					<thead>
						<tr>
							<th>&nbsp;</th>
							<th>Code</th>
							<th>Name</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Tax</th>
							<th>Price Each</th>
							<th>Price Total</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="3">Sub-Total</td>
							<td class="center"><?php echo count($order); ?></td>
							<td class="money right">0.00</td>
							<td class="money right"><?php echo $order->tax(); ?></td>
							<td class="money right">0.00</td>
							<td class="money right">0.00</td>
						</tr>
						<tr>
							<td colspan="7">Shipping?</td>
							<td class="money right">0.00</td>
						</tr>
						<tr>
							<td colspan="7">Total</td>
							<td class="money right"><?php echo $order->total(); ?></td>
						</tr>
						
					</tfoot>
					<tbody>
						<?php foreach($order->items() as $item): ?>
						<tr>
							<td>
								<a class="thumbnail" href="#">
									<img src="/uploads/product_thumb.jpg" alt="Title" style="display: block; width: 32px; height: 32px;">
								</a>
							</td>
							<td><?php echo $item->code(); ?></td>
							<td><?php echo $item->name(); ?></td>
							<td class="center"><?php echo $item->quantity(); ?></td>
							<td class="right"><?php echo $item->price(); ?></td>
							<td class="right"><?php echo $item->tax(); ?></td>
							<td class="right"><?php echo $item->total(); ?></td>
							<td class="right"><?php echo $item->total() * $item->quantity(); ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			

				<h3 style="padding: 0 0 0.5em 0.25em; margin-top: 2.0em;">Transaction Details</h3>
				<pre><?php foreach($order as $i => $k): ?><?php if(false == strstr($i, 'transaction_')) continue; echo $i . ' => ' . $k . PHP_EOL; ?><?php endforeach; ?></pre>
				
				
				<h3 style="padding: 0 0 0.5em 0.25em; margin-top: 2.0em;">Failed Transactions</h3>
				<p>None</p>
				
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
								<?php foreach(array('pending', 'processing', 'shipping delayed', 'completed', 'refunded', 'cancelled') as $status): ?>
								<option value="<?php echo $status; ?>"<?php echo $this->form_validation->selected('order_status', $status, $order->status()); ?>><?php echo ucwords($status); ?></option>
								<?php endforeach; ?>
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