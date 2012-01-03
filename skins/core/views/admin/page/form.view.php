
	<div class="clearfix">
		
		<form method="post" action="<?php echo $this->uri->uri_string(); ?>">
			<fieldset style="float: left;">
				
				<?php if(isset($page['page_id'])): ?>
				<input type="hidden" name="page_id" value="<?php echo $page['page_id']; ?>">
				<?php endif; ?>
				
				<?php if($this->form_validation->has_errors()): ?>
				<div class="row form-errors">
					<?php echo $this->form_validation->errors(); ?>
				</div>
				<?php endif; ?>
		
				<div class="row required<?php $this->form_validation->earmark('page_name'); ?>">				
					<label for="page_name">Title</label>
					<input type="text" name="page_name" id="page_name" value="<?php echo $this->form_validation->value('page_name', !isset($page) ? '' : $page['page_name'], false); ?>" />
				</div>
		
				<div class="row required">
					<label for="page_parent">Parent Page</label>
					<select name="page_parent" id="page_parent">
						<option value="0">&nbsp;</option>
					</select>
				</div>
		
				<div class="row required<?php $this->form_validation->earmark('page_slug'); ?>">
					<label for="page_slug">Slug/Permalink</label>
					<input type="text" name="page_slug" id="page_slug" value="<?php echo $this->form_validation->value('page_slug', !isset($page) ? '/' : $page['page_slug'], false); ?>" />
					<span class="description">The 'slug' is the pages identifier. It is used to produce an SEO-friendly link to this page</span>
				</div>
		
				<div class="row required ck-default<?php $this->form_validation->earmark('page_content'); ?>">
					<label for="page_content">Content</label>
					<textarea name="page_content" id="page_content" rows="4" cols="40"><?php echo $this->form_validation->value('page_content', !isset($page) ? '' : $page['page_content'], false); ?></textarea>
				</div>
		
				<div class="row required<?php $this->form_validation->earmark('page_status'); ?>">
					<label for="page_status">Status</label>
					<select name="page_status" id="page_status">
						<option value="draft"<?php echo $this->form_validation->selected('page_status', 'draft', isset($page) && $page['page_status'] == 'draft'); ?>>Draft</option>
						<option value="published"<?php echo $this->form_validation->selected('page_status', 'published', !isset($page) || $page['page_status'] == 'published'); ?>>Published</option>
						<?php if(isset($page) && $page['page_status'] == 'deleted'): ?>
						<option value="deleted" selected="selected">Deleted</option>
						<?php endif; ?>
					</select>
				</div>
				
				<div class="row buttons">
					<input type="submit" value="Save" />
				</div>
				
			</fieldset>
			
			<fieldset style="float: left; margin-left: 10px;">
				
				<h2>Attached Images</h2>
				
				<div class="file-uploader-container" style="width: 320px;">
					
					<div id="file-uploader">
						<noscript>
							<p>Please enable JavaScript to use file uploader.</p>
							<!-- or put a simple form for upload here -->
						</noscript>
					</div>
					
					<p>Drag to order your images</p>
					<div class="qq-on-select">
						With Selected: 
						<a href="#" class="qq-delete-images">Delete</a>
					</div>
					
					<?php if(count($image) > 0): ?>
					<ul id="qq_existing" style="display: none;">
						<?php foreach($image as $img): ?>
						<li class="qq-upload-success">
							<input class="qq-upload-select" type="checkbox" name="image_select[<?php echo $img['image_id']; ?>]" />
							<span class="qq-upload-file"><a href="#"><?php echo $img['image_name']; ?></a></span>
							<span class="qq-upload-size" style="display: inline; "><?php echo $img['image_size']; ?>kb</span>
							<input type="hidden" name="page_image_id[]" value="<?php echo $img['image_id']; ?>">
						</li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
					
				</div>
				
			</fieldset>
			
		</form>
		
	</div>
	