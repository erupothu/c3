<?php $this->load->view('common/header.include.php'); ?>

		<h2>Checkout</h2>
		
		
		
		
		
		
		<form method="post" action="<?php echo $this->uri->uri_string(); ?>">
			
			<?php if($this->user->authenticated()): ?>
			
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
				
				<div class="row">
					<label for="">Name</label>
					<span><input type="text" name="" id="" value=""></span>
				</div>
			
				<div class="row">
					<label for="">Email</label>
					<span><input type="text" name="" id="" value=""></span>
				</div>
				
			</fieldset>
			
			<?php endif; ?>
			
			
			
			<fieldset>
				
				<div class="panel delivery-address">
					
					<h3>Delivery Address</h3>
					
					<div class="row">
						<label for="">Name</label>
						<span><input type="text" name="" id="" value=""></span>
					</div>
					
					<div class="row">
						<label for="">Address</label>
						<span><input type="text" name="" id="" value=""></span>
					</div>
				
					<div class="row">
						<label for="">Address 2</label>
						<span><input type="text" name="" id="" value=""></span>
					</div>
				
					<div class="row">
						<label for="">Town/City</label>
						<span><input type="text" name="" id="" value=""></span>
					</div>
				
					<div class="row">
						<label for="">State/County</label>
						<span><input type="text" name="" id="" value=""></span>
					</div>
				
					<div class="row">
						<label for="">ZIP/Postcode</label>
						<span><input type="text" name="" id="" value=""></span>
					</div>
				
					<div class="row required<?php echo $this->form_validation->earmark('account_country'); ?>">
						<label for="account_country">Country</label>
						<span><select name="account_country" id="account_country" style="width: 208px;">
							<option value="">Select Country</option>
							<?php $countries = $this->config->item('alpha-2', 'countries'); if(isset($countries['important']) && count($countries['important']) > 0): ?>
							<option value="">----------------</option>
							<?php foreach($countries['important'] as $iso_code): ?>
							<option value="<?php echo $iso_code; ?>"<?php echo $this->form_validation->selected('account_country', $iso_code); ?>><?php echo htmlentities($countries['countries'][$iso_code], ENT_COMPAT, 'UTF-8', false); ?></option>
							<?php endforeach; endif; ?>
							<option value="">----------------</option>
							<?php foreach($countries['countries'] as $iso_code => $iso_title): ?>
							<option value="<?php echo $iso_code; ?>"<?php echo $this->form_validation->selected('account_country', $iso_code); ?>><?php echo htmlentities($iso_title, ENT_COMPAT, 'UTF-8', false); ?></option>
							<?php endforeach; ?>
						</select></span>
					</div>
				
				</div>
				
			</fieldset>
			
			
			<div>
				<input type="submit" class="button" value="Checkout!">
			</div>
			
		</form>
		
		
		
<?php $this->load->view('common/footer.include.php'); ?>