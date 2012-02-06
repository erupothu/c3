<?php $this->load->view('common/header.include.php'); ?>

	<h2><?php echo $this->user->name(); ?>'s Account</h2>
	
	<form method="post" action="<?php echo $this->uri->uri_string(); ?>">
		<fieldset>
		
			<div class="row<?php echo $this->form_validation->earmark('user_name'); ?>">
				<label for="user_name">Name</label>
				<span><input type="text" name="user_name" id="user_name" value="<?php echo $this->form_validation->value('user_name', $this->user->name()); ?>"></span>
			</div>
			
			<div class="row<?php echo $this->form_validation->earmark('user_company'); ?>">
				<label for="user_company">Company</label>
				<span><input type="text" name="user_company" id="user_company" value="<?php echo $this->form_validation->value('user_company'); ?>"></span>
			</div>
			
			<div class="row<?php echo $this->form_validation->earmark('user_telephone'); ?>">
				<label for="user_telephone">Telephone</label>
				<span><input type="text" name="user_telephone" id="user_telephone" value="<?php echo $this->form_validation->value('user_telephone'); ?>"></span>
			</div>
			
			
			<div class="row">
				
				<input type="checkbox" name="user_marketing" id="user_marketing" value="0"<?php echo $this->form_validation->checked('user_marketing', '0'); ?>>
				<label for="user_marketing">
					Anubis are always developing new courses and new technologies, please 
					tick here if you don't wish to be informed of future developments.
					<span>(Please Note: Your details will be held by Anubis Associates ltd and will not be shared with any other organisation)</span>
				</label>
				
			</div>
			
			
			<div class="row<?php echo $this->form_validation->earmark('user_password'); ?>">
				<label for="user_password">Confirm Password</label>
				<span><input type="text" name="user_password" id="user_password" value="<?php echo $this->form_validation->value('user_password'); ?>"></span>
				<span class="description">
					In order to update your account details please provide us with your password.
				</span>
			</div>
			
			<div class="row button-row">
				<input type="submit" value="Update Account">
			</div>
			
		</fieldset>
	</form>
	
<?php $this->load->view('common/footer.include.php'); ?>