<?php $this->load->view('common/header.include.php'); ?>
				
				<div class="left">
					
					<?php echo Modules::run('page/breadcrumb', $page); ?>
					
					<div class="page-content">
						
						<article style="margin: 0 0 1.5em 0;">
							<?php echo $page->content(); ?>
						</article>
						
					</div>
					
				</div>
				
				<div class="right" style="background: none; padding: 0; margin: 0;">
					
					<div style="border: solid 1px blue; margin-left: 20px; margin-top: 20px;">
						photos here.
					</div>
				</div>
				
<?php $this->load->view('common/footer.include.php'); ?>