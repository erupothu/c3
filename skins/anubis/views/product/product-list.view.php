<?php $this->load->view('common/header.include.php'); ?>

	<div class="column-container constrain clearfix">
	
		<div class="left-column">
		
			<div class="box box-submenu">
				
				<div style="margin: 8px;">
					<h2><span>Technical Equipment</span></h2>
					
					<ul id="sub-menu">
						<li class="first-child"><a href="#">COTS Equipment</a></li>
						<li><a href="#">Tracking (Aquilia)</a></li>
						<li><a href="#">Audio Equipment</a></li>
						<li><a href="#">Video Equipment</a></li>
						<li class="last-child"><a href="#">Technical Assistance</a></li>
					</ul>
				</div>
				
			</div>
			
			<div class="box box-submenu">
				
				<div style="margin: 8px;">
					<h2><span>Training</span></h2>
					
					<ul id="sub-menu">
						<li class="first-child"><a href="#">COTS Course</a></li>
						<li><a href="#">Surveillance</a></li>
						<li><a href="#">Technical Surveillance</a></li>
						<li class="last-child"><a href="#">CTR Course</a></li>
					</ul>
				</div>
				
			</div>
			
		</div>
	
		<div class="right-column">
		
			<div class="box">
				
				<div id="products" style="margin: 8px;">
					
					<h2><span>COTs Equipment</span></h2>
					
					<?php for($i = 1; $i <= 3; $i++): ?>
					<div class="product clearfix<?php echo $i == 3 ? ' last-child' : ''; ?>">
						
						<a class="thumbnail" href="/product/test">
							<img src="/uploads/product_thumb.jpg" alt="Product Title">
						</a>
						
						<div class="details">
							
							<header class="clearfix">
								<div class="title"><a href="/product/test">Product Name</a></div>
								<div class="code"><span>Code:</span> 02345</div>
							</header>
							
							<div class="description">
								
								<p>
									Pellentesque habitant morbi tristique senectus et netus et malesuada 
									fames ac turpis Phasellus pulvinar, nulla non aliquam eleifend, tortor 
									wisi sceler.
								</p>
								
								<a href="/product/test" class="button orange">More Info<span></span></a>
								
							</div>
						</div>						
						
					</div>
					<?php endfor; ?>
				</div>
				
			</div>
		
		</div>
	
	</div>

<?php $this->load->view('common/footer.include.php'); ?>