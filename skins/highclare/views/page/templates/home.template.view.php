<?php $this->load->view('common/header.include.php'); ?>
				
				<div class="left">
					
					<div class="page-content">
						<?php echo $page->content(); ?>
					</div>
					
				</div>
				
				<div class="right">
					
					<div class="box admissions">
						
						<div class="pad">
							
							<h2>Admissions &amp; Open Days</h2>
							
							<a href="/admissions">
								<img src="<?php echo $this->uri->skin('assets/images/temp2.jpg'); ?>" alt="Admissions &amp; Open Days">
							</a>
							
							<p>
								For information on our admissions policies, scholarships, fees and 
								dates for our open days, please click <a href="/admissions">here</a>&hellip;
							</p>
							
						</div>
						
					</div>
					
					<div class="box news">
						
						<div class="pad">
							
							<h2>
								News
								<small><a href="#">View all news</a></small>
							</h2>
							
							<div class="news-container">
								<?php echo Modules::run('news/retrieve', 'default', array('limit' => 2)); ?>
							</div>
							
						</div>
						
					</div>
					
					<div class="box diary">
						
						<div class="pad">
							
							<h2>
								Diary Dates
								<small><a href="#">View all dates</a></small>
							</h2>
							
							<div class="calendar-container">
								
								<table class="calendar-dates">
									<thead>
										<tr>
											<th>Date</th>
											<th>Event</th>
										</tr>
									</thead>
									<tbody>
										<?php echo Modules::run('calendar/retrieve'); ?>
									</tbody>
								</table>
								
							</div>
							
						</div>
						
					</div>
					
				</div>
				
<?php $this->load->view('common/footer.include.php'); ?>
