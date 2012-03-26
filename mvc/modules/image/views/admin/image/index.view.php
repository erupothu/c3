<?php $this->load->view('admin/common/header.include.php'); ?>
		
		<h2>Images</h2>
		
		<ul class="admin-options">
			<li><?php echo anchor('admin/image/gallery/create', 'New Image Gallery', array('class' => 'button')); ?></li>
		</ul>
		
<?php $this->load->view('admin/common/footer.include.php'); ?>