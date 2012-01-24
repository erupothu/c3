
				</div>
				
			</div>
		
			<div id="push"></div>
			
		</div>
		
		<footer>
			
			<div class="constrain">
				
				<ul class="outer">
					<li class="first-child">
						
						<ul class="inner">
							<?php if(!is_null($this->administrator) && CI::$APP->router->fetch_module() == 'page'): ?>
							<li class="first-child edit-child" style="padding-right: 6px;"><?php echo anchor($page->link(Page_Object::LINK_ADMIN_UPDATE), 'Edit Page'); ?></li>
							<?php endif; ?>
							<li class="first-child last-child">Anubis Ltd <?php echo date('Y'); ?> &copy;</li>
						</ul>
						
					</li>
					<li>
						
						<ul class="inner">
							<li class="first-child"><a href="#">Home</a></li>
							<li><a href="#">About Us</a></li>
							<li><a href="#">News</a></li>
							<li><a href="#">Credit Application</a></li>
							<li><a href="#">Contact Us</a></li>
							<li class="last-child"><a href="#">Training &amp; Operations</a></li>
						</ul>
						
					</li>
					<li class="last-child">
						
						<ul class="inner">
							<li class="first-child"><a href="#">Special Projects</a></li>
							<li><a href="#">Site Map</a></li>
							<li><a href="#">Privacy</a></li>
							<li><a href="#">Terms &amp; Conditions</a></li>
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