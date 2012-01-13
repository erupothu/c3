
	<div class="clearfix">
		
		<?php /*
		<pre style="border: solid 1px #cccccc; padding: 20px; background: #fff; margin-bottom: 1.0em;"><?php print_r($page); ?></pre>
		*/ ?>
		
		<form method="post" action="<?php echo $this->uri->uri_string(); ?>">
			<fieldset>
				
				<?php if(isset($page->page_id)): ?>
				<input type="hidden" name="page_id" value="<?php echo $page->id(); ?>">
				<?php endif; ?>
				
				<?php if($this->form_validation->has_errors()): ?>
				<div class="row form-errors">
					<?php echo $this->form_validation->errors(); ?>
				</div>
				<?php endif; ?>
		
				<div class="row required<?php $this->form_validation->earmark('page_name'); ?>">				
					<label for="page_name">Title</label>
					<span><input type="text" name="page_name" id="page_name" value="<?php echo $this->form_validation->value('page_name', !isset($page) ? '' : $page->page_name, false); ?>" /></span>
				</div>
		
				<div class="row required<?php $this->form_validation->earmark('page_parent_id'); ?>">
					<label for="page_parent_id">Parent Page</label>
					<span><select name="page_parent_id" id="page_parent_id">
						<option value="0">&nbsp;</option>
						<?php echo Modules::run('page/admin/retrieve', 'select-options', array('selected' => $this->form_validation->value('page_parent_id', !isset($page) ? '' : $page->parent()))); ?>
					</select></span>
				</div>
		
				<div class="row required<?php $this->form_validation->earmark('page_slug'); ?>">
					<label for="page_slug">Permalink</label>
					<span><input type="text" name="page_slug" id="page_slug" value="<?php echo $this->form_validation->value('page_slug', !isset($page) ? '/' : $page->page_slug, false); ?>" /></span>
					<span class="description">The 'permalink' is the pages identifier. It is used to produce an SEO-friendly link to this page</span>
				</div>
				
				<div class="row required<?php $this->form_validation->earmark('page_meta[page_template]'); ?>">
					<label for="page_meta[page_template]">Page Template</label>
					<span><select name="page_meta[page_template]" id="page_meta[page_template]">
						<option value="0">Default</option>
						
					</select></span>
				</div>
				
				<?php
				
				$template_dir = sprintf('%s/skins/%s/views/page/templates/', getcwd(), CI::$APP->insight->config('display/skin'));
				$directory_it = new RecursiveDirectoryIterator($template_dir);
				$template_arr = array();
				
				foreach(new RecursiveIteratorIterator($directory_it) as $file) {
					
					if(!$file->isFile() || substr($file->getFileName(), 0, 2) == '._' || substr($file->getFileName(), -18) !== '.template.view.php')
						continue;
					
					$template_arr[] = substr($file->getFileName(), 0, strpos($file->getFileName(), '.'));
				}
				
				sort($template_arr);
				var_dump($template_arr);
				
				?>
				
		
				<div class="row required ck-default<?php $this->form_validation->earmark('page_content'); ?>">
					<label for="page_content">Content</label>
					<textarea name="page_content" id="page_content" rows="4" cols="20"><?php echo $this->form_validation->value('page_content', !isset($page) ? '' : $page->content(true), false); ?></textarea>
				</div>
		
				<div class="row required<?php $this->form_validation->earmark('page_status'); ?>">
					<label for="page_status">Status</label>
					<span><select name="page_status" id="page_status">
						<option value="draft"<?php echo $this->form_validation->selected('page_status', 'draft', isset($page) && $page->page_status == 'draft'); ?>>Draft</option>
						<option value="published"<?php echo $this->form_validation->selected('page_status', 'published', !isset($page) || $page->page_status == 'published'); ?>>Published</option>
						<?php if(isset($page) && $page->page_status == 'deleted'): ?>
						<option value="deleted" selected="selected">Deleted</option>
						<?php endif; ?>
					</select></span>
				</div>
				
				<div class="row button-row">
					<input type="submit" value="Save" />
				</div>
				
			</fieldset>
			
		</form>
		
	</div>
	