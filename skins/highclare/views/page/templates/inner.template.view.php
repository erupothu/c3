<?php $this->load->view('common/header.include.php'); ?>
				
				<div class="left">
					
					<?php echo Modules::run('page/breadcrumb', $page); ?>
					
					<div class="page-content">
						
						<article style="margin: 0 0 1.5em 0;">
							<?php echo $page->content(); ?>
						</article>
						
					</div>
					
				</div>
				
				<div class="right neutral">
					<?php echo Modules::run('image/resource/hook', 'page', $page->id(), 'list'); ?>
				</div>
				
<?php $this->load->view('common/footer.include.php'); ?>