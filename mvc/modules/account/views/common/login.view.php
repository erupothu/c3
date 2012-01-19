<?php $this->load->view('common/header.include.php'); ?>

	<h2>Login to Anubis</h2>

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
				<label for="account_password">Password</label>
				<span><input type="password" name="account_password" id="account_password" value="<?php echo $this->form_validation->value('account_password'); ?>"></span>
			</div>
			
			<div>
				<?php echo anchor('account/recover', 'Lost Password'); ?>
			</div>

			<div class="button-row">
				<input type="submit" value="Login">
			</div>
			
		</fieldset>
		
	</form>

<?php $this->load->view('common/footer.include.php'); ?>