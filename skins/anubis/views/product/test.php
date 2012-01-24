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
				
					<div class="product full-details clearfix">
						
						<div class="images" style="width: 224px; margin-right: 16px; float: left;">
							
							<div class="image" style="position: relative; background: #ffffff; width: 222px; height: 222px; border: solid 1px #ccc; margin-bottom: 8px;">
								<img src="/uploads/product.jpg" alt="Product" style="display: block; margin: 6px;">
								<a href="javascript:alert('Zoom');" style="display: block; background: url(<?php echo $this->uri->skin('assets/images/ui.zoom.png'); ?>) no-repeat bottom right; width: 51px; height: 51px; position: absolute; bottom: -1px; right: -1px; text-indent: -999em;">Zoom</a>
							</div>
						
							<div class="thumbnails">
								<a class="thumbnail left" href="#">
									<img src="/uploads/product_thumb.jpg" alt="Product Title">
								</a>
					
								<a class="thumbnail right" href="#">
									<img src="/uploads/product_thumb.jpg" alt="Product Title">
								</a>
							</div>
						</div>
						
						<div class="details" style="width: 368px; height: auto;">
							
							<header class="clearfix" style="font-size: 16px; margin-bottom: 8px;">
								<div class="title"><a href="#">Product Name</a></div>
								<div class="code"><span>Code:</span> 02345</div>
							</header>
							
							<p style="margin: 0;">
								Pellentesque habitant morbi tristique senectus et 
								netus et malesuada fames ac turpis Phasellus pulvinar, 
								nulla non aliquam eleifend, tortor wisi sceler. 
								Pellentesque habitant morbi tristique senectus et 
								netus et malesuada fames ac turpis Phasellus pulvinar, 
								nulla non aliquam eleifend erat, 
								tortor wisi sceler. Pellentesque habitant morbi 
								tristique.
							</p>
							
							<h3 style="font-weight: normal; color: #E53812;">Specification</h3>
							
							<ul>
								<li>Pellentesque habitant morbi tristique senectus et netus.</li>
								<li>Phasellus pulvinar, nulla non aliquam eleifend.</li>
								<li>Pellentesque habitant morbi tristique senectus et netus.</li>
								<li>Phasellus pulvinar, nulla non aliquam eleifend.</li>
								<li>Pellentesque habitant morbi tristique senectus et netus.</li>
								<li>Phasellus pulvinar, nulla non aliquam eleifend.</li>
							</ul>
							
							<footer class="clearfix" style="display: block; margin: 16px 0 8px;">
								
								<div class="price"><span>Price:</span> &pound;139.99</div>
								<div class="buttons" style="float: right;">
									<a href="#" class="button orange" style="position: static; ">Add to Cart<span></span></a>
									<a href="#" class="button grey" style="position: static; margin-left: 8px;">PDF Download<span></span></a>
								</div>
								
							</footer>
							
						</div>
						
					</div>
				
				</div>
				
			</div>
			
			<!-- Related Products -->
			<div class="tab">
				<span>Related Products</span>
			</div>
			
			<div class="box tabbed">
				
				<ul class="clearfix product-list">
					<?php echo Modules::run('products/related', 'list-item'); ?>
				</ul>
				
			</div>
			<!-- End Related Products -->
			
		</div>
	
	</div>

<?php $this->load->view('common/footer.include.php'); ?>