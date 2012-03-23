<?php $this->load->view('common/header.include.php'); ?>
				
				<div class="left">
					
					<div class="page-content search-content">
						
						<article>
							<h1>Search</h1>
							
							<?php if($results->count() > 0): ?>
							<ol class="search-results">
								<?php foreach($results as $result): ?>
								<li>
									<?php echo anchor($result->permalink(true), $result->title()); ?>
									<div class="excerpt">
										<?php echo $result->excerpt(155); ?>
									</div>
								</li>
								<?php endforeach; ?>
							</ol>
							<?php else: ?>
							
							No results found for <em><?php echo $search_term; ?></em>.
								
							<?php endif; ?>
							
						</article>
						
					</div>
					
				</div>
				
<?php $this->load->view('common/footer.include.php'); ?>