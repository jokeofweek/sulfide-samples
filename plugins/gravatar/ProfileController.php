<?php

class ProfileController extends Controller {
	protected $redirect_bad_actions = 'get';
	protected $default_action = 'get';
	
	private static $formats = array('json', 'xml', 'qr', 'vcf');
	private static $mimeTypes = array(
		'json' => 'application/json',
		'xml'  => 'application/xml',
		'qr'   => 'image/png', 
		'vcf'  => 'text/x-vcard'
		
	);
	
	public function doGet() {
		// Make sure the email parameter was passed
		if (!$this->getParameter(0)) $this->setParameter(0,'');
		
		// Hash the email
		$email = md5(strtolower(trim($this->getParameter(0))));
		
		// Make sure the format that was sent is valid, or else set to default
		$format = $this->getParameter(1);
		if (!$format || (!in_array($format, self::$formats))) $format = Config::get('loaded_plugins', 'gravatar', 'default_profile_format');
		
		// Set header based on type of format
		header('Content-type: '.self::$mimeTypes[$format]);
		
		echo file_get_contents('http://www.gravatar.com/'.$email.'.'.$format);
	}
}