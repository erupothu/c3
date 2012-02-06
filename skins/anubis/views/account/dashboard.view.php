<?php $this->load->view('common/header.include.php'); ?>

	<h2>Welcome back, <?php echo $this->user->name(); ?></h2>

	<ul>
		<li><?php echo anchor('account/profile', 'Modify Details'); ?></li>
		<li><?php echo anchor('account/order', 'Order History'); ?></li>
		<li><?php echo anchor('account/address', 'Manage Address Book'); ?></li>
		<li><?php echo anchor('account/log-out', 'Log Out'); ?></li>
	</ul>

<?php $this->load->view('common/footer.include.php'); ?>