<?php defined('APP_DIR') or die('Cannot access file.');

// The REST plugin depends on the Routing core component, and therefore cannot
// be included without it.
if (depends('routing') == FALSE) {
	throw new DependencyException('The REST plugin depends on the Routing plugin, and therefore could not be loaded.');
}

/**
 * The REST plugin provides REST functiionality to the Sulfide
 * framework by creating a {@link RESTController} class. This class
 * supports handling REST requests and maps them to a given function
 * using the standard routing library.
 *
 * Note that this plugin depends on the 'Routing' core component.
 *
 * @author Dominic Charley-Roy
 * @package plugins/REST
 */
class REST extends Plugin {

	protected $pluginName = 'REST';	

}

/**
 * The RESTController is an extension of the Controller class
 * provided in the Routing library. It allows you to add 
 * REST functionality to a Controller by also mapping the HTTP
 * verb to an action.
 *
 * For example, if you wanted to handle a POST request to the action
 * /clients, rather then doing so in a method called doClients, you 
 * would create a method called doPostClients.
 *
 * Note that URL parameter functionality is the same as in the standard
 * Controller system.
 *
 * There are also two overrideable variables associated with the REST controller
 * which are important to the configuration of the controller. Please
 * see {$link RESTController::$supportedMethods} and {$link RESTController::$removeGetFromMethodName}.
 *
 * @author Dominic Charley-Roy
 * @package plugins/REST
 */
class RESTController extends Controller {
	/**
	 * This array designates all the HTTP methods supported by this
	 * controller. Note that if an action of this controller is called
	 * with an invalid method, the 'UnsupportedMethod' action is dispatched.
	 *
	 * {@see RESTController::doUnsupportedMethod()}
	 *
	 * If you wish to change the default supported methods (DELETE, GET, POST, PUT),
	 * simply override this array in your Controller with the array containing
	 * the appropriate methods.
	 *
	 * @access protected
	 * @type array
	 */
	protected $supportedMethods = array('DELETE', 'GET', 'POST', 'PUST');
	
	/**
	 * Due to the predominant nature of GET requests, this setting allows
	 * you to remove the Get from the method name for any GET request.
	 *
	 * For example, if this setting is set to TRUE and a GET request was
	 * passed to /products, rather then dispatching the action to a method
	 * called 'doGetProducts', ir would dispatch it to 'doProducts'.
	 *
	 * By default, this setting is set to FALSE, however it can easily
	 * be overridden in your own class.
	 *
	 * @access protected
	 * @type boolean
	 */ 
	protected $removeGetFromMethodName = FALSE;
	
	public function dispatch($action) {
		$method = $_SERVER['REQUEST_METHOD'];
		
		if (!in_array($method, $this->supportedMethods)) {
			parent::dispatch('UnsupportedMethod');
			return;
		}
		
		if ($this->removeGetFromMethodName && $method == 'GET') {$method = '';}
		
		parent::dispatch(strtolower($method).ucfirst($action));
	}
	
	/**
	 * This function represents the UnsupportedMethod action, and is
	 * called when a REST request is made with an unsupported method.
	 *
	 * {@see RESTController::$supportedMethods}
	 */
	public function doUnsupportedMethod() {
		header('HTTP/1.1 405 Method Not Allowed');  
		header('Allow: '.implode(', ', $this->supportedMethods));    
	}
}