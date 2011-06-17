<?php

class ImageController extends Controller {
	protected $redirect_bad_actions = 'get';
	protected $default_action = 'get';
	
	public function doGet() {
		// Set the header
		header("Content-type: image/jpeg");
		
		// Make sure the email parameter was passed
		if (!$this->getParameter(0)) $this->setParameter(0,'');
		
		// Hash the email
		$email = md5(strtolower(trim($this->getParameter(0))));
		
		// Check if a size was passed
		$size = $this->getParameter(1);
		if (!$size) $size = Config::get('loaded_plugins', 'gravatar', 'default_image_size');
		if ($size < 1 || $size > 512) $size = Config::get('loaded_plugins', 'gravatar', 'default_image_size');
		
		echo file_get_contents('http://www.gravatar.com/avatar/'.
							   $email.
							   (($size != 80) ? '?s='.$size : ''));
	}
}