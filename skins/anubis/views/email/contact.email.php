<?php $this->load->view('email/header.email.php'); ?>

	<h2 style="border-bottom: solid 1px #333; text-shadow: 1px 1px 4px #ddd; margin: 0 0 12px; padding-bottom: 8px;">Website Enquiry</h2>
	
	<table border="0" cellspacing="0">
		<tr>
			<td valign="top" width="120">Name:</td>
			<td><?php echo $contact_name; ?></td>
		</tr>
		<tr>
			<td valign="top">Company:</td>
			<td><?php echo $contact_company; ?></td>
		</tr>
		<tr>
			<td valign="top">Email:</td>
			<td><?php echo $contact_email; ?></td>
		</tr>
		<tr>
			<td valign="top">Telephone:</td>
			<td><?php echo $contact_telephone; ?></td>
		</tr>
		<?php if(!empty($contact_enquiry_type)): ?>
		<tr>
			<td valign="top">Enquiry Type:</td>
			<td><?php echo $contact_enquiry_type; ?></td>
		</tr>
		<?php endif; ?>
		<tr>
			<td valign="top">Enquiry:</td>
			<td><?php echo $contact_enquiry; ?></td>
		</tr>
		<?php if($contact_marketing == 1): ?>
		<tr>
			<td valign="top">Marketing:</td>
			<td>User has opted out of receiving email marketing</td>
		</tr>
		<?php endif; ?>
	</table>

<?php $this->load->view('email/footer.email.php'); ?>