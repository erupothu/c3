
	<div class="clearfix">
		
		<form method="post" action="<?php echo $this->uri->uri_string(); ?>">
			<fieldset>
			
				<?php if($this->form_validation->has_errors()): ?>
				<div class="row form-errors">
					<?php echo $this->form_validation->errors(); ?>
				</div>
				<?php endif; ?>
				
				<?php if(isset($gallery)): ?>
				<input type="hidden" name="gallery_id" id="gallery_id" value="<?php echo $gallery->id(); ?>">
				<?php endif; ?>
				
				<div class="row required<?php $this->form_validation->earmark('gallery_name'); ?>">
					<label for="gallery_name">Name</label>
					<span><input type="text" name="gallery_name" id="gallery_name" class="slug_title" value="<?php echo $this->form_validation->value('gallery_name', isset($gallery) ? $gallery->name() : ''); ?>" data-slug-generate="gallery_slug" data-slug-module="image" data-slug-override="gallery" /></span>
				</div>
				
				<div class="row required<?php $this->form_validation->earmark('gallery_slug'); ?>">
					<label for="gallery_slug">Permalink</label>
					<span><input type="text" name="gallery_slug" id="gallery_slug" value="<?php echo $this->form_validation->value('gallery_slug', isset($gallery) ? $gallery->permalink(false) : ''); ?>" /></span>
				</div>
			
				<div class="row button-row">
					<input type="submit" value="Save" />
				</div>
			
			</fieldset>
			
		</form>
		
	</div>
