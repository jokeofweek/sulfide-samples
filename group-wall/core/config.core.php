<?php defined('APP_DIR') or die('Cannot access file.');

/**
 * The Config class allows the application to store
 * all settings globaly available under one class.
 * The settings can now be accessed from any other class
 * through the {@link Config::get($key)} static method.
 *
 * @see Config::get($key)
 * @package core
 * @author Dominic Charley-Roy
 */
class Config {
	private static $cfg;

	public static function initialize(){
		self::$cfg = array (
			/*
			 * The database connection settings
			 */
			'database' => array(
				'username' => 'root',
				'password' => '',
				'host' => 'localhost',
				'database_name' => 'sulfide',
				'table_prefixes' => '',
				'driver' => 'mysql'
			), 
			
			/*
			 * The smarty template settings
			 */
			'template' => array(
				'template_dir' => APP_DIR.'templates',
				'cache_dir' => APP_DIR.'templates'.DIRECTORY_SEPARATOR.'cache',
				'compile_dir' => APP_DIR.'templates'.DIRECTORY_SEPARATOR.'compile',
				'config_dir' => APP_DIR.'core'.implode(DIRECTORY_SEPARATOR, array('core', 'ext', 'smarty'))
			),
			
		    /*
			 * The routing system settings
			 */
			'routing' => array(
				'default_controller' => 'posts',
				'controller_dir' => APP_DIR.'pages'.DIRECTORY_SEPARATOR,
				'error_controller' => 'error',
				'error_action' => 'error',
			),
			
			/*
			 * Plugin system settings
			 */
			'plugins' => array(
				'dir' => APP_DIR.'plugins'.DIRECTORY_SEPARATOR,
			),
			
			/*
			 * Posts settings
			 */
			'posts'  => array(
				'posts_per_page' => 10,
				'max_post_length' => 255,
			)
		
		);
	}
	
	/**
	 * This function will fetch a given configuration setting
	 * based on it's setting name, or 'key', or a path to a key.
	 *
	 * @param mixed $key 
	 *		The function accepts a variable number of arguments,
	 *		and can be used to drill down the configuration tree.
	 *		For example, if you wanted to fetch the username setting
	 *		of the database group, you would call:
	 *				get('database', 'username');
	 * @return The setting value if the setting is found.
	 * @throws ConfigKeyException 
	 *		A ConfigKeyException is thrown if there is no setting
	 *		with the passed name.
	 */
	public static function get($key) {
		$keys = func_get_args();
		$current = self::$cfg;
		
		foreach($keys as $key) {
			if (is_array($current) && array_key_exists($key, $current))
				$current = $current[$key];
			else
				throw new ConfigKeyException('The configuration setting \''.implode('=>', $keys).'\' does not exist.');
		}
		
		return $current;
	}
	
	/**
	 * This function allows you to add a value or array to the
	 * Config tree, which can then be fetched using the 
	 * {@link Config::get()} method.
	 *
	 * @param mixed $values
	 *		This is the values to add to the designated path
	 * @param mixed $path
	 *		This is the path of keys to which the values will be 
	 *		added. If a string is passed, it will attempt to 
	 *		create a key based on the string in the root of the
	 *		Config tree, and then it will add the values. If it is
	 *		an array, it will traverse down the path, adding the values
	 *		to the last member of the path
	 * @throws ConfigKeyException
	 *		This is thrown in a variety of situations. It is thrown
	 *		if there already exists a value at the given path, either
	 *		at the end of the path or along the way (for example, one of
	 *		the path keys has an integer already associated with it).
	 */
	public static function add($values, $path) {
		if (is_array($path)) {
			$current = &self::$cfg;
			
			foreach($path as $value) {
				if (is_array($current)) {
					if (!array_key_exists($value, $current)) 
						$current[$value] = array();
					$current = &$current[$value];
				} else {
					throw new ConfigKeyException('The configuration values could not be added to the path \''.implode('=>', $path).'\' as one of the values in the path does not refer to an array.');
				}
			}
			
			if (empty($current)) 
				$current = $values;
			else
				throw new ConfigKeyException('The configuration values could not be added to the path \''.implode('=>', $path).'\' as there were already non-array values in the path.');

		} else if (is_string($path)) {
			if (!array_key_exists($path, self::$cfg))
				self::$cfg[$path] = $values;
			else
				throw new ConfigKeyException('There already exists a group of configuration settings under the key '.$path.'.');
		}
	}
}

/**
 * Basic Exception used through the Config object for things
 * such as invalid keys
 *
 * @package core
 * @author Dominic Charley-Roy
 */
class ConfigKeyException extends Exception { }

Config::initialize();