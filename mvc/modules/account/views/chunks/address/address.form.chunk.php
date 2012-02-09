
		<!-- Render: Address chunk -->
		<div class="panel <?php echo $key; ?>address">
			
			<h3><?php echo $title; ?></h3>
			
			<input type="hidden" name="address_keys[]" value="<?php echo $key; ?>">
			
			<div class="row<?php echo $this->form_validation->earmark($key . 'address_name'); ?>">
				<label for="<?php echo $key; ?>address_name">Name</label>
				<span><input type="text" name="<?php echo $key; ?>address_name" id="<?php echo $key; ?>address_name" value="<?php echo $this->form_validation->value($key . 'address_name'); ?>"></span>
			</div>
			
			<div class="row required<?php echo $this->form_validation->earmark($key . 'address_line1'); ?>">
				<label for="<?php echo $key; ?>address_line1">Address 1</label>
				<span><input type="text" name="<?php echo $key; ?>address_line1" id="<?php echo $key; ?>address_line1" value="<?php echo $this->form_validation->value($key . 'address_line1'); ?>"></span>
			</div>
		
			<div class="row required<?php echo $this->form_validation->earmark($key . 'address_line2'); ?>">
				<label for="<?php echo $key; ?>address_line2">Address 2</label>
				<span><input type="text" name="<?php echo $key; ?>address_line2" id="<?php echo $key; ?>address_line2" value="<?php echo $this->form_validation->value($key . 'address_line2'); ?>"></span>
			</div>
		
			<div class="row required<?php echo $this->form_validation->earmark($key . 'address_city'); ?>">
				<label for="<?php echo $key; ?>address_city">Town/City</label>
				<span><input type="text" name="<?php echo $key; ?>address_city" id="<?php echo $key; ?>address_city" value="<?php echo $this->form_validation->value($key . 'address_city'); ?>"></span>
			</div>
		
			<div class="row<?php echo $this->form_validation->earmark($key . 'address_state'); ?>">
				<label for="<?php echo $key; ?>address_state">State/County</label>
				<span><input type="text" name="<?php echo $key; ?>address_state" id="<?php echo $key; ?>address_state" value="<?php echo $this->form_validation->value($key . 'address_state'); ?>"></span>
			</div>
		
			<div class="row required<?php echo $this->form_validation->earmark($key . 'address_postcode'); ?>">
				<label for="<?php echo $key; ?>address_postcode">ZIP/Postcode</label>
				<span><input type="text" name="<?php echo $key; ?>address_postcode" id="<?php echo $key; ?>address_postcode" value="<?php echo $this->form_validation->value($key . 'address_postcode'); ?>"></span>
			</div>
		
			<div class="row required<?php echo $this->form_validation->earmark($key . 'address_country'); ?>">
				<label for="<?php echo $key; ?>address_country">Country</label>
				<span><select name="<?php echo $key; ?>address_country" id="<?php echo $key; ?>address_country" style="width: 208px;">
					<option value="">Select Country</option>
					<?php $countries = $this->config->item('alpha-2', 'countries'); if(isset($countries['important']) && count($countries['important']) > 0): ?>
					<option value="">----------------</option>
					<?php foreach($countries['important'] as $iso_code): ?>
					<option value="<?php echo $iso_code; ?>"<?php echo $this->form_validation->selected($key . 'address_country', $iso_code); ?>><?php echo htmlentities($countries['countries'][$iso_code], ENT_COMPAT, 'UTF-8', false); ?></option>
					<?php endforeach; endif; ?>
					<option value="">----------------</option>
					<?php foreach($countries['countries'] as $iso_code => $iso_title): ?>
					<option value="<?php echo $iso_code; ?>"<?php echo $this->form_validation->selected($key . 'address_country', $iso_code); ?>><?php echo htmlentities($iso_title, ENT_COMPAT, 'UTF-8', false); ?></option>
					<?php endforeach; ?>
				</select></span>
			</div>
		
		</div>
		<!-- End of render -->