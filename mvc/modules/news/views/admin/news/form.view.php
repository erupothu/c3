
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
				
				<div class="row required ck-default<?php $this->form_validation->earmark('news_data_full'); ?>">
					<label for="news_data_full">Content</label>
					<textarea name="news_data_full" id="news_data_full" rows="4" cols="40"><?php echo $this->form_validation->value('news_data_full', $news->get('news_data_full'), false); ?></textarea>
				</div>
				
				<div class="row button-row">
					<input type="submit" value="Save" />
				</div>
				
			</fieldset>
		</form>
		
	</div>