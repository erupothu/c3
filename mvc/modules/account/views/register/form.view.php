<?php $this->load->view('common/header.include.php'); ?>

	<h2>Register an Account</h2>

	<form method="post" action="<?php echo $this->uri->uri_string(); ?>">
		
		<?php if($this->form_validation->has_errors()): ?>
		<div class="row form-errors">
			<?php echo $this->form_validation->errors(); ?>
		</div>
		<?php endif; ?>
		
		<fieldset>
			
			<div class="row required<?php echo $this->form_validation->earmark('account_email'); ?>">
				<label for="account_email">Email Address</label>
				<span><input type="text" name="account_email" id="account_email" value="<?php echo $this->form_validation->value('account_email'); ?>"></span>
			</div>
			
			<div class="row required<?php echo $this->form_validation->earmark('account_password'); ?>">
				<label for="account_password">Choose Password</label>
				<span><input type="password" name="account_password" id="account_password" value="<?php echo $this->form_validation->value('account_password'); ?>"></span>
			</div>
			
			<div class="row required<?php echo $this->form_validation->earmark('account_password_confirm'); ?>">
				<label for="account_password_confirm">Confirm Password</label>
				<span><input type="password" name="account_password_confirm" id="account_password_confirm" value="<?php echo $this->form_validation->value('account_password_confirm'); ?>"></span>
			</div>
			
		</fieldset>
		
		<fieldset>
			
			<div class="row required<?php echo $this->form_validation->earmark('account_name'); ?>">
				<label for="account_name">Name</label>
				<span><input type="text" name="account_name" id="account_name" value="<?php echo $this->form_validation->value('account_name'); ?>"></span>
			</div>
			
			<div class="row required<?php echo $this->form_validation->earmark('account_organisation'); ?>">
				<label for="">Organisation/Government/Defence Department</label>
				<span><input type="text" name="account_organisation" id="account_organisation" value="<?php echo $this->form_validation->value('account_organisation'); ?>"></span>
			</div>
			
			<div class="row<?php echo $this->form_validation->earmark('account_unit'); ?>">
				<label for="account_unit">Unit</label>
				<span><input type="text" name="account_unit" id="account_unit" value="<?php echo $this->form_validation->value('account_unit'); ?>"></span>
			</div>

			<div class="row required<?php echo $this->form_validation->earmark('account_country'); ?>">
				<label for="account_country">Country</label>
				<span><select name="account_country" id="account_country">
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
			
			<div class="row<?php echo $this->form_validation->earmark('account_telephone'); ?>">
				<label for="account_telephone">Telephone</label>
				<span><input type="text" name="account_telephone" id="account_telephone" value="<?php echo $this->form_validation->value('account_telephone'); ?>"></span>
			</div>
			
		</fieldset>
		
		<div class="two-col">
			
			<?php foreach(array('Billing', 'Delivery') as $_x): ?>
			<fieldset>
			
				<legend><?php echo $_x; ?> Address</legend>
				
				<?php if($_x == 'Delivery'): ?>
				<div class="row">

					<input type="checkbox" name="account_delivery_same" id="account_delivery_same" value="1"<?php echo $this->form_validation->checked('account_delivery_same', '1', '1'); ?>>
					<label for="account_delivery_same">
						Deliver to my billing address
					</label>

				</div>
				<?php endif; ?>
				
				<div class="row">
					<label for="">Town/City</label>
					<span><input type="text" name="" id="" value=""></span>
				</div>
			
				<div class="row">
					<label for="">County</label>
					<span><input type="text" name="" id="" value=""></span>
				</div>
			
				<div class="row">
					<label for="">Postcode</label>
					<span><input type="text" name="" id="" value=""></span>
				</div>
			
				<div class="row">
					<label for="">Country</label>
					<span><input type="text" name="" id="" value=""></span>
				</div>
			
			</fieldset>
			<?php endforeach; ?>
		
		</div>
		
		<fieldset>
		
			<div class="row">
				
				<input type="checkbox" name="account_marketing" id="account_marketing" value="0"<?php echo $this->form_validation->checked('account_marketing', '0'); ?>>
				<label for="account_marketing">
					XXX are always developing new courses and new technologies, please 
					tick here if you don't wish to be informed of future developments.
					<span>(Please Note: Your details will be held by XXX and will not be shared with any other organisation)</span>
				</label>
				
			</div>
			
			<div class="button-row">
				<input type="submit" value="Register">
			</div>
			
		</fieldset>
		
	</form>

<?php $this->load->view('common/footer.include.php'); ?>