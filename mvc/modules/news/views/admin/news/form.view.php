
	
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
					<span><input type="text" name="news_title" id="news_title" value="<?php echo $this->form_validation->value('news_title', isset($news) ? $news->title() : ''); ?>"></span>
				</div>
				
				<div class="row required<?php $this->form_validation->earmark('news_date_published'); ?>">
					
					<label for="news_date_published">Publish Date</label>
					<span>
						<input type="text" class="date-picker" name="news_date_published" id="news_date_published" value="<?php echo $this->form_validation->value('news_date_published', isset($news) ? $news->published(false)->format('Y-m-d') : date('Y-m-d')); ?>">
						<input type="text" style="width: 40px;" value="<?php echo $this->form_validation->value('news_date_published_h', date('H')); ?>">:
						<input type="text" style="width: 40px;" value="<?php echo $this->form_validation->value('news_date_published_i', date('i')); ?>">
						<a href="#" class="icon icon-calendar date-picker-icon" title="Select Date" style="display: inline-block;">Select Date</a>
					</span>
				</div>
				
				<div class="row required ck-default<?php $this->form_validation->earmark('news_data_full'); ?>">
					<label for="news_data_full">Content</label>
					<textarea name="news_data_full" id="news_data_full" rows="4" cols="40"><?php echo $this->form_validation->value('news_data_full', isset($news) ? $news->content(false) : ''); ?></textarea>
				</div>
				
				<div class="row button-row">
					<input type="submit" value="Save" />
				</div>
				
			</fieldset>
		</form>
		
	</div>