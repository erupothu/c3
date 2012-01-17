<?php $this->load->view('common/header.include.php'); ?>

	<h2>Register an Account</h2>

	<form method="post" action="<?php echo $this->uri->uri_string(); ?>">
		
		<?php if($this->form_validation->has_errors()): ?>
		<div class="row form-errors">
			<?php echo $this->form_validation->errors(); ?>
		</div>
		<?php endif; ?>
		
		<fieldset>
			
			<div class="row required">
				<label for="">Email Address</label>
				<span><input type="text" name="" id="" value=""></span>
			</div>
			
			<div class="row required">
				<label for="">Choose Password</label>
				<span><input type="password" name="" id="" value=""></span>
			</div>
			
			<div class="row required">
				<label for="">Confirm Password</label>
				<span><input type="password" name="" id="" value=""></span>
			</div>
			
		</fieldset>
		
		
		
		<fieldset>
			
			<div class="row required">
				<label for="">Name</label>
				<span><input type="text" name="" id="" value=""></span>
			</div>
			
			<div class="row required">
				<label for="">Organisation/Government/Defence Department</label>
				<span><input type="text" name="" id="" value=""></span>
			</div>
			
			<div class="row">
				<label for="">Unit</label>
				<span><input type="text" name="" id="" value=""></span>
			</div>
			
			<div class="row required">
				<label for="">Country</label>
				<span><select name="" id="">
					<option value="">Select Country</option>
				</select></span>
			</div>
			
			<div class="row">
				<label for="">Telephone</label>
				<span><input type="text" name="" id="" value=""></span>
			</div>
			
		</fieldset>
		
		<div class="two-col">
			
			<?php foreach(array('Billing', 'Delivery') as $_x): ?>
			<fieldset>
			
				<legend><?php echo $_x; ?> Address</legend>
			
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
				
				<input type="checkbox" name="" id="" value="1">
				<label for="">
					Anubis are always developing new courses and new technologies, please 
					tick here if you don't wish to be informed of future developments.
					<span>(Please Note: Your details will be held by Anubis Associates ltd and will not be shared with any other organisation)</span>
				</label>
				
			</div>
			
			<div class="button-row">
				<input type="submit" value="Register">
			</div>
			
		</fieldset>
		
	</form>

<?php $this->load->view('common/footer.include.php'); ?>