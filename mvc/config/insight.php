<?php

/* C3 Configuration File */
$config = array(
	
	'display'	=> array(
		'skin'		=> 'highclare',
		'title'		=> 'Highclare'
	),
	
	'security'	=> array(
		
		// Salt settings
		'algorithm'				=> 'sha256',
		'salt_one'				=> 'qx;[B?-8c|a$~Z2C]D/D:qn(U%XWltuC<z.Zr{?(k)N;4Xa6;g`;<*-eW#OBN!|-',
		'salt_two'				=> '*.IoNMzpzk-x/8GX+p b_DOF!AbApz|Ae:=b985RyG}zhh!L3X@V9(7YcIhrspNH',
		
		// CAPTCHA settings
		'captcha_enabled'		=> true,	// use captchas?
		'captcha_expiry'		=> 600,		// (seconds) time until expiry
		
		// Password settings
		'password_length'		=> 6,
		'password_user_reset'	=> true		// true allows users to specify their new pw. false, it is generated.
	)

);