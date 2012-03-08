<?php $this->load->view('common/header.include.php'); ?>

	<div class="column-container constrain clearfix">
	
		<div class="left-column">
		
			<div class="box box-submenu">
				
				<div style="margin: 8px;">
					<h2><a href="/product/technical-equipment"><span>Technical Equipment</span></a></h2>
					
					<ul id="sub-menu">
						<li class="first-child"><a href="/product/technical-equipment/cots-equipment">COTS Equipment</a></li>
						<li><a href="/product/technical-equipment/tracking-aquilia">Tracking (Aquilia)</a></li>
						<li><a href="/product/technical-equipment/audio">Audio Equipment</a></li>
						<li><a href="/product/technical-equipment/video">Video Equipment</a></li>
						<li class="last-child"><a href="/special-projects/technical-equipment/technical-assistance">Technical Assistance</a></li>
					</ul>
				</div>
				
			</div>
			
			<div class="box box-submenu">
				
				<div style="margin: 8px;">
					<h2><a href="/product/training"><span>Training</span></a></h2>
					
					<ul id="sub-menu">
						<li class="first-child"><a href="/product/training/cots-course">COTS Course</a></li>
						<li><a href="/product/training/surveillance">Surveillance</a></li>
						<li><a href="/product/training/technical-surveillance">Technical Surveillance</a></li>
						<li class="last-child"><a href="/product/training/ctr-course">CTR Course</a></li>
					</ul>
				</div>
				
			</div>
			
		</div>
	
		<div class="right-column">
		
			<div class="box">
				
				<div id="products" style="margin: 8px;">
					
					<h2><span><?php echo $category->name(); ?></span></h2>
					
					<?php foreach($category->products() as $i => $product): ?>
					<div class="product clearfix<?php echo $product == end($category->products()) ? ' last-child' : ''; ?>">
						
						<a class="thumbnail" href="<?php echo $product->permalink(); ?>">
							<img src="/uploads/product_thumb.jpg" alt="<?php echo $product->name(); ?>">
						</a>
						
						<div class="details">
							
							<header class="clearfix">
								<div class="title"><?php echo anchor($product->permalink(), $product->name()); ?></div>
								<div class="code"><span>Code:</span> <?php echo $product->code(); ?></div>
							</header>
							
							<div class="description">
								
								<p>
									<?php echo $product->excerpt(); ?>
								</p>
								
								<a href="<?php echo $product->permalink(); ?>" class="button orange">More Info<span></span></a>
								
							</div>
						</div>						
						
					</div>
					<?php endforeach; ?>
					<?php if(count($category->products()) == 0): ?>
					<div class="empty" style="height: 150px; line-height: 150px; text-align: center;">
						Check back soon for possible Anubis <?php echo $category->name(); ?>.
					</div>
					<?php endif; ?>
				</div>
				
			</div>
		
		</div>
	
	</div>

<?php $this->load->view('common/footer.include.php'); ?>