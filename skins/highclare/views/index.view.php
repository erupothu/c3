<?php $this->load->view('common/header.include.php'); ?>
		
		<div class="column-inner">
			
			<div class="column-inner-left">
			
				<div class="page-content">
					
					<?php echo $page['page_content']; ?>
				
					<div class="top-container">
						<a href="#top">^ Top of page</a>
						<?php if($this->auth->is_logged_in()): ?>
						<a href="/admin/page/update/<?php echo $page['page_id']; ?>" class="c3-edit-link">Edit this page</a>
						<?php endif; ?>
					</div>
				
				</div>
			
			</div>
			
			<div class="column-inner-right">
		
				<div class="page-images">
					<?php foreach($images as $i => $image): ?>

					<?php if(!is_null($image['image_thumbnail_path'])): ?>
					<a href="<?php echo $image['image_path']; ?>" class="image-lightbox">
						<img src="<?php echo $image['image_thumbnail_path']; ?>" alt="<?php echo htmlentities($image['image_alt']); ?>">
					</a>
					<?php else: ?>
					<img src="<?php echo $image['image_path']; ?>" alt="<?php echo htmlentities($image['image_alt']); ?>" />
					<?php endif; ?>
					
					<?php endforeach; ?>
				</div>
				
			</div>
			
		</div>
		
<?php $this->load->view('common/footer.include.php'); ?>


