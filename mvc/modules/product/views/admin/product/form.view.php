
	<div class="clearfix">
	
		<?php if(isset($product)): ?>
		<pre style="border: solid 1px #cccccc; padding: 20px; background: #fff; margin-bottom: 1.0em;"><?php print_r($product); ?></pre>
		<?php endif; ?>
	
		<form method="post" action="<?php echo $this->uri->uri_string(); ?>">
			<fieldset>
			
				<?php if($this->form_validation->has_errors()): ?>
				<div class="row form-errors">
					<?php echo $this->form_validation->errors(); ?>
				</div>
				<?php endif; ?>
	
				<div class="row required<?php $this->form_validation->earmark('product_name'); ?>">				
					<label for="product_name">Title</label>
					<span><input type="text" name="product_name" id="product_name" value="<?php echo $this->form_validation->value('product_name'); ?>"></span>
				</div>
				
				<div class="row required<?php $this->form_validation->earmark('product_code'); ?>">				
					<label for="product_code">Code</label>
					<span><input type="text" name="product_code" id="product_code" value="<?php echo $this->form_validation->value('product_code'); ?>"></span>
				</div>
				
				<div class="row required<?php $this->form_validation->earmark('product_category_id'); ?>">
					<label for="product_category_id">Category</label>
					<span><select name="product_category_id" id="product_category_id">
						<option value="0">&nbsp;</option>
						<?php foreach($categories as $category): ?>
						<option value="<?php echo $category->id(); ?>"<?php echo $this->form_validation->selected('product_category_id', $category->id()); ?>><?php echo $category->name(); ?></option>
						<?php endforeach;?>
						<?php //echo Modules::run('page/admin/retrieve', 'select-options', array('selected' => $this->form_validation->value('page_parent_id', !isset($page) ? '' : $page->parent()))); ?>
					</select></span>
				</div>

				<div class="row required ck-product ck-default<?php $this->form_validation->earmark('product_description'); ?>">
					<label for="product_description">Description</label>
					<textarea name="product_description" id="product_description" rows="4" cols="40"><?php echo $this->form_validation->value('product_description'); ?></textarea>
				</div>
				
				<div class="row required ck-product ck-default<?php $this->form_validation->earmark('product_specification'); ?>">
					<label for="product_specification">Specification</label>
					<textarea name="product_specification" id="product_specification" rows="4" cols="40"><?php echo $this->form_validation->value('product_specification'); ?></textarea>
				</div>

				<div class="row required<?php $this->form_validation->earmark('product_price'); ?>">				
					<label for="product_price">Price</label>
					<span><input type="text" class="money" name="product_price" id="product_price" value="<?php echo $this->form_validation->value('product_price'); ?>"></span>
				</div>

				<div class="row button-row">
					<input type="submit" value="Save" />
				</div>

			</fieldset>

		</form>

	</div>
	