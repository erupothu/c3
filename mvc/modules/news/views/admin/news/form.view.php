
	<div class="clearfix">
		
		<form method="post" action="<?php echo $this->uri->uri_string(); ?>">
			<fieldset>
				
				<?php if($this->form_validation->has_errors()): ?>
				<div class="row form-errors">
					<?php echo $this->form_validation->errors(); ?>
				</div>
				<?php endif; ?>
		
				<div class="row required<?php $this->form_validation->earmark('news_title'); ?>">				
					<label for="news_title">Title</label>
					<span><input type="text" name="news_title" id="news_title" value="<?php echo $this->form_validation->value('news_title', $news->get('news_title'), false); ?>"></span>
				</div>
				
				<div class="row button-row">
					<input type="submit" value="Save" />
				</div>
				
			</fieldset>
		</form>
		
	</div>