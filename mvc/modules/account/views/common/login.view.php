<?php $this->load->view('common/header.include.php'); ?>

	<h2>Login</h2>

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
				
				<ul>
					<li>Haven't registered yet?  <?php echo anchor('account/register', 'Register an account'); ?></li>
					<li>Cannot remember your password?  <?php echo anchor('account/recover', 'Recover your lost password'); ?> now!</li>
				</ul>
				
			</div>

			<div class="button-row">
				<input type="submit" value="Login">
			</div>
			
		</fieldset>
		
	</form>

<?php $this->load->view('common/footer.include.php'); ?>