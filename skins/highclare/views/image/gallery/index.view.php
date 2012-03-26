<?php $this->load->view('common/header.include.php'); ?>
				
				<div class="full">
					
					<div class="page-content" style="width: auto;">
						
						<h1>Photo Galleries</h1>
						
						<ul class="clearfix" style="list-style: none; margin: 0 0 1.0em 0; padding: 0;">
							<?php foreach($galleries as $gallery): ?>
							<li style="float: left; margin-right: 10px;">
								<a href="<?php echo $gallery->permalink(true); ?>">
									<span class="gallery-image" style="display: block;"><?php echo !$gallery->cover() ? '<img src="' . $this->uri->skin('assets/images/gallery/no-image.png') . '" alt="" />' : $gallery->cover(); ?></span>
									<span class="gallery-title" style="display: block; padding: .25em 0 0 .25em;"><?php echo $gallery->name(); ?></span>
								</a>
							</li>
							<?php endforeach; ?>
						</ul>
						
					</div>
					
				</div>
				
<?php $this->load->view('common/footer.include.php'); ?>