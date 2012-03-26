<?php $this->load->view('common/header.include.php'); ?>
				
				<div class="full">
					
					<?php //echo Modules::run('page/breadcrumb', $page); ?>
					
					<div class="page-content" style="width: auto;">
						
						<h1><?php echo $gallery->name(); ?></h1>
						
						<ul style="list-style: none; margin: 1.0em auto 1.5em; padding: 0;" class="clearfix">
							<?php foreach($gallery->images() as $image): ?>
							<li style="float: left; margin-right: 10px;">
								<a href="<?php echo $image->path(); ?>" title="<?php echo $image->name(); ?>" class="image-lightbox" rel="gallery">
									<span class="gallery-image" style="display: block;"><img src="<?php echo $image->thumbnail(); ?>" alt="" /></span>
									<span class="gallery-title"><?php echo $image->alt(); ?></span>
								</a>
							</li>
							<?php endforeach; ?>
						</ul>
						
					</div>
					
				</div>
				
<?php $this->load->view('common/footer.include.php'); ?>