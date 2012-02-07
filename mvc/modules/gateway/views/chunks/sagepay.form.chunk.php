
	<!-- Sagepay Form -->
	<form action="<?php echo $transaction_endpoint; ?>" method="post" id="gateway" name="gateway"> 
		<input type="hidden" name="VPSProtocol" value="<?php echo Gateway_Sagepay::SAGEPAY_VPS_PROTOCOL; ?>">
		<input type="hidden" name="TxType" value="<?php echo $transaction_type; ?>">
		<input type="hidden" name="Vendor" value="<?php echo $transaction_vendor; ?>">
		<input type="hidden" name="Crypt" value="<?php echo $transaction_payload; ?>">
		<label for="gateway_submit">Click this button if your browser fails to redirect you</label>
		<input type="submit" id="gateway_submit" name="gateway_submit" value="Proceed">
	</form>
	
	<?php if(isset($auto_submit) && $auto_submit): ?>
	<script>
	document.getElementById('gateway').submit();
	</script>
	<?php endif; ?>
	<!-- End Sagepay Form -->
	