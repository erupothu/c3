<?php $this->load->view('common/header.include.php'); ?>

		<h2>Cart</h2>
		
		<?php if(false !== $this->session->flashdata('core/message', false)): ?>
		<div class="flash-message">
			<?php echo $this->session->flashdata('core/message'); ?>
			<a class="icon-close" href="javascript:;">x</a>
		</div>
		<?php endif; ?>
		
		<!-- Cart -->
		<div class="cart-container box">
			
			<table id="cart">
				<colgroup>
					<col style="width: 50px;" />
					<col />
					<col />
					<col />
					<col />
					<col />
				</colgroup>
				<thead>
					<tr>
						<th>Item</th>
						<th>Item Description</th>
						<th>Code</th>
						<th>Quantity</th>
						<th>Price</th>
						<th>Total</th>
					</tr>
				</thead>
				<tfoot>
					<tr class="sub-total">
						<td colspan="5">Total <span>(excluding delivery charge)</span></td>
						<td class="total money"><?php echo $this->cart->total(); ?></td>
					</tr>
				</tfoot>
				<tbody>
					<?php foreach($this->cart->contents() as $hash => $item): ?>
					<tr>
						<td class="item">
							<a class="thumbnail right" href="#">
								<img src="/uploads/product_thumb.jpg" alt="Product Title" style="display: block; width: 50px; height: 50px;">
							</a>
						</td>
						<td class="description">
							<a href="/cart/remove/<?php echo $hash; ?>">x</a>
							<a href="#">Example Product</a>
						</td>
						<td class="code">02345</td>
						<td class="quantity"><?php echo $item['quantity']; ?></td>
						<td class="price money">199.99</td>
						<td class="total money">199.99</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			
		</div>
		
		<?php if($this->cart->size() > 0): ?>
		<div class="buttons" style="float: right; margin-bottom: 16px;">
			<a href="/cart/update" class="button grey" style="float: left;">Update<span></span></a>
			<a href="/cart/empty" class="button grey" style="float: left; margin-left: 8px;">Empty Basket<span></span></a>
			<a href="/cart/checkout" class="button orange" style="float: left; margin-left: 8px;">Proceed<span></span></a>
		</div>
		<?php endif; ?>
		
<?php $this->load->view('common/footer.include.php'); ?>