							
							<!-- Chunk: Breadcrumb -->
							<nav class="breadcrumb">
								
								<ul>
									<li class="first-child">You are here:</li>
									<?php foreach($breadcrumbs as $breadcrumb_path => $breadcrumb_title): ?>
									<li<?php echo $breadcrumb_title == end($breadcrumbs) ? ' class="last-child"' : ''; ?>><a href="<?php echo $breadcrumb_path; ?>"><?php echo htmlentities($breadcrumb_title); ?></a></li>
									<?php endforeach; ?>
								</ul>
								
							</nav>
							<!-- End Chunk: Breadcrumb -->
							