<?php $this->load->view('common/header.include.php'); ?>

	<div class="column-container constrain clearfix">
	
		<div class="left-column">

			<?php echo Modules::run('page/children', $page); ?>
				
			<div class="box box-training-and-operations">
				<a href="/training-and-operations" title="Training &amp; Operations">
					<img src="<?php echo $this->uri->skin('assets/images/boxes/training-and-operations.jpg'); ?>" alt="Training &amp; Operations">
					<span class="strip"><em>Training &amp; Operations</em></span>
				</a>
			</div>
		
		</div>
	
		<div class="right-column">
	
			<div class="box">
				
				<div class="spacing">

					<article>
						
						<header style="height: 153px; position: relative; background: url(/uploads/header.temp.about-us.jpg) no-repeat top center;">
							<span class="title" style="font-size: 20px; text-transform: uppercase; position: absolute; bottom: 0; right: 0; display: block; padding: 12px 14px; color: #fff;"><?php echo $page->title(); ?></span>
						</header>
						
						<?php echo Modules::run('page/breadcrumb', $page); ?>

						<div class="content">
							<?php echo $page->content(); ?>
						</div>

					</article>
					
				</div>
				
			</div>
		
		</div>
	
	</div>

<?php $this->load->view('common/footer.include.php'); ?>