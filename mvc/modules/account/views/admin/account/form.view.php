
		<div class="clearfix">
	
			<form method="post" action="<?php echo $this->uri->uri_string(); ?>">
				<fieldset>
			
					<?php if($this->form_validation->has_errors()): ?>
					<div class="row form-errors">
						<?php echo $this->form_validation->errors(); ?>
					</div>
					<?php endif; ?>
	
					<div class="row required<?php $this->form_validation->earmark('user_email'); ?>">				
						<label for="user_email">Email Address</label>
						<span><input type="text" name="user_email" id="user_email" value="<?php echo $this->form_validation->value('user_email', !isset($account) ? '' : $account->email()); ?>" /></span>
					</div>
	
					<div class="row button-row">
						<input type="submit" value="Save" />
					</div>
			
				</fieldset>
		
			</form>
	
		</div>
