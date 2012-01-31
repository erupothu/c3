<?php $this->load->view('common/header.include.php'); ?>

	<h2>Credit Application</h2>

	<form method="post" action="/account/credit-application">
		
		<fieldset>
			
			<div class="row required">
				<label for="account_company_name">Trading Name</label>
				<span><input type="text" name="account_company_name" id="account_company_name" value=""></span>
			</div>
			
			<div class="row required">
				<label for="account_company_reg_no">Registration Number</label>
				<span><input type="text" name="account_company_reg_no" id="account_company_reg_no" value=""></span>
			</div>
			
			<div class="row required">
				<label for="account_company_vat_no">VAT Number</label>
				<span><input type="text" name="account_company_vat_no" id="account_company_vat_no" value=""></span>
			</div>
			
			<div class="row required">
				<label for="account_telephone">Main Telephone</label>
				<span><input type="text" name="account_telephone" id="account_telephone" value=""></span>
			</div>
			
			<div class="row">
				<label for="account_fax">Main Fax</label>
				<span><input type="text" name="account_fax" id="account_fax" value=""></span>
			</div>
			
			<div class="row required">
				<label for="account_email">Main Email Address</label>
				<span><input type="text" name="account_email" id="account_email" value=""></span>
			</div>
			
			<div class="row">
				<label for="account_website">Website Address</label>
				<span><input type="text" name="account_website" id="account_website" value=""></span>
			</div>
			
			
			<div class="clearfix">
				
				<h3>References</h3>
				
				<div class="widget-address-form address-invoice element-hide" style="margin-top: 20px;">
					
					<?php for($i = 1; $i <= 3; $i++): ?>
					<div class="reference" style="float: left;<?php if($i > 1): ?> margin-left: 26px;<?php endif; ?>">

						<h4>Reference <?php echo $i; ?></h4>
					
						<div class="row required">
							<label for=""><?php echo $i . '. ' . ($i == 1 ? 'Bank Name' : 'Trade Reference'); ?></label>
							<span><input type="text" name="" id="" value=""></span>
						</div>
					
						<div class="row required">
							<label for="address_line_1_invoice">Street Address</label>
							<span><input type="text" name="" id="" value=""></span>
						</div>

						<div class="row">
							<label for="address_line_2_invoice">Town/City</label>
							<span><input type="text" name="" id="" value=""></span>
						</div>

						<div class="row required">
							<label for="address_county_invoice">County</label>
							<span><input type="text" name="" id="" value=""></span>
						</div>

						<div class="row required">
							<label for="address_postcode_invoice">Postcode</label>
							<span><input type="text" name="" id="" value=""></span>
						</div>
						
					</div>
					<?php endfor; ?>

				</div>
				
			</div>
			
			<!-- Address Widget -->
		
			<div class="widget-address-form" style="margin-top: 20px;">

				<h3>Registered Address</h3>
				
				<div class="row required">
					<label for="address_line_1_company">Street Address</label>
					<span><input type="text" name="address_line_1[]" id="address_line_1_company" value=""></span>
				</div>
		
				<div class="row">
					<label for="address_line_2_company">Town/City</label>
					<span><input type="text" name="address_line_2[]" id="address_line_2_company" value=""></span>
				</div>

				<div class="row required">
					<label for="address_county_company">County</label>
					<span><input type="text" name="address_county[]" id="address_county_company" value=""></span>
				</div>
		
				<div class="row required">
					<label for="address_postcode_company">Postcode</label>
					<span><input type="text" name="address_postcode[]" id="address_postcode_company" value=""></span>
				</div>
		
				<input type="hidden" name="address_country[company]" id="address_country_company" value="GBR">

			</div>	
			<!-- End Address Widget -->
				
			<div class="row clear">
				
				<label>Invoice Address</label>
				
				<div style="margin-left: 140px;">
					
					<div class="clear">
						<span><input type="radio" class="account_address_invoice_match" name="account_address_invoice_match" id="account_address_invoice_match_y" value="Y" checked="checked" style="width: auto; float: left; margin: 1px 6px 0 0;"></span>
						<label for="account_address_invoice_match_y" style="width: auto; float: none;">Please use the same address for invoicing</label>
					</div>
				
					<div class="clear">
						<span><input type="radio" class="account_address_invoice_match" name="account_address_invoice_match" id="account_address_invoice_match_n" value="N" style="width: auto; float: left; margin: 1px 6px 0 0;"></span>
						<label for="account_address_invoice_match_n" style="width: auto; float: none;">Invoice to a different address (please specify)</label>
					</div>
					
				</div>
				
			</div>
			
			
			<!-- Address Widget -->
		
			<div class="widget-address-form address-invoice element-hide" style="margin-top: 20px;">

				<h3>Invoice Address</h3>
				
				<div class="row required">
					<label for="address_line_1_invoice">Street Address</label>
					<span><input type="text" name="address_line_1[]" id="address_line_1_invoice" value=""></span>
				</div>
		
				<div class="row">
					<label for="address_line_2_invoice">Town/City</label>
					<span><input type="text" name="address_line_2[]" id="address_line_2_invoice" value=""></span>
				</div>

				<div class="row required">
					<label for="address_county_invoice">County</label>
					<span><input type="text" name="address_county[]" id="address_county_invoice" value=""></span>
				</div>
		
				<div class="row required">
					<label for="address_postcode_invoice">Postcode</label>
					<span><input type="text" name="address_postcode[]" id="address_postcode_invoice" value=""></span>
				</div>
		
				<input type="hidden" name="address_country[invoice]" id="address_country_invoice" value="GBR">

			</div>	
			<!-- End Address Widget -->			
			
		</fieldset>
		
		<fieldset>
			
			<h3>Purchasing Details</h3>
			
			<p>Please provide details about your purchasing department</p>
			
			<div class="row required">
				<label for="">Purchasing Contact Name</label>
				<span><input type="text" name="" id="" value=""></span>
			</div>
			
			<div class="row required">
				<label for="">Position</label>
				<span><input type="text" name="" id="" value=""></span>
			</div>
			
			<div class="row required">
				<label for="">Telephone Number</label>
				<span><input type="text" name="" id="" value=""></span>
			</div>
			
			<div class="row required">
				<label for="">Fax Number</label>
				<span><input type="text" name="" id="" value=""></span>
			</div>
			
			<div class="row required">
				<label for="">Email Address</label>
				<span><input type="text" name="" id="" value=""></span>
			</div>
			
		</fieldset>
		
		<fieldset>
			
			<h3>Accounts Payable</h3>
			
			<p>Please provide details about your accounts department</p>
			
			<div class="row required">
				<label for="">Accounts Payable Contact Name</label>
				<span><input type="text" name="" id="" value=""></span>
			</div>
			
			<div class="row required">
				<label for="">Position</label>
				<span><input type="text" name="" id="" value=""></span>
			</div>
			
			<div class="row required">
				<label for="">Telephone Number</label>
				<span><input type="text" name="" id="" value=""></span>
			</div>
			
			<div class="row required">
				<label for="">Fax Number</label>
				<span><input type="text" name="" id="" value=""></span>
			</div>
			
			<div class="row required">
				<label for="">Email Address</label>
				<span><input type="text" name="" id="" value=""></span>
			</div>
			
		</fieldset>
		
		<fieldset>

			<div class="row clear">
				
				<label for="account_declaration" style="line-height: 1.5em;">Declaration</label>
				
				<textarea name="account_declaration" id="account_declaration" rows="3" cols="40" style="display: block; margin: 0 0 4px 140px; width: 400px;">We hereby apply to open a credit account and understand that payment for goods or services supplied is to be made strictly	net thirty days from date of invoice, unless otherwise agreed in writing by an officer of the Company.</textarea>
				
				<div style="margin: 7px 0 0 140px;">
					<input type="checkbox" style="float: left; margin-top: 2px; margin-right: 7px;" name="account_declaration_agree" id="account_declaration_agree" class="checkbox" value="1">
					<label for="account_declaration_agree" style="float: left; width: auto; line-height: 1.3em; font-size: 0.9em;">
						Check this box if you have read and agree to the above declaration
					</label>
				</div>
				
			</div>
			
		</fieldset>
		
		<div class="row button-row clear">
			<input type="submit" id="register_submit" class="register-button" value="Register">	
		</div>
		
	</form>

<?php $this->load->view('common/footer.include.php'); ?>