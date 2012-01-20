<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<meta name="author" content="Creative Insight">
		<title>Administration</title>
		<link rel="canonical" href="<?php echo site_url(); ?>">
		<link rel="stylesheet" href="<?php echo $this->uri->skin('styles/core.css'); ?>">
		<script src="<?php echo $this->uri->skin('scripts/modernizr-2.0.6.min.js'); ?>"></script>
	</head>
	<body id="login">
	
		<div id="admin">
			
			<div id="header">
				
				<div class="constrain">
					
					<h1>Administration</h1>
					
					<div id="admin-login">
						
						<?php if(false !== $this->session->flashdata('admin/message', false)): ?>
						<div class="flash-message">
							<?php echo $this->session->flashdata('admin/message'); ?>
							<a class="icon-close" href="javascript:;">x</a>
						</div>
						<?php endif; ?>
						
						<form method="post" action="<?php echo $this->uri->uri_string(); ?>">
					
							<?php if($this->form_validation->has_errors()): ?>
							<div id="errors">
								<?php echo $this->form_validation->errors(); ?>
							</div>
							<?php endif; ?>
						
							<div class="row<?php echo $this->form_validation->earmark('admin_username'); ?>">
								<label for="admin_username">Username</label>
								<span><input type="text" name="admin_username" id="admin_username" value="<?php echo $this->form_validation->value('admin_username'); ?>"></span>
							</div>
						
							<div class="row<?php echo $this->form_validation->earmark('admin_password'); ?>">
								<label for="admin_password">Password</label>
								<span><input type="password" name="admin_password" id="admin_password"></span>
							</div>
							
							<div class="button-row">
								<input type="submit" value="Login" />
							</div>
							
						</form>
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		
		<div id="footer">
			
			<div class="constrain">
				C3 &nbsp;<span class="copyright">&copy; Creative Insight <?php echo date('Y'); ?></span>
			</div>
			
		</div>
		
	</body>
</html>