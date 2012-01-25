<?php $this->load->view('email/header.email.php'); ?>

	<h2 style="border-bottom: solid 1px #333; text-shadow: 1px 1px 4px #ddd; margin: 0 0 12px; padding-bottom: 8px;">Website Enquiry</h2>
	
	<table border="0" cellspacing="0">
		<tr>
			<td width="120">Name:</td>
			<td><?php echo $contact_name; ?></td>
		</tr>
		<tr>
			<td>Company:</td>
			<td><?php echo $contact_company; ?></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><?php echo $contact_email; ?></td>
		</tr>
		<tr>
			<td>Telephone:</td>
			<td><?php echo $contact_telephone; ?></td>
		</tr>
		<tr>
			<td>Enquiry Type:</td>
			<td><?php echo $contact_enquiry_type; ?></td>
		</tr>
		<tr>
			<td>Enquiry:</td>
			<td><?php echo $contact_enquiry; ?></td>
		</tr>
		<tr>
			<td>Marketing:</td>
			<td><?php echo $contact_marketing; ?></td>
		</tr>
	</table>

<?php $this->load->view('email/footer.email.php'); ?>