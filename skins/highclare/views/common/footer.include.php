			
			</div>
			
			<div class="constrain boxes clearfix">
				
				<div class="box ask-a-question">
					
					<div class="pad">
						
						<h2>Ask a Question</h2>
						
						<a href="/ask">
							<img src="<?php echo $this->uri->skin('assets/images/boxes/box-ask.jpg'); ?>" alt="Ask a Question">
						</a>
					
						<p>
							Feel free to click here and ask us a question. We endeavour 
							to supply a written answer within 24 hours&hellip;
							<a href="/ask">more</a>
						</p>
						
					</div>
					
				</div>
				
				<div class="box hipe">
					
					<div class="pad">
						
						<h2>HiPE</h2>
						
						<a href="http://www.highclareschool.com/moodle" rel="external" target="_blank">
							<img src="<?php echo $this->uri->skin('assets/images/boxes/box-hipe.jpg'); ?>" alt="Highclare Pupil Environment">
						</a>
						
						<p>
							Welcome to the Highclare Pupil Environment (HiPE for 
							short) – our very own Virtual Learning Environment&hellip;
							<a href="http://www.highclareschool.com/moodle" rel="external" target="_blank">login</a>
						</p>
					
					</div>
					
				</div>
				
				<div class="box ofsted">
					
					<div class="pad">
						
						<h2>OFSTED &amp; Results</h2>
						
						<a href="#">
							<img src="<?php echo $this->uri->skin('assets/images/boxes/box-ofsted.jpg'); ?>" alt="OFSTED &amp; Results">
						</a>
						
						<p>
							We strive for Individual Excellence by meeting 
							the needs of the individual in everything we do&hellip;
							<a href="#">more</a>
						</p>
						
					</div>
					
				</div>
				
			</div>
			
			<div class="shove"></div>
			
		</div>
		
		<footer>
			
			<div class="constrain clearfix">
				
				<div class="column left">
					
					<ul>
						<li class="first-child"><a href="#">Introduction</a></li>
						<li><a href="#">Administration</a></li>
						<li><a href="#">Admissions</a></li>
						<li><a href="#">Nursery</a></li>
						<li><a href="#">Pre-School &amp; Infants</a></li>
						<li><a href="#">Juniors</a></li>
						<li><a href="#">Seniors</a></li>
						<li class="last-child"><a href="#">Sixth Form</a></li>
					</ul>
					
					<ul class="last-child">
						<li class="first-child"><a href="#">Results</a></li>
						<li><a href="#">Photo Gallery</a></li>
						<li><a href="#">PTA</a></li>
						<li><a href="#">TOPs</a></li>
						<li><a href="#">News</a></li>
						<li><a href="#">Downloads</a></li>
						<li class="last-child"><a href="#">Contact Us</a></li>
					</ul>
					
				</div>
				
				<div class="column middle">
					
					<form method="post" action="/account/log-in" id="form-login" class="clearfix">
						<fieldset>
							
							<div class="row">
								<label for="account_type">Select login type</label>
								<select name="account_type" id="account_type">
									<option value="">Parent</option>
									<option value="">Past Pupil</option>
									<option value="">Staff</option>
								</select>
							</div>
							
							<div class="row">
								<label for="account_email">Username</label>
								<input type="password" name="account_email" class="password" id="account_email" value="">
							
								<label for="account_password">Password</label>
								<input type="password" name="account_password" class="password" id="account_password" value="">
								
								<input type="submit" value="Login">
							</div>
							
							<a href="/account/recover">Forgotten Password?</a>
							
						</fieldset>
					</form>
					
				</div>
				
				<div class="column right">
					
					<div class="pinch">
						
						<form method="post" action="/search" class="clearfix" id="form-search">
							<fieldset>
								<input type="text" name="search" value="Search" id="search" class="search search-box">
								<input type="image" src="<?php echo $this->uri->skin('assets/images/form.search.png'); ?>" class="search search-submit">
							</fieldset>
						</form>
						
						<form method="post" action="" id="form-quicklinks" class="clearfix">
							<fieldset>
								<label for="quicklink" class="title">Quick Links</label>
								<select id="quicklink" name="quicklink">
									<option value="">Select a Link</option>
									<?php echo Modules::run('page/children', 'select-option'); ?>
								</select>
							</fieldset>
						</form>
						
						<ul id="social" class="clearfix">
							<li class="facebook first-child"><a href="https://www.facebook.com/pages/Highclare-School/107967849237828" title="Facebook">Facebook</a></li>
							<li class="linkedin"><a href="#" title="Linked In">Linked In</a></li>
							<li class="rss-feed"><a href="#" title="RSS">RSS</a></li>
							<li class="email-us last-child"><a href="#" title="Email">Email</a></li>
						</ul>
						
					</div>
					
				</div>
				
			</div>
			
			<nav class="constrain bottom">
				
				<ul id="footer-nav" class="clearfix constrain">
					<li class="first-child"><a href="#">Home</a></li>
					<li class="creative-insight"><a href="http://www.creativeinsight.co.uk/" rel="external" target="_blank" title="The Web &hearts;'s Creative Insight">Site by <span>Creative Insight</span></a></li>
					<li><a href="#">Privacy Policy</a></li>
					<li><a href="#">Terms of Use</a></li>
					<li><a href="#">Site Map</a></li>
					<li class="last-child"><a href="#" rel="copyright">Highclare School <?php echo date('Y'); ?> &copy;</a></li>
				</ul>
				
			</nav>
			
		</footer>
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="<?php echo $this->uri->skin('assets/scripts/libs/jquery-1.7.1.min.js'); ?>"><\/script>')</script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
		
		<script src="<?php echo $this->uri->skin('assets/scripts/libs/jquery-1.7.1.min.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('assets/scripts/libs/jquery.easing-1.3.min.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('assets/scripts/libs/cufon-yui-1.09.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('assets/scripts/fonts/swiss721-thin.font.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('assets/scripts/fonts/swiss721-light.font.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('assets/scripts/fonts/swiss721-medium.font.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('assets/scripts/fonts/swiss721-bold.font.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('assets/scripts/libs/sexy-curls.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('assets/scripts/libs/jquery.nivo.slider.js'); ?>"></script>
		<script src="<?php echo $this->uri->skin('assets/scripts/highclare.js'); ?>"></script>
		
		<script>
		var _gaq = [ ['_setAccount','UA-XXXXX-X'], ['_trackPageview'] ];
		(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
			g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
			s.parentNode.insertBefore(g,s)}(document,'script')
		);
		</script>
		
		<script>Cufon.now();</script>
		
	</body>
</html>