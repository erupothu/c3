<?php $this->load->view('common/header.include.php'); ?>
				
				<div class="left">
					
					<?php //echo Modules::run('page/breadcrumb', $page); ?>
					
					<div class="page-content">
						
						<h1>Photo Gallery</h1>
						
						<ul style="list-style: none; margin: 0; padding: 0;">
							<?php foreach($galleries as $gallery): ?>
							<li style="float: left; margin-right: 10px;">
								<a href="<?php echo $gallery->permalink(); ?>">
									<span class="gallery-image" style="display: block;"><?php echo $gallery->temp(); ?></span>
									<span class="gallery-title"><?php echo $gallery->name(); ?></span>
								</a>
							</li>
							<?php endforeach; ?>
						</ul>
						
					</div>
					
				</div>
				
<?php $this->load->view('common/footer.include.php'); ?>