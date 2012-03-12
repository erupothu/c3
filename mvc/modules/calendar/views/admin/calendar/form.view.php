
	<div class="clearfix">

		<form method="post" action="<?php echo $this->uri->uri_string(); ?>">
			<fieldset>
				
				<?php if($this->form_validation->has_errors()): ?>
				<div class="row form-errors">
					<?php echo $this->form_validation->errors(); ?>
				</div>
				<?php endif; ?>
				
				<div class="row required<?php $this->form_validation->earmark('calendar_name'); ?>">
					<label for="calendar_name">Name</label>
					<span><input type="text" name="calendar_name" id="calendar_name" value="<?php echo $this->form_validation->value('calendar_name'); ?>" /></span>
				</div>
				
				<div class="row button-row">
					<input type="submit" value="Save" />
				</div>
				
			</fieldset>
	
		</form>

	</div>
