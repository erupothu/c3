<?php $this->load->view('common/header.include.php'); ?>

	<h2>Register an Account</h2>

	<form method="post" action="<?php echo $this->uri->uri_string(); ?>">
		
		<?php if($this->form_validation->has_errors()): ?>
		<div class="row form-errors">
			<?php echo $this->form_validation->errors(); ?>
		</div>
		<?php endif; ?>
		
		<fieldset>
			
			<div class="row required<?php echo $this->form_validation->earmark('account_email'); ?>">
				<label for="account_email">Email Address</label>
				<span><input type="text" name="account_email" id="account_email" value="<?php echo $this->form_validation->value('account_email'); ?>"></span>
			</div>
			
			<div class="row required<?php echo $this->form_validation->earmark('account_password'); ?>">
				<label for="account_password">Choose Password</label>
				<span><input type="password" name="account_password" id="account_password" value="<?php echo $this->form_validation->value('account_password'); ?>"></span>
			</div>
			
			<div class="row required<?php echo $this->form_validation->earmark('account_password_confirm'); ?>">
				<label for="account_password_confirm">Confirm Password</label>
				<span><input type="password" name="account_password_confirm" id="account_password_confirm" value="<?php echo $this->form_validation->value('account_password_confirm'); ?>"></span>
			</div>
			
		</fieldset>
		
		<fieldset>
			
			<div class="row required<?php echo $this->form_validation->earmark('account_name'); ?>">
				<label for="account_name">Name</label>
				<span><input type="text" name="account_name" id="account_name" value="<?php echo $this->form_validation->value('account_name'); ?>"></span>
			</div>
			
			<div class="row required<?php echo $this->form_validation->earmark('account_organisation'); ?>">
				<label for="">Organisation/Government/Defence Department</label>
				<span><input type="text" name="account_organisation" id="account_organisation" value="<?php echo $this->form_validation->value('account_organisation'); ?>"></span>
			</div>
			
			<div class="row<?php echo $this->form_validation->earmark('account_unit'); ?>">
				<label for="account_unit">Unit</label>
				<span><input type="text" name="account_unit" id="account_unit" value="<?php echo $this->form_validation->value('account_unit'); ?>"></span>
			</div>
			
			<div class="row required<?php echo $this->form_validation->earmark('account_country'); ?>">
				<label for="account_country">Country</label>
				<span><select name="account_country" id="account_country">
					<option value="">Select Country</option>
					<option value="">----------------</option>
					<option value="GBR">United Kingdom</option>
					<option value="">----------------</option>
					<option value="AFG">Afghanistan</option>
					<option value="ALB">Albania</option>
					<option value="DZA">Algeria</option>
					<option value="AND">Andorra</option>
					<option value="AGO">Angola</option>
					<option value="ATG">Antigua and Barbuda</option>
					<option value="ARG">Argentina</option>
					<option value="ARM">Armenia</option>
					<option value="AUS">Australia</option>
					<option value="AUT">Austria</option>
					<option value="AZE">Azerbaijan</option>
					<option value="BHS">Bahamas</option>
					<option value="BHR">Bahrain</option>
					<option value="BGD">Bangladesh</option>
					<option value="BRB">Barbados</option>
					<option value="BLR">Belarus</option>
					<option value="BEL">Belgium</option>
					<option value="BLZ">Belize</option>
					<option value="BEN">Benin</option>
					<option value="BTN">Bhutan</option>
					<option value="BOL">Bolivia</option>
					<option value="BIH">Bosnia and Herzegovina</option>
					<option value="BWA">Botswana</option>
					<option value="BRA">Brazil</option>
					<option value="BGR">Bulgaria</option>
					<option value="BFA">Burkina Faso</option>
					<option value="BDI">Burundi</option>
					<option value="KHM">Cambodia</option>
					<option value="CMR">Cameroon</option>
					<option value="CAN">Canada</option>
					<option value="CPV">Cape Verde</option>
					<option value="CAF">Central African Rep</option>
					<option value="TCD">Chad</option>
					<option value="CHL">Chile</option>
					<option value="CHN">China</option>
					<option value="COL">Colombia</option>
					<option value="COM">Comoros</option>
					<option value="COG">Congo</option>
					<option value="COK">Cook Islands</option>
					<option value="CRI">Costa Rica</option>
					<option value="HRV">Croatia</option>
					<option value="CUB">Cuba</option>
					<option value="CYP">Cyprus</option>
					<option value="CZE">Czech Rep</option>
					<option value="CIV">Côte d'Ivoire</option>
					<option value="PRK">Dem People's Rep of Korea</option>
					<option value="COD">Dem Rep of the Congo</option>
					<option value="DNK">Denmark</option>
					<option value="DJI">Djibouti</option>
					<option value="DMA">Dominica</option>
					<option value="DOM">Dominican Rep</option>
					<option value="ECU">Ecuador</option>
					<option value="EGY">Egypt</option>
					<option value="SLV">El Salvador</option>
					<option value="GNQ">Equatorial Guinea</option>
					<option value="ERI">Eritrea</option>
					<option value="EST">Estonia</option>
					<option value="ETH">Ethiopia</option>
					<option value="FJI">Fiji</option>
					<option value="FIN">Finland</option>
					<option value="FRA">France</option>
					<option value="GAB">Gabon</option>
					<option value="GMB">Gambia</option>
					<option value="GEO">Georgia</option>
					<option value="DEU">Germany</option>
					<option value="GHA">Ghana</option>
					<option value="GRC">Greece</option>
					<option value="GRD">Grenada</option>
					<option value="GTM">Guatemala</option>
					<option value="GIN">Guinea</option>
					<option value="GNB">Guinea-Bissau</option>
					<option value="GUY">Guyana</option>
					<option value="HTI">Haiti</option>
					<option value="HND">Honduras</option>
					<option value="HUN">Hungary</option>
					<option value="ISL">Iceland</option>
					<option value="IND">India</option>
					<option value="IDN">Indonesia</option>
					<option value="IRN">Iran (Islamic Rep of)</option>
					<option value="IRQ">Iraq</option>
					<option value="IRL">Ireland</option>
					<option value="ISR">Israel</option>
					<option value="ITA">Italy</option>
					<option value="JAM">Jamaica</option>
					<option value="JPN">Japan</option>
					<option value="JOR">Jordan</option>
					<option value="KAZ">Kazakhstan</option>
					<option value="KEN">Kenya</option>
					<option value="KIR">Kiribati</option>
					<option value="KWT">Kuwait</option>
					<option value="KGZ">Kyrgyzstan</option>
					<option value="LAO">Lao People's Dem Rep</option>
					<option value="LVA">Latvia</option>
					<option value="LBN">Lebanon</option>
					<option value="LSO">Lesotho</option>
					<option value="LBR">Liberia</option>
					<option value="LBY">Libya</option>
					<option value="LTU">Lithuania</option>
					<option value="LUX">Luxembourg</option>
					<option value="MDG">Madagascar</option>
					<option value="MWI">Malawi</option>
					<option value="MYS">Malaysia</option>
					<option value="MDV">Maldives</option>
					<option value="MLI">Mali</option>
					<option value="MLT">Malta</option>
					<option value="MHL">Marshall Islands</option>
					<option value="MRT">Mauritania</option>
					<option value="MUS">Mauritius</option>
					<option value="MEX">Mexico</option>
					<option value="FSM">Micronesia (Fed States of)</option>
					<option value="MCO">Monaco</option>
					<option value="MNG">Mongolia</option>
					<option value="MNE">Montenegro</option>
					<option value="MAR">Morocco</option>
					<option value="MOZ">Mozambique</option>
					<option value="MMR">Myanmar</option>
					<option value="NAM">Namibia</option>
					<option value="NRU">Nauru</option>
					<option value="NPL">Nepal</option>
					<option value="NLD">Netherlands</option>
					<option value="NZL">New Zealand</option>
					<option value="NIC">Nicaragua</option>
					<option value="NER">Niger</option>
					<option value="NGA">Nigeria</option>
					<option value="NIU">Niue</option>
					<option value="NOR">Norway</option>
					<option value="OMN">Oman</option>
					<option value="PAK">Pakistan</option>
					<option value="PLW">Palau</option>
					<option value="PAN">Panama</option>
					<option value="PNG">Papua New Guinea</option>
					<option value="PRY">Paraguay</option>
					<option value="PER">Peru</option>
					<option value="PHL">Philippines</option>
					<option value="POL">Poland</option>
					<option value="PRT">Portugal</option>
					<option value="QAT">Qatar</option>
					<option value="KOR">Rep of Korea</option>
					<option value="MDA">Rep of Moldova</option>
					<option value="ROU">Romania</option>
					<option value="RUS">Russian Federation</option>
					<option value="RWA">Rwanda</option>
					<option value="KNA">Saint Kitts and Nevis</option>
					<option value="LCA">Saint Lucia</option>
					<option value="VCT">Saint Vincent and the Grenadines</option>
					<option value="WSM">Samoa</option>
					<option value="SMR">San Marino</option>
					<option value="STP">Sao Tome and Principe</option>
					<option value="SAU">Saudi Arabia</option>
					<option value="SEN">Senegal</option>
					<option value="SRB">Serbia</option>
					<option value="SYC">Seychelles</option>
					<option value="SLE">Sierra Leone</option>
					<option value="SVK">Slovakia</option>
					<option value="SVN">Slovenia</option>
					<option value="SLB">Solomon Islands</option>
					<option value="SOM">Somalia</option>
					<option value="ZAF">South Africa</option>
					<option value="ESP">Spain</option>
					<option value="LKA">Sri Lanka</option>
					<option value="SDN">Sudan</option>
					<option value="SUR">Suriname</option>
					<option value="SWZ">Swaziland</option>
					<option value="SWE">Sweden</option>
					<option value="CHE">Switzerland</option>
					<option value="SYR">Syrian Arab Rep</option>
					<option value="MKD">TFYR of Macedonia</option>
					<option value="TJK">Tajikistan</option>
					<option value="THA">Thailand</option>
					<option value="TLS">Timor-Leste</option>
					<option value="TGO">Togo</option>
					<option value="TON">Tonga</option>
					<option value="TTO">Trinidad and Tobago</option>
					<option value="TUN">Tunisia</option>
					<option value="TUR">Turkey</option>
					<option value="TKM">Turkmenistan</option>
					<option value="TUV">Tuvalu</option>
					<option value="UGA">Uganda</option>
					<option value="UKR">Ukraine</option>
					<option value="ARE">United Arab Emirates</option>
					<option value="GBR">United Kingdom</option>
					<option value="TZA">United Rep of Tanzania</option>
					<option value="USA">United States of America</option>
					<option value="URY">Uruguay</option>
					<option value="UZB">Uzbekistan</option>
					<option value="VUT">Vanuatu</option>
					<option value="VEN">Venezuela (Bolivarian Rep of)</option>
					<option value="VNM">Viet Nam</option>
					<option value="YEM">Yemen</option>
					<option value="ZMB">Zambia</option>
					<option value="ZWE">Zimbabwe</option>
				</select></span>
			</div>
			
			<div class="row<?php echo $this->form_validation->earmark('account_telephone'); ?>">
				<label for="account_telephone">Telephone</label>
				<span><input type="text" name="account_telephone" id="account_telephone" value="<?php echo $this->form_validation->value('account_telephone'); ?>"></span>
			</div>
			
		</fieldset>
		
		<div class="two-col">
			
			<?php foreach(array('Billing', 'Delivery') as $_x): ?>
			<fieldset>
			
				<legend><?php echo $_x; ?> Address</legend>
			
				<div class="row">
					<label for="">Town/City</label>
					<span><input type="text" name="" id="" value=""></span>
				</div>
			
				<div class="row">
					<label for="">County</label>
					<span><input type="text" name="" id="" value=""></span>
				</div>
			
				<div class="row">
					<label for="">Postcode</label>
					<span><input type="text" name="" id="" value=""></span>
				</div>
			
				<div class="row">
					<label for="">Country</label>
					<span><input type="text" name="" id="" value=""></span>
				</div>
			
			</fieldset>
			<?php endforeach; ?>
		
		</div>
		
		<fieldset>
		
			<div class="row">
				
				<input type="checkbox" name="account_marketing" id="account_marketing" value="1"<?php echo $this->form_validation->checked('account_marketing', '1'); ?>>
				<label for="account_marketing">
					Anubis are always developing new courses and new technologies, please 
					tick here if you don't wish to be informed of future developments.
					<span>(Please Note: Your details will be held by Anubis Associates ltd and will not be shared with any other organisation)</span>
				</label>
				
			</div>
			
			<div class="button-row">
				<input type="submit" value="Register">
			</div>
			
		</fieldset>
		
	</form>

<?php $this->load->view('common/footer.include.php'); ?>