<?php $this->load->view('common/header.include.php'); ?>

	<h2>Addresses</h2>
	
	<div id="addresses">
		
		<?php foreach($addresses as $address): ?>
		<div class="address-item" style="border: solid 1px red; margin-bottom: 1.0em; position: relative; width: 240px;">
			<a href="#" style="position: absolute; top: 0; right: 0; padding: 8px 12px 0 0;">Edit</a>
			<address style="font-style: normal; padding: 8px;">
				<?php echo $address; ?>
			</address>
		</div>
		<?php endforeach; ?>
		
	</div>
	
	<?php echo anchor('account/address/add', 'Add Address'); ?>

<?php $this->load->view('common/footer.include.php'); ?>