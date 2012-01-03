
	<div class="clearfix">
	
		<form method="post" action="<?php echo $this->uri->uri_string(); ?>">
			<fieldset id="settings_seo">

				<?php if($this->form_validation->has_errors()): ?>
				<div class="row form-errors">
					<?php echo $this->form_validation->errors(); ?>
				</div>
				<?php endif; ?>
				
				<div class="row">
					<input type="checkbox" class="checkbox" name="seo_block_robots" id="seo_block_robots" value="1"<?php echo $this->form_validation->checked('seo_block_robots', '1', $this->insight->config('user/seo_block_robots')); ?> />
					<label for="seo_block_robots">Block Robots</label>
					<span>Blocking robots will stop search engines from indexing your website</span>
				</div>
				
				<div class="row buttons">
					<input type="hidden" name="ci_nonce" value="1" />
					<input type="submit" value="Save Settings" />
				</div>
				
			</fieldset>
		</form>
	
	</div>
	