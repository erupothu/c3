
	
	<div class="clearfix">
		
		<form method="post" action="<?php echo $this->uri->uri_string(); ?>">
			<fieldset>
				
				<?php if($this->form_validation->has_errors()): ?>
				<div class="row form-errors">
					<?php echo $this->form_validation->errors(); ?>
				</div>
				<?php endif; ?>
				
				<?php if(isset($news)): ?>
				<input type="hidden" name="news_id" id="news_id" value="<?php echo $news->id(); ?>" />
				<?php endif; ?>
				
				<div class="row required<?php $this->form_validation->earmark('news_title'); ?>">
					<label for="news_title">Title</label>
					<span><input type="text" name="news_title" id="news_title" class="slug_title" value="<?php echo $this->form_validation->value('news_title', isset($news) ? $news->title() : ''); ?>" data-slug-generate="news_slug" data-slug-module="news"></span>
				</div>
				
				<div class="row required<?php $this->form_validation->earmark('news_slug'); ?>">
					<label for="news_slug">Permalink</label>
					<span><input type="text" name="news_slug" id="news_slug" value="<?php echo $this->form_validation->value('news_slug', isset($news) ? $news->permalink(false) : ''); ?>"></span>
				</div>
				
				<div class="row required<?php $this->form_validation->earmark('news_category_id'); ?>">
					<label for="news_category_id">Category</label>
					<span><select name="news_category_id[]" id="news_category_id">
						<option value="">Uncategorised</option>
						<?php foreach($news_categories as $news_category): ?>
						<option value="<?php echo $news_category->id(); ?>"<?php echo $this->form_validation->selected('news_category_id[]', $news_category->id(), $news->categories()->count() > 0 ? $news->categories()->current()->id() : 0); ?>><?php echo $news_category->title(); ?></option>
						<?php endforeach; ?>
					</select>
					</span>
				</div>
				
				<div class="row required<?php $this->form_validation->earmark('news_date_published'); ?>">
					<label for="news_date_published">Publish Date</label>
					<span>
						<input type="text" class="date-picker" name="news_date_published" id="news_date_published" value="<?php echo $this->form_validation->value('news_date_published', isset($news) ? $news->published(false)->format('Y-m-d') : date('Y-m-d')); ?>">
						<input type="text" style="width: 40px;" name="news_date_published_h" id="news_date_published_h" value="<?php echo $this->form_validation->value('news_date_published_h', isset($news) ? $news->published(false)->format('H') : date('H')); ?>">:
						<input type="text" style="width: 40px;" name="news_date_published_i" id="news_date_published_i" value="<?php echo $this->form_validation->value('news_date_published_i', isset($news) ? $news->published(false)->format('i') : date('i')); ?>">
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