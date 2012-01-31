
				</div>
				
			</div>
		
			<div id="push"></div>
			
		</div>
		
		<footer>
			
			<div class="constrain">
				
				<ul class="outer">
					<li class="first-child">

						<ul class="inner">
							<?php if(property_exists(CI::$APP, 'administrator') && CI::$APP->router->fetch_module() == 'page'): ?>
							<li class="first-child edit-child" style="padding-right: 6px;"><?php echo anchor($page->link(Page_Object::LINK_ADMIN_UPDATE), 'Edit Page'); ?></li>
							<?php endif; ?>
							<li class="first-child last-child"><a href="/legal/copyright">Anubis Ltd <?php echo date('Y'); ?> &copy;</a></li>
						</ul>
						
					</li>
					<li>
						
						<ul class="inner">
							<li class="first-child"><a href="/">Home</a></li>
							<li><a href="/about-us">About Us</a></li>
							<li><a href="/news">News</a></li>
							<li><a href="#">Credit Application</a></li>
							<li><a href="/contact-us">Contact Us</a></li>
							<li class="last-child"><a href="/training-and-operations">Training &amp; Operations</a></li>
						</ul>
						
					</li>
					<li class="last-child">
						
						<ul class="inner">
							<li class="first-child"><a href="/special-projects">Special Projects</a></li>
							<li><a href="/sitemap">Site Map</a></li>
							<li><a href="/legal/privacy">Privacy</a></li>
							<li><a href="/legal/terms">Terms &amp; Conditions</a></li>
							<li class="last-child"><a href="http://www.creativeinsight.co.uk/" rel="external" target="_blank" title="Lovingly created by Creative Insight">Site by CI</a></li>
						</ul>
						
					</li>
				</ul>
				
			</div>
			
		</footer>
		
		<script>
		
		Cufon.now();
		
		</script>
		
	</body>
</html>