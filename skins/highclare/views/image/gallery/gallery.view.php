<?php $this->load->view('common/header.include.php'); ?>
				
				<div class="left">
					
					<?php //echo Modules::run('page/breadcrumb', $page); ?>
					
					<div class="page-content">
						
						<h1><?php echo $gallery->name(); ?> Gallery</h1>
						
						<ul style="list-style: none; margin: 0; padding: 0;" class="clearfix">
							<?php foreach($gallery->images() as $image): ?>
							<li style="float: left; margin-right: 10px;">
								<a href="<?php echo $image->path(); ?>" title="<?php echo $image->name(); ?>" class="image-lightbox" rel="gallery">
									<span class="gallery-image" style="display: block;"><img src="<?php echo $image->thumbnail(); ?>" alt="" /></span>
									<span class="gallery-title"><?php echo $image->name(); ?></span>
								</a>
							</li>
							<?php endforeach; ?>
						</ul>
						
					</div>
					
				</div>
				
<?php $this->load->view('common/footer.include.php'); ?>