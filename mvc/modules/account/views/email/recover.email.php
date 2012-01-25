<?php $this->load->view('email/header.email.php'); ?>

	<h2 style="border-bottom: solid 1px #333; text-shadow: 1px 1px 4px #ddd; margin: 0 0 12px; padding-bottom: 8px;">Account Recovery</h2>

	<p>
		Thank you for taking the time to register with us, <strong><?php echo $user_firstname; ?></strong>.  You will now
		be able to <a href="<?php echo site_url('account/log-in'); ?>">log into the website</a>.  Here are your login details:
	</p>
	
	<table border="0" cellspacing="0">
		<tr>
			<td width="70">Username:</td>
			<td><?php echo $user_email; ?></td>
		</tr>
		<tr>
			<td>Authenticate:</td>
			<td><?php echo $user_password_plaintext; ?></td>
		</tr>
	</table>

<?php $this->load->view('email/footer.email.php'); ?>