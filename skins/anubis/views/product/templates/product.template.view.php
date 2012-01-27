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
					
					<h2><span><?php echo $product->category(); ?></span></h2>
				
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
								<div class="title"><?php echo $product->name(); ?></div>
								<div class="code"><span>Code:</span> <?php echo $product->code(); ?></div>
							</header>
							
							<div class="description">
								<?php echo $product->description(); ?>
							</div>
							
							<h3 style="font-weight: normal; color: #E53812;">Specification</h3>
							
							<div class="specification">
								<?php echo $product->specification(); ?>
							</div>
							
							<footer class="clearfix" style="display: block; margin: 16px 0 8px;">
								
								<div class="price"><span>Price:</span> &pound;<?php echo $product->price(); ?></div>
								<div class="buttons" style="float: right;">
									<form action="/cart/add" method="post">
										
										<input type="hidden" name="product_id" id="product_id" value="<?php echo $product->id(); ?>">
										<input type="hidden" name="product_module" id="product_module" value="<?php echo $this->router->fetch_module(); ?>">
										<input type="hidden" name="product_quantity" id="product_quantity" value="1">
										
										<noscript><input type="submit" value="Add to Cart"></noscript>
										
										<a href="#" class="button orange submit" style="position: static;">Add to Cart<span></span></a>
										<a href="#" class="button grey" style="position: static; margin-left: 8px;" onclick="javascript:alert('PDF Download'); return false;">PDF Download<span></span></a>
										
									</form>
								</div>
								
							</footer>
							
						</div>
						
					</div>
				
				</div>
				
			</div>
			
			<!-- Related Products -->
			<div id="related">
				
				<div class="tab">
					<span>Related Products</span>
				</div>
			
				<div class="box tabbed">
				
					<div class="product-pane slide-pane">
					
						<ul class="clearfix product-list slide-content">
							<?php echo Modules::run('products/related', 'list-item'); ?>
							<?php for($n = 1; $n <= 4; $n++): ?>
							<li class="product-item">
						
								<a href="#">
									<img src="/uploads/news-temp-100x100.jpg" alt="News Temp" style="margin-right: 14px; float: left;">
								</a>
						
								<div style="height: 100px; width: 174px; margin-right: 16px; float: left; position: relative;">
									<h3 style="margin: 5px 0 5px; padding: 0; color: #E63812;">Product Name</h3>
									<p style="margin: 0; color: #15191A; max-height: 42px; overflow: hidden;">Pellentesque habitant morbi tristique senectus et netus et </p>
									<a href="#" class="button orange read-more" title="More Info &gt;" style="position: absolute; bottom: 0;">More Info<span></span></a>
								</div>
						
							</li>
							<?php endfor; ?>
						</ul>
					
					</div>
				
					<div class="slider"></div>
				
				</div>
			
			</div>
			<!-- End Related Products -->
			
		</div>
	
	</div>

<?php $this->load->view('common/footer.include.php'); ?>