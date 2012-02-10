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
				<?php if($this->cart->size() > 0): ?>
				<tfoot>
					<tr class="sub-total">
						<td colspan="5">Sub-Total</td>
						<td class="tax money"><?php echo $this->cart->total(false); ?></td>
					</tr>
					<tr class="tax-total">
						<td colspan="5">VAT @ 20%</td>
						<td class="tax money"><?php echo $this->cart->tax(); ?></td>
					</tr>
					<tr class="grand-total">
						<td colspan="5">Total <span>(excluding delivery charge)</span></td>
						<td class="total money"><?php echo $this->cart->total(); ?></td>
					</tr>
				</tfoot>
				<?php endif; ?>
				<tbody>
					<?php foreach($this->cart->contents() as $item): ?>
					<tr>
						<td class="item">
							<a class="thumbnail right" href="#">
								<img src="/uploads/product_thumb.jpg" alt="<?php echo $item->name(); ?>" style="display: block; width: 50px; height: 50px;">
							</a>
						</td>
						<td class="description">
							<a href="/cart/remove/<?php echo $item->hash(); ?>">[Remove]</a>
							<?php echo anchor($item->permalink(), $item->name()); ?>
							<span><?php echo '&nbsp;'; //$item->description(); ?></span>
						</td>
						<td class="code"><?php echo $item->code(); ?></td>
						<td class="quantity"><?php echo $item->quantity(); ?></td>
						<td class="price money"><?php echo $item->price(); ?></td>
						<td class="total money"><?php echo $item->total(false); ?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			
		</div>
		
		<?php if($this->cart->size() > 0): ?>
		<div class="buttons clearfix">
			<div style="float: right; margin-bottom: 16px;">
				<a href="/cart/update" class="button grey" style="float: left;">Update<span></span></a>
				<a href="/cart/empty" class="button grey" style="float: left; margin-left: 8px;">Empty Basket<span></span></a>
				<a href="/cart/checkout" class="button orange" style="float: left; margin-left: 8px;">Proceed<span></span></a>
			</div>
		</div>
		<?php endif; ?>
		
<?php $this->load->view('common/footer.include.php'); ?>