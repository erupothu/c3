<?php $this->load->view('common/header.include.php'); ?>

		<h2>Checkout</h2>
		
		<?php if(false !== $this->session->flashdata('core/message', false)): ?>
		<div class="flash-message">
			<?php echo $this->session->flashdata('core/message'); ?>
			<a class="icon-close" href="javascript:;">x</a>
		</div>
		<?php endif; ?>
		
		<form method="post" action="<?php echo $this->uri->uri_string(); ?>">
			
			<?php if($this->form_validation->has_errors()): ?>
			<div class="row form-errors">
				<?php echo $this->form_validation->errors(); ?>
			</div>
			<?php endif; ?>
			
			<?php if($this->user->authenticated()): ?>
			
				<div class="row">
					<label for="billing_address_id">Billing Address</label>
					<span><select name="billing_address_id" id="billing_address_id">
						<?php foreach($addresses as $address): ?>
						<option value="<?php echo $address->id(); ?>"><?php echo $address->label(); ?> (<?php echo $address->line1() . ', ' . $address->city(); ?>)</option>
						<?php endforeach; ?>
					</select></span>
				</div>
			
			<div class="row">
				<label for="delivery_address_id">Delivery Address</label>
				<span><select name="delivery_address_id" id="delivery_address_id">
					<?php foreach($addresses as $address): ?>
					<option value="<?php echo $address->id(); ?>"><?php echo $address->label(); ?> (<?php echo $address->line1() . ', ' . $address->city(); ?>)</option>
					<?php endforeach; ?>
				</select></span>
			</div>
			
			<?php else: ?>
			
			<fieldset>
				
				<div class="row<?php echo $this->form_validation->earmark('checkout_name'); ?>">
					<label for="checkout_name">Name</label>
					<span><input type="text" name="checkout_name" id="checkout_name" value="<?php echo $this->form_validation->value('checkout_name'); ?>"></span>
				</div>
			
				<div class="row<?php echo $this->form_validation->earmark('checkout_email'); ?>">
					<label for="checkout_email">Email</label>
					<span><input type="text" name="checkout_email" id="checkout_email" value="<?php echo $this->form_validation->value('checkout_email'); ?>"></span>
				</div>
				
			</fieldset>
			
			<fieldset class="addresses">
				<?php echo Modules::run('account/address/render', 'delivery', 'Delivery Address'); ?>
				<?php echo Modules::run('account/address/render', 'billing', 'Billing Address'); ?>
			</fieldset>
			
			<?php endif; ?>
			
			<div class="buttons row">
				<input type="submit" class="button" value="Checkout">
			</div>
			
		</form>
	
<?php $this->load->view('common/footer.include.php'); ?>