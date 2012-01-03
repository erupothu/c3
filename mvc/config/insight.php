<?php

$config = array(
	
	'display'	=> array(
		
		'skin'		=> 'highclare',
		'title'		=> 'Highclare School'
		
	),
	
	'security'	=> array(
		
		// Salt settings
		'algorithm'				=> 'sha256',
		'salt_one'				=> 'h192!bGbAsKq.q23',
		'salt_two'				=> 'asln_kfh9811Qna8',
		
		// CAPTCHA settings
		'captcha_enabled'		=> true,	// use captchas?
		'captcha_expiry'		=> 600,		// (seconds) time until expiry
		
		// Password settings
		'password_length'		=> 6,
		'password_user_reset'	=> true		// true allows users to specify their new pw. false, it is generated.
	)

);